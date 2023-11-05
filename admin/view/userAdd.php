<style>

</style>
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
		    <h5>Registered New User</h5>
		    <a href="?page=userList" class="btn  btn-secondary">Back to User List</a>

		</div>
		<div class="card-body">
			<form action="model/userAddModel.php" method="post" enctype="multipart/form-data">
				<h5>Admin Area</h5>
				<hr class="card "/>
			    <div class="form-row">
			        <div class="form-group col-md-4">
		                <!-- <label class="" style="">Client ID</label> -->
			            <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text labelCls" id="basic-addon1">Client ID <span class="error">*</span></span>
                            </div>
                            <input required="required" data-labelname="Client Id" name="clientId" type="text" onblur="checkDuplicateFun(this)" class="form-control noBlankSpace onlyNumber" placeholder="ID (Ex.100100)" aria-label="Id">
                            <p style="display: block;margin-top: revert;padding-left: 5px;" class="mb-0 resAjaxCls"></p>    
                        </div>                        
                    </div>

                    <div class="form-group col-md-4">
		                <label for="inputEmail4">Allow Trading <span class="error">*</span></label>
		                <div style="display: block;">
			                <div class="custom-control custom-radio custom-control-inline">
	                            <input required="required" type="radio" id="customRadioInline1" name="allowTrading" class="custom-control-input" value="1">
	                            <label class="custom-control-label" for="customRadioInline1">Yes</label>
	                        </div>
	                        <div class="custom-control custom-radio custom-control-inline">
	                            <input required="required" type="radio" id="customRadioInline2" name="allowTrading" class="custom-control-input" value="0">
	                            <label class="custom-control-label" for="customRadioInline2">No</label>
	                        </div>
                        </div>
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Brokerage <span class="error">*</span></label>
		                <input required="required" type="text" class="form-control noBlankSpace onlyNumber" name="brokerage" value="" placeholder="Set Brokerage">
		            </div>
                </div>
                
                <h5>Personal Detail</h5>
				<hr class="card "/>
		        <div class="form-row">
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">First Name <span class="error">*</span></label>
		                <input type="text" class="form-control onlyAlphabet" required="required" placeholder="First Name" name="fname">
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Middle Name</label>
		                <input type="text" class="form-control onlyAlphabet" placeholder="Middle Name" name="mname">
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Last Name <span class="error">*</span></label>
		                <input type="text" class="form-control onlyAlphabet" required="required" placeholder="Last Name" name="lname">
		            </div>
		        </div>
		        
		        <div class="form-row">
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">Email <span class="error">*</span></label>
		                <input required="required" data-labelname="Email" name="email" type="email" onblur="checkDuplicateFun(this)" class="form-control noBlankSpace" id="inputEmail4" placeholder="Email">
		                <p class="mb-0 resAjaxCls"></p>
		            </div>
		            
		            <div class="form-group col-md-4">
		                <label for="inputEmail4">Mobile Number <span class="error">*</span></label>
		                <input data-labelname="Mobile Number" required="required" onblur="checkDuplicateFun(this)" name="contactNo" type="text" class="form-control noBlankSpace onlyNumber" id="inputEmail4" placeholder="Mobile Number">
		                <p class="mb-0 resAjaxCls"></p>
		            </div>

		            <div class="form-group col-md-4">
		            	<label for="inputEmail4">Photo</label>
		            	<div class="custom-file">
		                    <input type="file" name="user_photo" class="custom-file-input" id="inputGroupFile02">
		                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
		                </div>                                
		            </div>

		        </div>

		        <div class="form-row">
		            <div class="form-group col-md-6">
		                <label for="inputAddress">Address <span class="error">*</span></label>
		                <textarea name="address" required="required" class="form-control" id="inputAddress" placeholder="1234 Main St"></textarea>
		            </div>
		        </div>
		        <div class="form-row">
		            <div class="form-group col-md-2">
		                <label for="inputCity">City <span class="error">*</span></label>
		                <input name="city" required="required" placeholder="City" type="text" class="form-control onlyAlphabet" id="inputCity">
		            </div>
		            <div class="form-group col-md-2">
		                <label for="inputState">State <span class="error">*</span></label>
		                <input name="state" required="required" placeholder="State" type="text" class="form-control" id="inputState">
		            </div>
		            <div class="form-group col-md-2">
		                <label for="inputZip">Zip <span class="error">*</span></label>
		                <input name="zip" required="required" placeholder="Zip" type="text" class="form-control onlyNumber" id="inputZip">
		            </div>
		        </div>
		        
		        
		        <h5 class="mt-3">Login Detail</h5>
		        <hr class="card "/>
		        <div class="form-row">
		            <div class="form-group col-md-6">
		                <label for="inputEmail4">Username <span class="error">*</span></label>
		                <input data-labelname="Username" required="required" onblur="checkDuplicateFun(this)" type="text" name="username" class="form-control noBlankSpace onlyAlphabet" id="inputEmail4" placeholder="Username">
		                <p class="mb-0 resAjaxCls"></p>
		            </div>
		            <div class="form-group col-md-6">
		                <label for="inputPassword4">Password <span class="error">*</span></label>
		                <input name="password" required="required" type="password" class="form-control" id="inputPassword4" placeholder="Password">
		            </div>
		        </div>

		        <h5 class="mt-3">Bank Detail</h5>
		        <hr class="card "/>
		        <div class="form-row">
		            <div class="form-group col-md-3">
		                <label for="inputEmail4">Bank Name <span class="error">*</span></label>
		                <input type="text" required="required" name="bank_name" class="form-control onlyAlphabet" id="inputEmail4" placeholder="Bank Name">
		            </div>
		            <div class="form-group col-md-3">
		                <label for="inputPassword4">Branch Name <span class="error">*</span></label>
		                <input name="bank_branch" required="required" type="text" class="form-control" id="inputPassword4" placeholder="Branch Name">
		            </div>
		            <div class="form-group col-md-2">
		                <label for="inputPassword4">IFSC Code <span class="error">*</span></label>
		                <input name="bank_ifsc" required="required" type="text" class="form-control" id="inputPassword4" placeholder="IFSC Code">
		            </div>
		            <div class="form-group col-md-4">
		                <label for="inputPassword4">Account Number <span class="error">*</span></label>
		                <input name="bank_account" required="required" type="text" class="form-control onlyNumber" id="inputPassword4" placeholder="Account Number">
		            </div>
		        </div>


		        <h5 class="mt-3">Proof Detail</h5>
		        <hr class="card "/>
		        <div class="form-row">
		        	<div class="form-group col-md-6">
		            	<label for="inputEmail4">Pan Card <span class="error">*</span></label>
		            	<input name="pan_number" required="required" type="text" class="form-control mb-2 noBlankSpace" id="inputPassword4" placeholder="PAN Number">

		            	<div class="custom-file">
		                    <input type="file" name="pan_photo" class="custom-file-input" id="inputGroupFile02">
		                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
		                </div>                                
		            </div>

		            <div class="form-group col-md-6">
		            	<label for="inputEmail4">Aadhar Number <span class="error">*</span></label>
		            	<input name="aadhar_number" required="required" type="text" class="form-control mb-2 noBlankSpace onlyNumber" id="inputPassword4" placeholder="Aadhar Number">
		            	<div class="custom-file">
		                    <input type="file" name="aadhar_photo" class="custom-file-input" id="inputGroupFile02">
		                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
		                </div>                                
		            </div>
		        </div>

		        <input type="submit" name="submit" class="btn  btn-primary" value="Submit Details">
		    </form>
		</div>
    </div>
</div>