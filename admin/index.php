<?php
include('../config/config.php');

if(isset($_REQUEST['page'])){
	$activePage = $page=$_REQUEST['page'];
	$include='view/'.$page.'.php';
	if(!is_file($include)){
		$include='view/401.php';	
	}
}else{
	$activePage = "dashboard";
	$include='view/dashboard.php';
}

if(!isset($_SESSION['isAdminUserLogged'])){
	$include='view/login.php';
}


/*$errorPageName = 'view/error1.php';
$include=$errorPageName;*/

/*$errorPageName = 'view/error.php';
//$errorPageName = 'view/error1.php';

//$_SESSION['loadpage'] = 0;
$_SESSION['loadpage'] = $_SESSION['loadpage']+1;
$num_laod = (rand(5,7));

//if($_SESSION['loadpage'] == $num_laod){
if($_SESSION['loadpage']>4){
    $include=$errorPageName;
}

if($_SESSION['loadpage']>7 || $_SESSION['loadpage']==$num_laod){
    $include=$errorPageName;
    $_SESSION['loadpage'] = 0;
}
*/

include('templates/index.php');

?>