<?php
include('../config/config.php');

if(isset($_POST['submit'])){
	$uname = $_POST['uname'];
	$password = $_POST['password'];
    
    
	$qry = mysqli_query($con,"SELECT * FROM users WHERE username='$uname' and password='$password'") or die(mysqli_error($con));
	$num = mysqli_num_rows($qry);

	if($num>0){
	    $fetch = mysqli_fetch_assoc($qry);
	    $autoId = $fetch['id'];
	    
	    mysqli_query($con,"UPDATE users SET lastLoginDt='$curretDate' WHERE id='$autoId'") or die(mysqli_error($con));
		
		$_SESSION['loginId'] = $autoId;
		$_SESSION['isUserLogged'] = true;
		//echo $redirectURL_user;
		header('location: '.$redirectURL_user); exit;
	}else{
	    header('location: '.$redirectURL_user); exit;
	}	
}

if(isset($_POST['signup'])){
	$uname = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];  
	$contactNo = $_POST['contactNo'];
    
	$qry = mysqli_query($con,"SELECT * FROM users WHERE email='$email' or username='$uname'") or die(mysqli_error($con));
	$num = mysqli_num_rows($qry);

	if($num==0){
	    
		mysqli_query($con,"INSERT INTO users SET email='$email',username='$uname',password='$password', contactNo='$contactNo', createdDt='$curretDate',updatedDt='$curretDate'");
		$autoId = mysqli_insert_id($con);

		mysqli_query($con,"INSERT INTO users_bank_detail SET refUserId='$autoId'");

		$_SESSION['loginId'] = $autoId;
		$_SESSION['isUserLogged'] = true;
		
		header('location: '.$redirectURL_user.'?page=profileEdit'); exit;
	}else{
		$fetch = mysqli_fetch_assoc($qry);
	    $autoId = $fetch['id'];
	    $uStatus = $fetch['uStatus'];

	    if($uStatus==0)
	    {
			mysqli_query($con,"UPDATE users SET email='$email',username='$uname',password='$password', contactNo='$contactNo',createdDt='$curretDate',updatedDt='$curretDate' WHERE id='$autoId'");
		}
		$_SESSION['loginId'] = $autoId;
		$_SESSION['isUserLogged'] = true;
		
		header('location: '.$redirectURL_user.'?page=profileEdit'); exit;
	}
	header('location: '.$redirectURL_user); exit;
}
?>