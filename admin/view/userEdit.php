<?php
$editUserId = $_GET['id'];
$RETURN_DATA = userProfileFun($editUserId);

$PERSONAL_DATA_RESULT = $RETURN_DATA['personalDetailData'];
$BANK_DATA_RESULT = $RETURN_DATA['bankDetailData'];
?>

<style type="text/css">
.custom-control-input{
	position: relative;
	z-index: 0;
}
</style>

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
		    
		    <?php if($PERSONAL_DATA_RESULT['adminApprove']==1){ ?>
		    	<h5>Profile Review</h5>
		    	<a href="?page=registrationNew" class="btn  btn-secondary">Back to New Registration</a>
		    <?php } ?>
		    <?php if($PERSONAL_DATA_RESULT['adminApprove']==2){ ?>
		    	<h5>Edit Profile</h5>
		    	<a href="?page=userList" class="btn  btn-secondary">Back to User List</a>
		    <?php } ?>

		</div>
		<div class="card-body">
			
			<h5>Admin Area</h5>
			<hr class="card "/>
			<form action="model/userEditModel.php" method="post" enctype="multipart/form-data">
			    <input type="hidden" value="<?php echo $editUserId; ?>" name="editUserId">
			    <div class="form-row">
		            <div class="form-group col-md-4">
		                <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text labelCls" id="basic-addon1">
                                	Client ID 
                                	<?php if($PERSONAL_DATA_RESULT['adminApprove']==1){ echo '<span class="error">*</span>'; } ?>
                                	<?php if($PERSONAL_DATA_RESULT['adminApprove']==2){ echo $PERSONAL_DATA_RESULT['clientId']; } ?>
                                	</span>
                            </div>
                            <?php if($PERSONAL_DATA_RESULT['adminApprove']==1){ ?>
	                            <input required="required" data-labelname="Client Id" name="clientId" type="text" onblur="checkDuplicateFun(this)" class="form-control noBlankSpace onlyNumber" placeholder="ID (Ex.100100)" aria-label="Id">
	                            <p style="display: block;margin-top: revert;padding-left: 5px;" class="mb-0 resAjaxCls"></p>    
	                        <?php } ?>
                        </div>
		            </div>
		        
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">Allow Trading <span class="error">*</span></label>
		                <div style="display: block;">
			                <div class="custom-control custom-radio custom-control-inline">
	                            <input required="required" type="radio" id="customRadioInline1" name="allowTrading" class="custom-control-input" <?php if($PERSONAL_DATA_RESULT['allowTrading']=='1'){ echo "checked='checked'"; } ?> value="1">
	                            <label class="custom-control-label" for="customRadioInline1">Yes</label>
	                        </div>
	                        <div class="custom-control custom-radio custom-control-inline">
	                            <input required="required" type="radio" id="customRadioInline2" name="allowTrading" <?php if($PERSONAL_DATA_RESULT['allowTrading']== '0'){ echo "checked='checked'"; } ?> class="custom-control-input" value="0">
	                            <label class="custom-control-label" for="customRadioInline2">No</label>
	                        </div>
                        </div>
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Brokerage <span class="error">*</span></label>
		                <input required="required" type="text" class="form-control noBlankSpace onlyNumber" name="brokerage" value="<?php echo $PERSONAL_DATA_RESULT['brokerage']; ?>" placeholder="Set Brokerage">
		            </div>
		        </div>

		        <h5 class="mb-3">Personal Details</h5>
		        <hr class="card "/>

		        <div class="form-row">
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">First Name <span class="error">*</span></label>
		                <input type="text" required="required" class="form-control onlyAlphabet" id="inputEmail4" placeholder="First Name" name="fname" value="<?php echo $PERSONAL_DATA_RESULT['fname']; ?>">
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Middle Name</label>
		                <input type="text" class="form-control onlyAlphabet" id="inputPassword4" placeholder="Middle Name" name="mname" value="<?php echo $PERSONAL_DATA_RESULT['mname']; ?>">
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Last Name <span class="error">*</span></label>
		                <input type="text" required="required" class="form-control onlyAlphabet" id="inputPassword4" placeholder="Last Name" name="lname" value="<?php echo $PERSONAL_DATA_RESULT['lname']; ?>">
		            </div>
		        </div>
		        
		        <div class="form-row">
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">Email</label>
		                <input data-labelname="Email" name="email" type="email" class="form-control noBlankSpace" id="inputEmail4" placeholder="Email" value="<?php echo $PERSONAL_DATA_RESULT['email']; ?>">
		                <p class="mb-0 resAjaxCls"></p>
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">Mobile Number <span class="error">*</span></label>
		                <input name="contactNo" required="required" type="text" class="form-control noBlankSpace onlyNumber" id="inputEmail4" placeholder="Mobile Number" value="<?php echo $PERSONAL_DATA_RESULT['contactNo']; ?>">
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
		                <input name="city" required="required" placeholder="City" type="text" class="form-control onlyAlphabet" id="inputCity" value="<?php echo $PERSONAL_DATA_RESULT['city']; ?>">
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
		        <hr class="card "/>
		        <div class="form-row">
		            <div class="form-group col-md-6">
		                <label for="inputEmail4">Username <span class="error">*</span></label>
		                <input type="text" required="required" name="username" class="form-control " id="inputEmail4" placeholder="Username" value="<?php echo $PERSONAL_DATA_RESULT['username']; ?>">
		            </div>
		            <div class="col-md-6">
		                <label for="inputPassword4">Password <span class="error">*</span></label>
		                <div class="input-group">
    		                
    		                <input name="password" required="required" type="password" class="form-control" id="inputPassword" placeholder="Password" value="<?php echo $PERSONAL_DATA_RESULT['password']; ?>">
    		                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i onclick="changeType(this)" class="icon feather icon-eye-off text-c-green mb-1"></i>
                                </span>
                            </div>
                        </div>
		            </div>
		        </div>

		        <h5 class="mt-3">Bank Detail</h5>
		        <hr class="card "/>
		        <div class="form-row">
		            <div class="form-group col-md-3">
		                <label for="inputEmail4">Bank Name <span class="error">*</span></label>
		                <input type="text" required="required" name="bank_name" class="form-control onlyAlphabet" id="inputEmail4" placeholder="Bank Name" value="<?php echo $BANK_DATA_RESULT['bank_name']; ?>">
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

		        <input type="submit" name="submit" class="btn  btn-primary" value="Update Profile">

		    </form>
		</div>
    </div>
</div>

<script>
function changeType(thisvar){
    $("#inputPassword").attr("type","text");
    $(thisvar).removeClass(".icon-eye-off");
    $(thisvar).addClass(".icon-eye");
    
}
</script>