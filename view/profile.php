<?php
/*$loginID = $_SESSION['loginId'];
$RETURN_DATA = userProfileFun($loginID);

$PERSONAL_DATA_RESULT = $RETURN_DATA['personalDetailData'];

$BANK_DATA_RESULT = $RETURN_DATA['bankDetailData'];*/
?>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>My Profile</h5>
                <a href="?page=profileEdit" class="btn  btn-primary">Edit Profile</a>
            </div>
            <div class="card-body">
            	<div class="row">
	            	<div class="col-md-4">
	            	    <div class="imgDiv">
	            		    <img src="<?php echo $PERSONAL_DATA_RESULT['photo']; ?>">
	            		</div>
	            		
	            	</div>
	            	<div class="col-md-8">
	            		<h5 class="card-title"><?php echo $PERSONAL_DATA_RESULT['fname']." ".$PERSONAL_DATA_RESULT['mname']." ".$PERSONAL_DATA_RESULT['lname']; ?> <?php if($PERSONAL_DATA_RESULT['clientId']!=''){ echo "(".$PERSONAL_DATA_RESULT['clientId'].")"; } ?></h5>
	            	</div>
            	</div>
            	<div class="row">
	            	<div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Personal Detail</h5>
                            </div>
                            
    	            	    <div class="p-2 table-responsive">
                                <table class="table table-inverse">
                                    <thead>
                                        
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Address</td>
                                            <td><?php echo $PERSONAL_DATA_RESULT['address']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>City</td>
                                            <td><?php echo $PERSONAL_DATA_RESULT['city']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td><?php echo $PERSONAL_DATA_RESULT['state']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Zipcode</td>
                                            <td><?php echo $PERSONAL_DATA_RESULT['zip']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $PERSONAL_DATA_RESULT['email']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Phone</td>
                                            <td><?php echo $PERSONAL_DATA_RESULT['contactNo']; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
            	        <!-- <p class="card-text">
	            		    <i class="feather icon-mail"></i> 
	            		    <i class="feather icon-phone"></i> <?php echo $PERSONAL_DATA_RESULT['contactNo']; ?>
	            		</p>
	            		<p class="card-text">
	            		    <?php echo $PERSONAL_DATA_RESULT['address']; ?>
	            			<?php if($PERSONAL_DATA_RESULT['city']!=""){ echo ", ".$PERSONAL_DATA_RESULT['city']; } ?>
	            			<?php if($PERSONAL_DATA_RESULT['state']!=""){ echo ", ".$PERSONAL_DATA_RESULT['state']; } ?>
	            			<?php if($PERSONAL_DATA_RESULT['zip']!=""){ echo ", ".$PERSONAL_DATA_RESULT['zip']; } ?>
	            		</p> -->
	            	</div>
                    
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Bank Detail</h5>
                            </div>
                            <div class="p-2 table-responsive">
                                <table class="table table-inverse">
                                    <thead>
                                        
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td><?php echo $BANK_DATA_RESULT['bank_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Branch</td>
                                            <td><?php echo $BANK_DATA_RESULT['bank_branch']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>IFSC Code</td>
                                            <td><?php echo $BANK_DATA_RESULT['bank_ifsc']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Account Number</td>
                                            <td><?php echo $BANK_DATA_RESULT['bank_account']; ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
	            </div>
            </div>
        </div>
    </div>
</div>