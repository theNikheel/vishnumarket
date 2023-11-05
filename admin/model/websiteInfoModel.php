<?php
include('../../config/config.php');

if(isset($_POST['updateWebsiteInfo'])){
    
    unset($_POST['updateWebsiteInfo']);
    //unset($_POST['web_logo']);
    $queryVal_arr = array();
    foreach($_POST as $k_p => $v_p){
        $queryVal_arr[] = $k_p."='".mysqli_real_escape_string($con,$v_p)."'";
    }
    $queryVal = implode(",",$queryVal_arr);
    //echo $queryVal; die;
    mysqli_query($con,"UPDATE website SET $queryVal");
    
    if($_FILES['web_logo']["name"]!=''){
    	$uploaddir1 = '../../assets/website/';
        $dl=explode(".",$_FILES['web_logo']["name"]);
        $extension = end($dl);
        
        $_FILES['web_logo']["name"] = "w_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['web_logo']["name"];
        $web_logo_url = $redirectURL_user."assets/website/".$_FILES['web_logo']["name"];  //$image_path
        move_uploaded_file( $_FILES['web_logo']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
        
        mysqli_query($con,"UPDATE website SET web_logo='$web_logo_url'");
	}
}

if(isset($_POST['updateBankInfo'])){
    unset($_POST['updateBankInfo']);
    $queryVal_arr = array();
    foreach($_POST as $k_p => $v_p){
        $queryVal_arr[] = $k_p."='".mysqli_real_escape_string($con,$v_p)."'";
    }
    $queryVal = implode(",",$queryVal_arr);
    //echo $queryVal; die;
    
    mysqli_query($con,"UPDATE website SET $queryVal");
}

if(isset($_POST['updateQRInfo'])){
    unset($_POST['updateQRInfo']);
    
    if($_FILES['web_qrCode']["name"]!=''){
    	$uploaddir1 = '../../assets/website/';
        $dl=explode(".",$_FILES['web_qrCode']["name"]);
        $extension = end($dl);
        
        $_FILES['web_qrCode']["name"] = "qr_".strtotime(date("Y/m/d H:i:s")).".".$extension;
           
        $uploadfile1 = $uploaddir1.$_FILES['web_qrCode']["name"];
        $web_logo_url = $redirectURL_user."assets/website/".$_FILES['web_qrCode']["name"];  //$image_path
        move_uploaded_file( $_FILES['web_qrCode']['tmp_name'],$uploadfile1) or die( "Could not copy file 2!");
        
        mysqli_query($con,"UPDATE website SET web_qrCode='$web_logo_url'");
	}
}


header('location: ../?page=websiteInfo'); exit;
?>