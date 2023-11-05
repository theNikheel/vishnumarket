<?php
include('../../config/config.php');

if(isset($_POST['submit'])){
    
    $editUserId = $_POST['editUserId'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];

	$email = $_POST['email'];
	$contactNo = $_POST['contactNo'];

	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];

	$username = $_POST['username'];
	$password = $_POST['password'];

	$bank_name = $_POST['bank_name'];
	$bank_branch = $_POST['bank_branch'];
	$bank_ifsc = $_POST['bank_ifsc'];
	$bank_account = $_POST['bank_account'];

	$adminApprove = 2;
	$allowTrading = $_POST['allowTrading'];
	$brokerage = $_POST['brokerage'];
	
	$user_image_path = $_POST['old_user_photo'];
	if($_FILES['user_photo']["name"]!=''){
	    
    	$uploaddir1 = '../../assets/users/';
        $dl=explode(".",$_FILES['user_photo']["name"]);
        $extension = end($dl);
        
        $_FILES['user_photo']["name"] = "u"."_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['user_photo']["name"];
        $user_image_path = $redirectURL_user."assets/users/".$_FILES['user_photo']["name"];  //$image_path
        move_uploaded_file( $_FILES['user_photo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
	}

	if(isset($_POST['clientId']))
	{
		$clientId = $_POST['clientId'];
		mysqli_query($con,"UPDATE users SET clientId='$clientId' where id=$editUserId");
	}
	
    mysqli_query($con,"UPDATE users SET fname='$fname',mname='$mname',lname='$lname',photo='$user_image_path',email='$email',contactNo='$contactNo',address='$address',city='$city',state='$state',zip='$zip',username='$username',password='$password',createdDt='$curretDate',updatedDt='$curretDate',allowTrading='$allowTrading',brokerage='$brokerage',adminApprove='$adminApprove' where id=$editUserId") or die(mysqli_error($con));


	$pan_number = $_POST['pan_number'];
	$aadhar_number = $_POST['aadhar_number'];

	$pan_number_photo = $_POST['old_pan_photo'];
	if($_FILES['pan_photo']["name"]!=''){
	    
    	$uploaddir1 = '../../assets/users/';
        $dl=explode(".",$_FILES['pan_photo']["name"]);
        $extension = end($dl);
        
        $_FILES['pan_photo']["name"] = $editUserId."_u_pan_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['pan_photo']["name"];
        $pan_number_photo = $redirectURL_user."assets/users/".$_FILES['pan_photo']["name"];  //$image_path
        move_uploaded_file( $_FILES['pan_photo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
	}

	$aadhar_number_photo = $_POST['old_aadhar_photo'];
	if($_FILES['aadhar_photo']["name"]!=''){
	    
    	$uploaddir1 = '../../assets/users/';
        $dl=explode(".",$_FILES['aadhar_photo']["name"]);
        $extension = end($dl);
        
        $_FILES['aadhar_photo']["name"] = $editUserId."_u_aadhar_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['aadhar_photo']["name"];
        $aadhar_number_photo = $redirectURL_user."assets/users/".$_FILES['aadhar_photo']["name"];  //$image_path
        move_uploaded_file( $_FILES['aadhar_photo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
	}

	mysqli_query($con,"UPDATE users_bank_detail SET bank_name='$bank_name',bank_branch='$bank_branch',bank_ifsc='$bank_ifsc',bank_account='$bank_account',pan_number='$pan_number',pan_number_photo='$pan_number_photo',aadhar_number='$aadhar_number',aadhar_number_photo='$aadhar_number_photo' where refUserId=$editUserId") or die(mysqli_error($con));

	header('location: ..?page=userList'); exit;
}
?>