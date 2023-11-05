<?php
include('../../config/config.php');

if(isset($_POST['submit'])){
	$uname = $_POST['uname'];
	$password = $_POST['password'];

	$qry = mysqli_query($con,"SELECT * FROM adminuser WHERE username='$uname' and password='$password'");
	$num = mysqli_num_rows($qry);
	
	if($num==1){
	    $fetch_data = mysqli_fetch_assoc($qry);
	    $getAttempt = $fetch_data['attempt'];
	    /*if($getAttempt==1){
	    	$_SESSION['isAdminUserLogged'] = true;
	    	mysqli_query($con,"UPDATE adminuser SET attempt='0'");
	    }else{
	        mysqli_query($con,"UPDATE adminuser SET attempt=attempt+1");
	    }*/
	    $_SESSION['isAdminUserLogged'] = true;
	    mysqli_query($con,"UPDATE adminuser SET attempt=attempt+1");
	}
    //echo $redirectURL_admin;
	header('location: '.$redirectURL_admin); exit;
}
?>