<?php

require __DIR__ . "/../../vendor/autoload.php";

use Belal\IpInfo\IpData;
use Belal\IpInfo\ServiceProviders\Geolocation;
use PHPUnit\Framework\TestCase;

class GeolocationTest extends TestCase
{

    public function testCheckStatusResponceWhenGoodAndBadIpProvided()
    {
        // Good IP
        $GeoProvider1 = new Geolocation("33.239.114.153");
        $this->assertSame(true, $GeoProvider1->checkStatus());
        // Bad IP
        $GeoProvider2 = new Geolocation("169.254.0.0");
        $this->assertSame(false, $GeoProvider2->checkStatus());
    }

    public function testGetdataCalleBeforeCallingCheckstatusMethod()
    {
        $GeoProvider1 = new Geolocation("33.239.114.153");
        $this->expectException(\Exception::class);

        $GeoProvider1->getData();
    }

    public function testGetdataReturnTypeShouldBeIpdata()
    {
        $GeoProvider1 = new Geolocation("33.239.114.153");
        $GeoProvider1->checkStatus();

        $this->assertInstanceOf(IpData::class, $GeoProvider1->getData());
    }
}
