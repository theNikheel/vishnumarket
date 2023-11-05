<div class="row">
    <div class="col-md-6">
    	<div class="card">
    		<div class="card-header">
    		    <h5>Website Information</h5>
    		</div>
    		<div class="card-body table-border-style">
    		    <form action="model/websiteInfoModel.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Website Title</label>
                            <input name="web_title" value="<?php echo $WEBSITE_DETAIL_DATA['web_title']; ?>" type="text" class="form-control"placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Website URL</label>
                            <input name="web_url" value="<?php echo $WEBSITE_DETAIL_DATA['web_url']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Website Email</label>
                            <input name="web_email" value="<?php echo $WEBSITE_DETAIL_DATA['web_email']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Website Phone</label>
                            <input name="web_phone" value="<?php echo $WEBSITE_DETAIL_DATA['web_phone']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Address</label>
                            <textarea name="web_address" class="form-control" rows="4"><?php echo $WEBSITE_DETAIL_DATA['web_address']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">About Us</label>
                            <textarea name="web_aboutUs" class="form-control" rows="4"><?php echo $WEBSITE_DETAIL_DATA['web_aboutUs']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Website Logo</label>
                            <div class="input-group mb-3">
                                <!--<input type="hidden" name="web_logo_old" value="<?php echo $WEBSITE_DETAIL_DATA['web_logo']; ?>">-->
                                <div class="custom-file">
                                    <input name="web_logo" type="file" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>          
                    
                    <input value="Update Website Information" name="updateWebsiteInfo" class="btn  btn-primary" type="submit">
                    
                </form>
    		</div>
    	</div>
    </div>
    
    <div class="col-md-6">
    	<div class="card">
    		<div class="card-header">
    		    <h5>Bank Details</h5>
    		</div>
    		<div class="card-body table-border-style">
    		    <form action="model/websiteInfoModel.php" method="post">
    		        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Bank Name</label>
                            <input name="web_bank_name" value="<?php echo $WEBSITE_DETAIL_DATA['web_bank_name']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Bank Branch</label>
                            <input name="web_bank_branch" value="<?php echo $WEBSITE_DETAIL_DATA['web_bank_branch']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Bank IFSC</label>
                            <input name="web_bank_ifsc" value="<?php echo $WEBSITE_DETAIL_DATA['web_bank_ifsc']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Account Number</label>
                            <input name="web_bank_account" value="<?php echo $WEBSITE_DETAIL_DATA['web_bank_account']; ?>" type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    
                    <input value="Update Bank Information" name="updateBankInfo" class="btn  btn-primary" type="submit">
                    
    		    </form>
    		</div>
    	</div>
    	
    	<div class="card">
    		<div class="card-header">
    		    <h5>My QR Code</h5>
    		</div>
    		<div class="card-body table-border-style">
    		    <div class="row">
    		        
        		    <div class="col-md-8">
            		    <form action="model/websiteInfoModel.php" method="post" enctype="multipart/form-data">
            		        <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">QR Code</label>
                                    <div class="input-group ">
                                        
                                        <div class="custom-file">
                                            <input name="web_qrCode" type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <input value="Update QR Code" name="updateQRInfo" class="btn  btn-primary" type="submit">
                    
                        </form>	
                    </div>
        		    <div class="col-md-4">
        		        <img src="<?php echo $WEBSITE_DETAIL_DATA['web_qrCode']; ?>" style="width:100%">
        		    </div>
                </div>
            </div>
        </div>
    </div>
</div>