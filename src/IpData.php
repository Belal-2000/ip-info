<?php

namespace Belal\IpInfo;

class IpData implements \JsonSerializable
{
    function __construct(
        private string $ipInRequset,
        private string $passedIp,
        private string $city,
        private string $country,
        private string $countryCode,
        private string $continent,
        private string $timezone,
        )
    {
        
    }

    public function getIpInRequset(){
        return $this->ipInRequset;
    }

    public function getPassedIp(){
        return $this->passedIp;
    }

    public function getCity(){
        return $this->city;
    }

    public function getCountry(){
        return $this->country;
    }
    public function getCountryCode(){
        return $this->countryCode;
    }
    public function getContinent(){
        return $this->continent;
    }
    public function getTimeZone(){
        return $this->timezone;
    }

    public function jsonSerialize() {
        return [
            'ipInRequset' => $this->getIpInRequset(),
            'passedIp' => $this->getPassedIp(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'countryCode' => $this->getCountryCode(),
            'continent' => $this->getContinent(),
            'timezone' => $this->getTimeZone()
        ];
    }

}
