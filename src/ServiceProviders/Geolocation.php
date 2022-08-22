<?php

namespace Belal\IpInfo\ServiceProviders;

use Belal\IpInfo\ServiceProviders\Interface\ServiceProvidersInterface;

class Geolocation implements ServiceProvidersInterface
{
    /**
     *
     * Must Check first for status 
     * using checkStatus mathod
     * 
     */
    private $data;
    private $ip;

    function __construct($ip)
    {
        $this->ip = $ip;
    }

    private function makeCall()
    {
        $url = "http://www.geoplugin.net/json.gp?ip=" . $this->ip;
        $this->data = @json_decode(file_get_contents($url));
    }

    public function getData()
    {
        return $this->filterData();
    }

    private function filterData()
    {
        $filterdData = [
            'ipInRequset' => $this->data->geoplugin_request,
            'passedIp' => $this->ip,
            'city' => $this->data->geoplugin_city,
            'country' => $this->data->geoplugin_countryName,
            'countryCode' => $this->data->geoplugin_countryCode,
            'continent' => $this->data->geoplugin_continentName,
            'timezone' => $this->data->geoplugin_timezone,
            // Pending
            // 'currencyCode' => $this->data->geoplugin_currencyCode,
            // 'currencyConverter' => $this->data->geoplugin_currencyConverter,
        ];

        return $filterdData;
    }

    public function checkStatus(): bool
    {
        $this->makeCall();
        if($this->data->geoplugin_status >= 200 && $this->data->geoplugin_status <= 300) return true;
        return false;
    }
}
