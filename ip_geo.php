<?php

    require_once 'lib/ipgeolocation.php';

    $ip_geo = IP_GEO::getInstance();
    $ip = readline('IP Address : ');
    print_r($ip_geo->parse($ip_geo->curl($ip)));

?>