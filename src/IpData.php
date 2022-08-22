<?php

namespace Belal\IpInfo;

use Belal\IpInfo\ServiceProviders\Geolocation;
use Belal\IpInfo\ServiceProviders\IpApi;

class IpData
{
    private $serviceProviders = [];

    function __construct($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \Exception("The ip provided: ${$ip} is not a valid ip!", 1);
        }
        array_push(
            $this->serviceProviders,
            new Geolocation($ip),
            new IpApi($ip)
        );
    }

    public function getInfo(): array | NULL
    {
        $info = null;
        foreach ($this->serviceProviders as $service) {
            if ($service->checkStatus()) {
                $info = $service->getData();
                if ($info["country"]){
                    return $info;
                }
            }
        }
        // if status & country check poth failed ..
        return null;
    }
}
