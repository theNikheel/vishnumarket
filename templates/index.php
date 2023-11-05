<?php

include "header.php";

//if($include=='view/login.php'){
if(!isset($_SESSION['isUserLogged'])){	
	include $include;
}else{
	
	$loginID = $_SESSION['loginId'];
	$qryStatus = mysqli_query($con,"SELECT clientId,photo,fname,lname,uStatus,adminApprove,allowTrading FROM users WHERE id='$loginID'") or die(mysqli_error($con));
	$loginShortData = mysqli_fetch_assoc($qryStatus);
	$freezPanel = "";
	$uStatus = $loginShortData['uStatus'];
	$isAdminApprove = $loginShortData['adminApprove'];
	$isAllowTrading = $loginShortData['allowTrading'];
	
	if($uStatus==0){
		$freezPanel = "freezpanelCls";
		$include = 'view/profileEdit.php';
	}

	include "topmenu.php";
?>
	<div class="pcoded-main-container">
	    <div class="pcoded-wrapper container">
	        <div class="pcoded-content">
	        	<?php
	        	if($isAdminApprove==1){ ?> 
	        	<div class="page-header">
	        		<div class="page-block">
		                <div class="row align-items-center">
		                    <div class="col-md-12">
		                        <div class="page-header-title">
		                            <h3 class="m-b-10">Verification is under process.</h3>
		                            <h5 class="m-b-10">As verification completed you can start trading</h5>
		                        </div>
		                    </div>
		                </div>
		            </div>
	        	</div>
	        	<?php } ?>
	            <div class="pcoded-inner-content">
	                <div class="main-body">
	                    <div class="page-wrapper">
	                		<?php include $include; ?>
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php 
}
include "footer.php";
?>