<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $uri = 'https://';
} else {
  $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];

//live
// define('BASE_URL', $uri);
//local
define('BASE_URL', $uri . "/esport");
define('DS', '/');

//live
// define('SITE_PATH', $uri . "/admin/img/news/");
//local
// define('SITE_PATH', $uri . "/wps/admin/img/news/details/");
// define('SITE_NEWS', $uri . "/wps/admin/img/news/");
// define('SITE_TESTIMONIAL', $uri . "/wps/admin/img/testimonial/");


// Koneksi Live
// $servername = "localhost";
// $username = "mitm9652_mitsubishi";
// $password = "Orig1nmitsubishi2022";
// $dbname = "mitm9652_mitsubishi";
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// if (!$conn) {
//   echo "Failed to connect!";
// }
// Akhir Koneksi Live

// Koneksi Local
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esport";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  echo "Failed to connect!";
}
  // Akhir Koneksi Local