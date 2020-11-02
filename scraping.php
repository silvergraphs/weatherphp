<?php

require 'config.php'; // Configuration file

$city = 'Buenos Aires';
$url = constant('APIURL') . '?q=' . $city . '&appid=' . constant('APIKEY');

$apiData = file_get_contents($url);
$data = json_decode($apiData, true);

var_dump($data);

echo "<br/><br/>* Obtained data from OpenWeatherMap API";
?>
