<?php

header("Access-Control-Allow-Origin: *");

@session_start();
//error_reporting(E_ERROR | E_WARNING | E_PARSE );
error_reporting(0);
$servername = '144.24.100.213';
$username = 'admin';
$password = 'password';
$database = 'sharemarket';
$_SESSION['limit']=50;

static $con;
$con = mysqli_connect($servername, $username, $password, $database);
if (mysqli_connect_errno()){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = $current_url;
$urlParts = explode("/", $url);
$folder=$urlParts[3];
$redirectURL_admin = "http://$_SERVER[HTTP_HOST]/admin/";

//$redirectURL_admin = "http://deitysoftware.in/PROJECTS/forex/admin";
$redirectURL_user = "http://$_SERVER[HTTP_HOST]/";

date_default_timezone_set('Asia/Kolkata');

$curretDate = date("d M Y H:i");
$currentDateStr = strtotime($curretDate);

/*function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$clientsIpAddress = get_client_ip(); //"103.103.213.226"; //"160.202.40.203";//

$ipInfo = file_get_contents('http://ip-api.com/json/' . $clientsIpAddress);
$ipInfo = json_decode($ipInfo);
$timezone_login = $ipInfo->timezone;

$sqlGetUTC_login = mysqli_query($con,"select * from ".$prefix."timezone where country_timezone='$timezone_login'") or die(mysqli_error($con));
$fetchUTC_login = mysqli_fetch_array($sqlGetUTC_login);
$country_utc_login = $fetchUTC_login['country_utc'];*/
include "functions.php";

$WEBSITE_DATA_ARRAY = websiteDetailsFun();
$WEBSITE_DETAIL_DATA = $WEBSITE_DATA_ARRAY['websiteDetailData'];
print_r($WEBSITE_DETAIL_DATA);
?>
