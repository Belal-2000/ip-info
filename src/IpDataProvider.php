<?php

namespace Belal\IpInfo;

use Belal\IpInfo\ServiceProviders\Geolocation;
use Belal\IpInfo\ServiceProviders\IpApi;

class IpDataProvider
{
    private $serviceProviders;

    public function getInfo(string $ip): IpData | NULL
    {
        // validate the ip provided
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \Exception("The ip provided: ${$ip} is not a valid ip!", 1);
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
                    return $info;
                }
            }
        }
        // if status & country check poth failed ..
        return null;
    }
}
