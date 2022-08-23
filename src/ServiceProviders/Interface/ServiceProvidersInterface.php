<?php

namespace Belal\IpInfo\ServiceProviders\Interface;

use Belal\IpInfo\IpData;

interface ServiceProvidersInterface
{
    public function getData() : IpData;
    public function checkStatus() : bool;
}
