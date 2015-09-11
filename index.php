<?php
sessionStart();
define("CLIENT_IP",$_SERVER['REMOTE_ADDR']);
?>

<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js" ></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script src="./script.js" ></script>

</head>
<?php

$client_city = detect_city(CLIENT_IP);

function detect_city($ip) {
        
        $default = 'UNKNOWN';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $curlopt_useragent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        /*if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }*/

        if( $city!=''){
          $location = $city;
          return $location;
        }else{
          return $default; 
        }
        
}


?>
<body>

<div class="header">
<h1> Hi human, <br/>Your ip is <?php echo CLIENT_IP; ?></h1>
<h2>Based on this information, your city is approximately <?php echo $client_city; ?></h2>
<h2>By comparison, the html 5 way to detect your location returned <span class="js_city"></span>.</h2>
<h2>From this information, we know that the current weather at your location is <span class="js_weather"></span></h2>


</div>

<div class="main_content">
<button class="startGeo" value="" >Get started!</button>
<textarea name="textarea_info" rows="10" cols="50">Now loading.</textarea>

<input name="try" type='text' value='enter something here..' />


</div>




</body>
</html>