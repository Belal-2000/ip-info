<?php

namespace Belal\IpInfo\ServiceProviders;

use Belal\IpInfo\IpData;
use Belal\IpInfo\ServiceProviders\Interface\ServiceProvidersInterface;

class IpApi implements ServiceProvidersInterface
{
    /**
     *
     * Must Check first for status 
     * using checkStatus mathod
     * 
     */

    private $ip;
    private $data;
    // private $responce;

    function __construct($ip)
    {
        $this->ip = $ip;
        // ToDo
        // $this->responce = $http_response_header;
    }

    private function makeCall()
    {
        $url = "http://ip-api.com/php/" . $this->ip . "?fields=status,message,continent,country,countryCode,city,timezone,query";
        $data = unserialize(file_get_contents($url));

        $this->data = $data;
    }

    public function getData() : IpData
    {
        return new IpData(
            $this->data['query'],
            $this->ip,
            $this->data['city'],
            $this->data['country'],
            $this->data['countryCode'],
            $this->data['continent'],
            $this->data['timezone']
        );
    }

    public function checkStatus(): bool
    {
        $this->makeCall();
        return $this->data['status'] == 'success' ? true : false;
    }
}
