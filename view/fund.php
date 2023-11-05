<!-- [ Main Content ] start -->
<?php $loginID = $_SESSION['loginId']; ?>
<div class="row">
    <!-- [ horizontal-layout ] start -->
    <div class="col-sm-5">
        <div class="card">
            <div class="card-header">
                <h5>My Wallet</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="javascript:void(0)"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="javascript:void(0)"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            
                        </thead>
                        <tbody>
                            
                            <?php
                            $amount = $PERSONAL_DATA_RESULT['amount'];
                            $investAmount = $PERSONAL_DATA_RESULT['investAmount'];
                            
                            $availableWallet = (int)$amount - (int)$investAmount;
                            ?>
                            
                            <tr>
                                <td>Available Wallet Balance</td>
                                <td class="text-right"><label class="badge badge-light-primary"><?php echo $availableWallet; ?></label></td>
                            </tr>
                            <tr>
                                <td>Invest Amount</td>
                                <td class="text-right"><label class="badge badge-light-success"><?php echo $PERSONAL_DATA_RESULT['investAmount']; ?></label></td>
                            </tr>
                            
                            <?php
                            $investAmount = $PERSONAL_DATA_RESULT['investAmount'];
                            $showAmount = $PERSONAL_DATA_RESULT['showAmount'];
                            
                            $profit_amt = (int)$showAmount-(int)$investAmount;
                            
                            $cls_currentNetwork = "badge-light-danger";
                            if($profit_amt>0){
                                $cls_currentNetwork = "badge-light-success";    
                            }
                            
                            if($showAmount==""){
                                //$showAmount = $userAmount - $userPortfolioRevenue;
                                $showAmount = 0;
                                $profit_amt = 0;
                            }
                            if($showAmount==0){
                                $profit_amt =0;
                            }
                            
                            ?>
                            
                            <tr>
                                <td>Current Networth</td>
                                <td class="text-right"><label class="badge <?php echo $cls_currentNetwork; ?>"><?php echo $showAmount; ?></label></td>
                            </tr>
                            <tr>
                                <td>P & L</td>
                                <td class="text-right"><label class="badge <?php echo $cls_currentNetwork; ?>"><?php echo $profit_amt; ?></label></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
        <div class="card">
            <div class="card-header">
                <h5>My Bank Details</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="javascript:void(0)"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="javascript:void(0)"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            $RETURN_DATA = userBankDetailsFun($loginID);
            $BANK_DATA_RESULT = $RETURN_DATA['bankDetailData'];
            ?>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bank Name</td>
                                <td><label><?php echo $BANK_DATA_RESULT['bank_name']; ?></label></td>
                            </tr>
                            <tr>
                                <td>Bank Branch</td>
                                <td><label><?php echo $BANK_DATA_RESULT['bank_branch']; ?></label></td>
                            </tr>
                            <tr>
                                <td>IFSC Code</td>
                                <td><label><?php echo $BANK_DATA_RESULT['bank_ifsc']; ?></label></td>
                            </tr>
                            <tr>
                                <td>Account Number</td>
                                <td><label><?php echo $BANK_DATA_RESULT['bank_account']; ?></label></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </div>
    
    <div class="col-sm-7">
        <div class="card">
            <div class="card-header">
                <h5>New Transcation</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="javascript:void(0)"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="javascript:void(0)"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <a class="btn mb-1 btn-primary" href="javascript:void(0)">Deposite</a>
                <a class="btn mb-1 btn-secondary" href="javascript:void(0)" data-toggle="modal" data-target="#withdrawalModal">Withdrawal</a>
                
                <div >
                    <br/>
					<p><b>Step 1.</b> Payment using QR CODE or Bank Details</p>
				    <p><b>Step 2.</b> Click on <b>"Vertify Payment"</b> option and upload screenshot with transcation id </p>
				    <div class="row">
					    <div class="col-md-4 p-0">
					        <img src="<?php echo $WEBSITE_DETAIL_DATA['web_qrCode']; ?>?=<?php echo strtotime(date('c'));?>" style="width:100%">
					    </div>
				    
					    <div class="col-md-8 p-0">
					        <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead></thead>
                                    <tbody>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td><label><?php echo $WEBSITE_DETAIL_DATA['web_bank_name']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Branch</td>
                                            <td><label><?php echo $WEBSITE_DETAIL_DATA['web_bank_branch']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td>IFSC Code</td>
                                            <td><label><?php echo $WEBSITE_DETAIL_DATA['web_bank_ifsc']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td>Account Number</td>
                                            <td><label><?php echo $WEBSITE_DETAIL_DATA['web_bank_account']; ?></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
					    <div class="col-md-12">
					        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#depositeModal">Verify Your Payment</button>
					    </div>
					</div>
				</div>
					
				
                
            </div>
        </div>
        
    </div>
    
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>My Transcations History</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="javascript:void(0)"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="javascript:void(0)"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            $RETURN_DATA = userTransactionDetailsFun($loginID);
            $TRANSCATION_DATA_RESULT = $RETURN_DATA['listData'];
            ?>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $LP=0;
                        foreach($TRANSCATION_DATA_RESULT as $VAL){ 
                            $LP++;
                            $TRANS_TYPE = $VAL['transType'];
                            if($TRANS_TYPE=='Deposite'){
                                $STATUS_ARRAY = $TRANSCATION_DEPOSITE_STATUS;
                            }else{
                                $STATUS_ARRAY = $TRANSCATION_WITHDRAWL_STATUS;
                            }
                            $TRANS_DATE = $VAL['transDate'];
                            $TRANS_AMT = $VAL['transAmt'];
                            $status = $VAL['status'];
                            $TRANS_STATUS_EXP = explode("|",$STATUS_ARRAY[$status]);
                            $TRANS_STATUS = $TRANS_STATUS_EXP[0];
                            $ROW_CLASS = $TRANS_STATUS_EXP[1];
                            ?>
                            <tr class="<?php echo $ROW_CLASS; ?>">
                                <td><?php echo $LP; ?></td>
                                <td><?php echo $TRANS_TYPE; ?></td>
                                <td><?php echo $TRANS_DATE; ?></td>
                                <td><?php echo $TRANS_AMT; ?></td>
                                <td><?php echo $TRANS_STATUS; ?></td>
                                <!-- <td></td> -->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    
    
    <div class="col-sm-6">
        
    </div>
    
    
    
    
    
</div>


<div class="modal fade" id="depositeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <form id="depositeForm" enctype="multipart/form-data" method="post" action="model/userTransactionModel.php">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Deposite Payment Verification</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			</div>
    			<div class="modal-body">
				
				    <input type="hidden" value="<?php echo $loginID; ?>" name="refUserId">
				    <input type="hidden" value="Deposite" name="transType">
				    <div class="row">
    					<div class="col-md-6 ml-auto">
    						<label for="recipient-name" class="col-form-label">Date:</label>
    						<input type="text" class="form-control" id="recipient-name" name="transDate" value="<?php echo $curretDate; ?>">
    					</div>
    					<div class="col-md-6 ml-auto">
    						<label for="recipient-name" class="col-form-label">Amount:</label>
    						<input type="text" class="form-control" id="recipient-name" name="transAmt">
    					</div>
    				</div>
					<div class="form-group">
						<label for="transcation-text" class="col-form-label">Transcation Id:</label>
						<input type="text" class="form-control" id="transcation-name" name="transId">
					</div>
					
					<div class="form-group">
						<label for="transcation-screen" class="col-form-label" style="display: block;">Transcation Screenshot:</label>
						<input type="file" id="transcation-screen" name="transImg">
					</div>
				
    			</div>
    			<div class="modal-footer">
    				<input type="submit" name="submitDeposite" class="btn  btn-primary" value="Submit">
    			</div>
    		</form>
		</div>
	</div>
</div>


<div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <form id="withdrawalForm" enctype="multipart/form-data" method="post" action="model/userTransactionModel.php">
				
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Withdrawal Payment Form</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			</div>
    			<div class="modal-body">
				    <input type="hidden" value="<?php echo $loginID; ?>" name="refUserId">
				    <input type="hidden" value="Withdrawal" name="transType">
				    <input type="hidden" value="<?php echo $curretDate; ?>" name="transDate">
				    
				    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Available Balance</span>
                        </div>
                        <input type="text" value="<?php echo $availableWallet; ?>" readonly class="form-control" aria-label="Available Balance" aria-describedby="inputGroup-sizing-default">
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Withdrawal Amount</span>
                        </div>
                        <input name="transAmt" type="text" class="form-control" aria-label="Withdrawal Amount" aria-describedby="inputGroup-sizing-default">
                    </div>
    			</div>
    			<div class="modal-footer">
    				<button type="submit" name="submitWithdrawal" class="btn  btn-primary">Submit</button>
    			</div>
			</form>
		</div>
	</div>
</div>
