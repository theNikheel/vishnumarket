<?php
include "../config/config.php";

if(isset($_POST['submitDeposite'])){
    $refUserId = $_POST['refUserId'];
    $transType = $_POST['transType'];
    $transDate = $_POST['transDate'];
    $transAmt = $_POST['transAmt'];
    $transId = $_POST['transId'];
    //$transDate = $_POST['transDate'];
    
    mysqli_query($con,"INSERT INTO transcation SET refUserId='$refUserId',transType='$transType',transDate='$transDate',transAmt='$transAmt',transId='$transId'");
    
    header('location: ../?page=fund'); exit;
}

if(isset($_POST['submitWithdrawal'])){
    $refUserId = $_POST['refUserId'];
    $transType = $_POST['transType'];
    $transDate = $_POST['transDate'];
    $transAmt = $_POST['transAmt'];
    
    //$transDate = $_POST['transDate'];
    
    mysqli_query($con,"INSERT INTO transcation SET refUserId='$refUserId',transType='$transType',transDate='$transDate',transAmt='$transAmt',transId='$transId'");
    
    header('location: ../?page=fund'); exit;
}

?>