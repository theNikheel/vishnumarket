<?php
include('../../config/config.php');

//echo "<pre>"; print_r($_POST);
if(isset($_POST['submit'])){
    
    $clientId = $_POST['clientId'];
	
	$fname = mysqli_real_escape_string($con,$_POST['fname']);
	$mname = mysqli_real_escape_string($con,$_POST['mname']);
	$lname = mysqli_real_escape_string($con,$_POST['lname']);

	$email = $_POST['email'];
	$contactNo = $_POST['contactNo'];

	$address = mysqli_real_escape_string($con,$_POST['address']);
	$city = mysqli_real_escape_string($con,$_POST['city']);
	$state = mysqli_real_escape_string($con,$_POST['state']);
	$zip = $_POST['zip'];

	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['password']);

	$bank_name = mysqli_real_escape_string($con,$_POST['bank_name']);
	$bank_branch = mysqli_real_escape_string($con,$_POST['bank_branch']);
	$bank_ifsc = $_POST['bank_ifsc'];
	$bank_account = $_POST['bank_account'];

	$adminApprove = 2;
	$allowTrading = $_POST['allowTrading'];
	$brokerage = $_POST['brokerage'];

	mysqli_query($con,"INSERT INTO users SET clientId='$clientId',fname='$fname',mname='$mname',lname='$lname',email='$email',contactNo='$contactNo',address='$address',city='$city',state='$state',zip='$zip',username='$username',password='$password',createdDt='$curretDate',updatedDt='$curretDate',uStatus='1',allowTrading='$allowTrading',brokerage='$brokerage',adminApprove='$adminApprove'");
	$lastId = mysqli_insert_id($con);
    
    $user_image_path = "";
	if($_FILES['user_photo']["name"]!=''){
	    
    	$uploaddir1 = '../../assets/users/';
        $dl=explode(".",$_FILES['user_photo']["name"]);
        $extension = end($dl);
        
        $_FILES['user_photo']["name"] = $lastId."_u_photo_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['user_photo']["name"];
        $user_image_path = $redirectURL_user."assets/users/".$_FILES['user_photo']["name"];  //$image_path
        move_uploaded_file( $_FILES['user_photo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
        mysqli_query($con,"UPDATE users SET photo='$user_image_path' where id='$lastId'");
	}


	$pan_number = $_POST['pan_number'];
	$aadhar_number = $_POST['aadhar_number'];

	$pan_number_photo = "";
	if($_FILES['pan_photo']["name"]!=''){
	    
    	$uploaddir1 = '../../assets/users/';
        $dl=explode(".",$_FILES['pan_photo']["name"]);
        $extension = end($dl);
        
        $_FILES['pan_photo']["name"] = $lastId."_u_pan_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['pan_photo']["name"];
        $pan_number_photo = $redirectURL_user."assets/users/".$_FILES['pan_photo']["name"];  //$image_path
        move_uploaded_file( $_FILES['pan_photo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
	}

	$aadhar_number_photo = "";
	if($_FILES['aadhar_photo']["name"]!=''){
	    
    	$uploaddir1 = '../../assets/users/';
        $dl=explode(".",$_FILES['aadhar_photo']["name"]);
        $extension = end($dl);
        
        $_FILES['aadhar_photo']["name"] = $lastId."_u_aadhar_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['aadhar_photo']["name"];
        $aadhar_number_photo = $redirectURL_user."assets/users/".$_FILES['aadhar_photo']["name"];  //$image_path
        move_uploaded_file( $_FILES['aadhar_photo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
	}

	mysqli_query($con,"INSERT INTO users_bank_detail SET bank_name='$bank_name',bank_branch='$bank_branch',bank_ifsc='$bank_ifsc',bank_account='$bank_account',pan_number='$pan_number',pan_number_photo='$pan_number_photo',aadhar_number='$aadhar_number',aadhar_number_photo='$aadhar_number_photo',refUserId='$lastId'");

	header('location: ../?page=userList'); exit;
}
?>