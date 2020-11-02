<?php
require 'config.php'; // Configuration file

if ($_POST['city']) {
  $url =
    constant('APIURL') .
    '?units=metric&q=' .
    $_POST['city'] .
    '&appid=' .
    constant('APIKEY');

  $apiData = file_get_contents($url);
  $data = json_decode($apiData, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container" align="center">
    
    <h1 class="pt-5"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
</svg><br/>WeatherApp PHP</h1>
    <h2 class="p-2">This app obtains weather data from a desired city</h2>

    <h4 class="p-2">Search City</h4>
    <form action="" method="post" class="form-inline d-flex justify-content-center" autocomplete="off">
    <div class="form-group mx-sm-2 mb-2">
    <input type="text" class="form-control" name="city" placeholder="Any city" autocomplete="off">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Search <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
</svg></button>
    </form>
<hr/>

    <?php
    if ($_POST['city'] && $apiData) {
      echo '<h3>' .
        ucwords($_POST['city']) .
        ', ' .
        $data['sys']['country'] .
        '<h3>';

      echo '<h4 class=""><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-thermometer-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M6 2a2 2 0 1 1 4 0v7.627a3.5 3.5 0 1 1-4 0V2zm2-1a1 1 0 0 0-1 1v7.901a.5.5 0 0 1-.25.433A2.499 2.499 0 0 0 8 15a2.5 2.5 0 0 0 1.25-4.666.5.5 0 0 1-.25-.433V2a1 1 0 0 0-1-1z"/>
        <path d="M8.25 2a.25.25 0 0 0-.5 0v9.02a1.514 1.514 0 0 1 .5 0V2z"/>
        <path d="M9.5 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
      </svg> ' .
        round($data['main']['temp']) .
        '°</h4>';

      echo '<strong>' . $data['weather']['main'] . '</strong>';

      echo '       <p class="pt-3">Max. temp: ' .
        round($data['main']['temp_max']) .
        '°</p>
      <p> Min. temp: ' .
        round($data['main']['temp_min']) .
        '°</p>
      <p> Pressure: ' .
        $data['main']['pressure'] .
        'hPa</p>
      <p> Humidity: ' .
        $data['main']['humidity'] .
        '%</p>';

      echo "       <hr>";
    }
    if ($apiData === false) {
      echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
    </svg> City not found<hr>';
    }
    ?>

    
        

       
 
        <p><small>Developed by Bruno Caruso - Data from OpenWeatherMap</small></p>
</div>

</body>
</html>