<?php

namespace Belal\IpInfo;

use Psr\SimpleCache\CacheInterface;
use Belal\IpInfo\ServiceProviders\IpApi;
use Belal\IpInfo\ServiceProviders\Geolocation;

class IpDataProvider
{
    private $serviceProviders;
    public $cache;

    public function __construct(CacheInterface $cache = null)
    {
        $this->cache = $cache;
    }

    public function getInfo(string $ip): IpData | string | NULL
    {

        // validate the ip provided
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException("The ip provided: {$ip} is not a valid ip!", 1);
        }

        if($this->cache){
            if($this->cache->has("IP{$ip}")){
                return $this->cache->get("IP{$ip}");
            }
        }
        
        // set our serviceProviders
        $this->serviceProviders = [
            new Geolocation($ip),
            new IpApi($ip)
        ];

        // loop through our serviceProviders till we got the result 
        // (must have Country in the result)
        $info = null;
        foreach ($this->serviceProviders as $service) {
            if ($service->checkStatus()) {
                $info = $service->getData();
                if ($info->getCountry()){
                    if($this->cache){
                        $this->cache->set("IP{$ip}" , json_encode($info , 10));
                    }
                    return $info;
                }
            }
        }
        // if status & country check poth failed ..
        return null;
    }
}
