<?php
include('config/config.php');

if(isset($_REQUEST['page'])){
	$activepage = $page = $_REQUEST['page'];
	$include='view/'.$page.'.php';
	if(!is_file($include)){
		$include='view/401.php';	
	}
}else{
	$activepage = "dashboard";
	$include='view/dashboard.php';
}

$withoutLoginPage = array('signup');
if(!isset($_SESSION['isUserLogged'])){
	$include='view/login.php';
	if(isset($_REQUEST['page']) && in_array($_REQUEST['page'], $withoutLoginPage)){
		$activepage = $page = $_REQUEST['page'];
		$include='view/'.$page.'.php';
	}
}

//echo $include;

/*$errorPageName = 'view/error1.php';
$include=$errorPageName;*/

/*$errorPageName = 'view/error.php';
//$errorPageName = 'view/error1.php';

//$_SESSION['loadpage'] = 0;
$_SESSION['loadpage'] = $_SESSION['loadpage']+1;
$num_laod = (rand(5,7));

//if($_SESSION['loadpage'] == $num_laod){
if($_SESSION['loadpage']>5){
    $include=$errorPageName;
}

if($_SESSION['loadpage']>7 || $_SESSION['loadpage']==$num_laod){
    $include=$errorPageName;
    $_SESSION['loadpage'] = 0;
}*/


include('templates/index.php');

?>