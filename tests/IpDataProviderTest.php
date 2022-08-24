<?php

require __DIR__ . "/../vendor/autoload.php";

use Belal\IpInfo\IpData;
use Belal\IpInfo\IpDataProvider;
use PHPUnit\Framework\TestCase;

class IpDataProviderTest extends TestCase
{

    public function testClassConstructor()
    {
        $IpDataProvider = new IpDataProvider();
        $this->assertSame(null, $IpDataProvider->cache);
    }

    public function testGetInfoIpValidation()
    {
        $IpDataProvider = new IpDataProvider();
        $this->expectException(\InvalidArgumentException::class);

        $IpDataProvider->getInfo('asdasdasdasdasd');
    }

    public function testGetInfoReturnTypeShouldBeIpdata()
    {
        $IpDataProvider = new IpDataProvider();
        $this->assertInstanceOf(IpData::class , $IpDataProvider->getInfo("33.239.114.153"));
    }

    public function testGetInfoShouldBeJsonSerializable()
    {
        $IpDataProvider = new IpDataProvider();
        $this->assertIsString(json_encode($IpDataProvider->getInfo("33.239.114.153")));        
    }

    public function testGetInfoWhenCantFindDataOrBlockedIp()
    {
        $IpDataProvider = new IpDataProvider();
        $this->assertSame(null , $IpDataProvider->getInfo("169.254.0.0"));
    }

}

// $test = new IpDataProviderTest();
// $test->testGetInfo();
