# Simple php package to get country from IP address

### usage 

- Require the package using composer 

```
composer require belal/ip-info
```

- To use it simply call the 'getInfo' method after intanshate an instance of the IpDataProvider class

```
$IpData = new IpDataProvider();

$result = $IpData->getInfo("Any Ip Address")
```

- The getInfo method returns a IpData opject witch can be used like:

```
$result->getIpInRequset()

$result->getPassedIp()

$result->getCountry()

$result->getCity()

$result->getCountryCode()

$result->getContinent()

$result->getTimeZone()
```

- the getIpInRequset is the ip the request made with
- the getPassedIp is the ip you provided
- if they are different this mean the data is for the ip of the machine that sent the request


- The IpData opject is JsonSerializable .. Find more at [THE PHP DOCS](https://www.php.net/manual/en/jsonserializable.jsonserialize.php).



