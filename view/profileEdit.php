<?php
/*$loginID = $_SESSION['loginId'];
$RETURN_DATA = userProfileFun($loginID);

$PERSONAL_DATA_RESULT = $RETURN_DATA['personalDetailData'];
$BANK_DATA_RESULT = $RETURN_DATA['bankDetailData'];*/

$nonEditBox = "nonEditBox";
if($uStatus==0){
	$nonEditBox = "";
}
?>
<style>
.labelCls{
    background-color: #f1c40f;border-color: #f1c40f;color: black;padding: 10px 24px;font-weight: bold;
}

.nonEditBox{
    pointer-events: none;
    background: lightgrey;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card1">
			<div class="card-header">
				<?php if($uStatus==0){ ?>
			    	<h5>Complete Your Profile</h5>
			    <?php } else{ ?>
			    	<h5>Update My Profile</h5>
			    <?php } ?>
			    <?php if($uStatus!=0) { ?>
			    	<a href="?page=profile" class="btn  btn-secondary">Back to My Profile</a>
			    <?php } ?>

			</div>
			<div class="card-body">
				
				<h5>Personal Detail</h5>
				<hr class="card">
				<form action="model/updateProfileModel.php" method="post" enctype="multipart/form-data">
				    <input type="hidden" value="<?php echo $loginID; ?>" name="editUserId">
				    <div class="form-row">
			            <div class="form-group col-md-4">
			                <label class="labelCls" style="">Client ID <?php echo $PERSONAL_DATA_RESULT['clientId']; ?></label>
			            </div>
			        </div>
			        <div class="form-row">
			            <div class="form-group col-md-4">
			                <label for="inputEmail4">First Name <span class="error">*</span></label>
			                <input type="text" required="required" class="form-control <?php echo $nonEditBox; ?>" id="inputEmail4" placeholder="First Name" name="fname" value="<?php echo $PERSONAL_DATA_RESULT['fname']; ?>">
			            </div>
			            <div class="form-group col-md-4">
			                <label for="inputPassword4">Middle Name</label>
			                <input type="text" class="form-control  <?php echo $nonEditBox; ?>" id="inputPassword4" placeholder="Middle Name" name="mname" value="<?php echo $PERSONAL_DATA_RESULT['mname']; ?>">
			            </div>
			            <div class="form-group col-md-4">
			                <label for="inputPassword4">Last Name <span class="error">*</span></label>
			                <input type="text" required="required" class="form-control  <?php echo $nonEditBox; ?>" id="inputPassword4" placeholder="Last Name" name="lname" value="<?php echo $PERSONAL_DATA_RESULT['lname']; ?>">
			            </div>
			        </div>
			        
			        <div class="form-row">
			            <div class="form-group col-md-4">
			                <label for="inputEmail4">Email <span class="error">*</span></label>
			                <input name="email" type="email" class="form-control nonEditBox" id="inputEmail4" placeholder="Email" value="<?php echo $PERSONAL_DATA_RESULT['email']; ?>">
			            </div>
			            <div class="form-group col-md-4">
			                <label for="inputEmail4">Mobile Number <span class="error">*</span></label>
			                <input name="contactNo" type="text" class="form-control nonEditBox onlyNumber" id="inputEmail4" placeholder="Mobile Number" value="<?php echo $PERSONAL_DATA_RESULT['contactNo']; ?>">
			            </div>

			            <div class="form-group col-md-4">
			            	<label for="inputEmail4">Photo</label>
			            	<div class="custom-file">
			            	    <input type="hidden" value="<?php echo $PERSONAL_DATA_RESULT['photo']; ?>" name="old_user_photo">
			                    <input type="file" name="user_photo" class="custom-file-input" id="inputGroupFile02">
			                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
			                </div>                                
			            </div>
			        </div>

			        <div class="form-row">
			            <div class="form-group col-md-6">
			                <label for="inputAddress">Address <span class="error">*</span></label>
			                <textarea name="address" required="required" class="form-control" id="inputAddress" placeholder="1234 Main St"><?php echo $PERSONAL_DATA_RESULT['address']; ?></textarea>
			            </div>
			        </div>
			        <div class="form-row">
			            <div class="form-group col-md-2">
			                <label for="inputCity">City <span class="error">*</span></label>
			                <input name="city" required="required" placeholder="City" type="text" class="form-control" id="inputCity" value="<?php echo $PERSONAL_DATA_RESULT['city']; ?>">
			            </div>
			            <div class="form-group col-md-2">
			                <label for="inputState">State <span class="error">*</span></label>
			                <input name="state" required="required" placeholder="State" type="text" class="form-control" id="inputState" value="<?php echo $PERSONAL_DATA_RESULT['state']; ?>">
			            </div>
			            <div class="form-group col-md-2">
			                <label for="inputZip">Zip <span class="error">*</span></label>
			                <input name="zip" required="required" placeholder="Zip" type="text" class="form-control onlyNumber" id="inputZip" value="<?php echo $PERSONAL_DATA_RESULT['zip']; ?>">
			            </div>
			        </div>
			        
			        
			        <h5 class="mt-3">Login Detail</h5>
			        <hr class="card" />
			        <div class="form-row">
			            <div class="form-group col-md-6">
			                <label for="inputEmail4">Username <span class="error">*</span></label>
			                <input type="text" name="username" class="form-control nonEditBox" id="inputEmail4" placeholder="Username" value="<?php echo $PERSONAL_DATA_RESULT['username']; ?>">
			            </div>
			            <div class="form-group col-md-6">
			                <label for="inputPassword4">Password <span class="error">*</span></label>
			                <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Password" value="<?php echo $PERSONAL_DATA_RESULT['password']; ?>">
			            </div>
			        </div>

			        <h5 class="mt-3">Bank Detail</h5>
			        <hr class="card" />
			        <div class="form-row">
			            <div class="form-group col-md-3">
			                <label for="inputEmail4">Bank Name <span class="error">*</span></label>
			                <input type="text" required="required" name="bank_name" class="form-control" id="inputEmail4" placeholder="Bank Name" value="<?php echo $BANK_DATA_RESULT['bank_name']; ?>">
			            </div>
			            <div class="form-group col-md-3">
			                <label for="inputPassword4">Branch Name <span class="error">*</span></label>
			                <input name="bank_branch" required="required" type="text" class="form-control" id="inputPassword4" placeholder="Branch Name" value="<?php echo $BANK_DATA_RESULT['bank_branch']; ?>">
			            </div>
			            <div class="form-group col-md-2">
			                <label for="inputPassword4">IFSC Code <span class="error">*</span></label>
			                <input name="bank_ifsc" required="required" type="text" class="form-control" id="inputPassword4" placeholder="IFSC Code" value="<?php echo $BANK_DATA_RESULT['bank_ifsc']; ?>">
			            </div>
			            <div class="form-group col-md-4">
			                <label for="inputPassword4">Account Number <span class="error">*</span></label>
			                <input name="bank_account" required="required" type="text" class="form-control onlyNumber" id="inputPassword4" placeholder="Account Number" value="<?php echo $BANK_DATA_RESULT['bank_account']; ?>">
			            </div>
			        </div>

			        <h5 class="mt-3">Proof Detail</h5>
			        <hr class="card "/>
			        <div class="form-row">
			        	<div class="form-group col-md-6">
			            	<label for="inputEmail4">Pan Card <span class="error">*</span></label>
			            	<input required="required" name="pan_number" type="text" class="form-control mb-2 noBlankSpace" id="inputPassword4" placeholder="PAN Number" value="<?php echo $BANK_DATA_RESULT['pan_number']; ?>">

			            	<div class="custom-file">
			            		<input type="hidden" name="old_pan_photo" value="<?php echo $BANK_DATA_RESULT['pan_number_photo']; ?>">
			                    <input type="file" name="pan_photo" class="custom-file-input" id="inputGroupFile02">
			                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
			                </div>

			                <?php if($BANK_DATA_RESULT['pan_number_photo']!=""){ ?> 
			                	<img class="mt-2" src="<?php echo $BANK_DATA_RESULT['pan_number_photo']; ?>" style="width: 100px;">
			                <?php } ?>

			            </div>

			            <div class="form-group col-md-6">
			            	<label for="inputEmail4">Aadhar Number <span class="error">*</span></label>
			            	<input required="required" name="aadhar_number" type="text" class="form-control mb-2 noBlankSpace onlyNumber" id="inputPassword4" placeholder="Aadhar Number" value="<?php echo $BANK_DATA_RESULT['aadhar_number']; ?>">

			            	<div class="custom-file">
			            		<input type="hidden" name="old_aadhar_photo" value="<?php echo $BANK_DATA_RESULT['aadhar_number_photo']; ?>">
			                    <input type="file" name="aadhar_photo" class="custom-file-input" id="inputGroupFile02">
			                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
			                </div>    
			                <?php if($BANK_DATA_RESULT['aadhar_number_photo']!=""){ ?> 
			                	<img class="mt-2" src="<?php echo $BANK_DATA_RESULT['aadhar_number_photo']; ?>" style="width: 100px;">
			                <?php } ?>                            
			            </div>
			        </div>

			        <input type="hidden" name="uStatus" value="<?php echo $PERSONAL_DATA_RESULT['uStatus']; ?>">
			        <input type="hidden" name="adminApprove" value="<?php echo $PERSONAL_DATA_RESULT['adminApprove']; ?>">

			        <input type="submit" name="submit" class="btn  btn-primary" value="Update Profile">
			    </form>
			</div>
	    </div>
	</div>
</div>