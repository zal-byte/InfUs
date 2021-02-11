<?php

    class IP_GEO{
        //You can get API KEY from https://ipgeolocation.io 
        public $API_KEY = "<API_KEY>";
        public $URL = "https://api.ipgeolocation.io/ipgeo";
        private static $instance = null;
        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new IP_GEO();
            }
            return self::$instance;
        }
        public function __construct(){

        }
        
        function curl($ip){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->URL."?apiKey=".$this->API_KEY."&ip=".$ip);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1);
            $agents = array(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1',
                'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.9) Gecko/20100508 SeaMonkey/2.0.4',
                'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)',
                'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1'
            
            );
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_USERAGENT, $agents[array_rand($agents)]);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }

        function parse($json){
            $json = json_decode($json, 1);
            $result = "";
            $result .= "[?] Geo IP Location \n";
            $result .= "\n================================================================================\n";
            $result .= "[+] IP : ".$json['ip']."\n";
            $result .= "[+] Continent Code : ".$json['continent_code']."\n";
            $result .= "[+] Continent Name : ".$json['continent_name']."\n";
            $result .= "[+] Country Code : ".$json['country_code2']."\n";
            $result .= "[+] Country Code : ".$json['country_code3']."\n";
            $result .= "[+] Country Name : ".$json['country_name']."\n";
            $result .= "[+] Country Capital : ".$json['country_capital']."\n";
            $result .= "[+] State Prov : ".$json['state_prov']."\n";
            $result .= "[+] District : ".$json['district']."\n";
            $result .= "[+] City : ".$json['city']."\n";
            $result .= "[+] Zip Code : ".$json['zipcode']."\n";
            $result .= "[+] Latitude : ".$json['latitude']."\n";
            $result .= "[+] Longitude : ".$json['longitude']."\n";
            $result .= "[+] is_eu : ".$json['is_eu']."\n";
            $result .= "[+] Calling Code : ".$json['calling_code']."\n";
            $result .= "[+] Country tld : ".$json['country_tld']."\n";
            $result .= "[+] Languages : ".$json['languages']."\n";
            $result .= "[+] Country Flag : ".$json['country_flag']."\n";
            $result .= "[+] Geoname ID : ".$json['geoname_id']."\n";
            $result .= "[+] ISP : ".$json['isp']."\n";
            $result .= "[+] Connection Type : ".$json['connection_type']."\n";
            $result .= "[+] Organization : ".$json['organization']."\n";
            $result .= "[-] Currency \n";
            $result .= "___[+] Code : ".$json['currency']['code']."\n";
            $result .= "___[+] Name : ".$json['currency']['name']."\n";
            $result .= "___[+] Symbol : ".$json['currency']['symbol']."\n";
            $result .= "[-] Time Zone\n";
            $result .= "___[+] Name : ".$json['time_zone']['name']."\n";
            $result .= "___[+] Offset : ".$json['time_zone']['offset']."\n";
            $result .= "___[+] Current Time : ".$json['time_zone']['current_time']."\n";
            $result .= "___[+] Current Time Unix : ".$json['time_zone']['current_time_unix']."\n";
            $result .= "___[+] is_dst : ".$json['time_zone']['is_dst']."\n";
            $result .= "___[+] dst_savings : ".$json['time_zone']['dst_savings']."\n";
            $result .= "\n================================================================================\n";
            return $result;
        }

    }

?>