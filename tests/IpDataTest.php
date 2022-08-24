<?php

require __DIR__ . "/../vendor/autoload.php";

use Belal\IpInfo\IpData;
use Belal\IpInfo\IpDataProvider;
use PHPUnit\Framework\TestCase;

class IpDataTest extends TestCase
{

    public function testGetterMethods()
    {
        $IpDataProvider = new IpDataProvider();
        $res = $IpDataProvider->getInfo("33.239.114.153");
        $this->assertIsString($res->getIpInRequset());
        $this->assertIsString($res->getPassedIp());
        $this->assertIsString($res->getCity());
        $this->assertIsString($res->getCountry());
        $this->assertIsString($res->getCountryCode());
        $this->assertIsString($res->getContinent());
        $this->assertIsString($res->getTimeZone());
    }
}
