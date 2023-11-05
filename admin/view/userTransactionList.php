<style>
.editableCls .badge {
    font-size: 82%;
    padding: 5px 4px;
    min-width: 78px;
}
</style>
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
		    <h5>User Transaction List</h5>		    
		</div>
		<div class="card-body table-border-style">
		    <div class="table-responsive">
		        <table class="table editableCls table-inverse">
		            <thead>
		                <tr>
		                    <th>#</th>
		                    <th>Client-Id / Name</th>
		                    
		                    <th>Date</th>
		                    <th>Transaction Id</th>

		                    <th>Status</th>
		                    <th>Amount</th>
		                    
		                    <th>Action</th>
		                </tr>
		            </thead>
		            <tbody>
		        	<?php
		        	$l=0;
		        	$SQL_ALL_TRANSACTION = mysqli_query($con,"SELECT * FROM transcation order by id desc");
		        	while ($FETCH_ALL_TRANSACTION = mysqli_fetch_assoc($SQL_ALL_TRANSACTION)) {
		        		$l++;

		        		$AUTO_TRANSACTION_ID = $FETCH_ALL_TRANSACTION['id'];

		        		$refUserId = $FETCH_ALL_TRANSACTION['refUserId'];
		        		$SQL_USERS = mysqli_query($con,"SELECT id,clientId,concat(fname,' ',lname) as fullCustName,amount,investAmount FROM users where id=$refUserId");
		        		$FETCH_USERS = mysqli_fetch_assoc($SQL_USERS);
		        	    $AUTO_USER_ID = $FETCH_USERS['id'];
		        		$amount = $FETCH_USERS['amount'];
		        		$investAmount = $FETCH_USERS['investAmount'];

		        		$transType = $FETCH_ALL_TRANSACTION['transType'];
		        		if($transType=='Deposite'){
		                    $itemTransType = "<span class='badge badge-success'>".$transType."</span>";
		                    $STATUS_ARRAY = $TRANSCATION_DEPOSITE_STATUS;
		                    $ACTION_ARRAY = array("4|Decline","4|Confirm");
		                }else{
		                    $itemTransType = "<span class='badge badge-danger'>".$transType."</span>";
		                    $STATUS_ARRAY = $TRANSCATION_WITHDRAWL_STATUS;
		                    $ACTION_ARRAY = array("2|Initialize","3|Decline","4|Confirm");
		                }


                        $status = $FETCH_ALL_TRANSACTION['status'];
                        $TRANS_STATUS_EXP = explode("|",$STATUS_ARRAY[$status]);
                        
                        $TRANS_STATUS = "Pending"; //$TRANS_STATUS_EXP[0];
                        if($status==3)
                        {
                        	$TRANS_STATUS = "Decline";
                        }

                        if($status==4)
                        {
                        	$TRANS_STATUS = "Completed";
                        }
                        
                        $ROW_CLASS = $TRANS_STATUS_EXP[1];

                        $transDateExp = explode(" ",$FETCH_ALL_TRANSACTION['transDate']);
		        	
		        	?>

		        		<tr class="<?php echo $ROW_CLASS; ?>">
		        			<td><?php echo $l;?></td>
		        			<td><span class="badge badge-primary"><?php echo ($FETCH_USERS['clientId']=='') ? 'NO CLIENT ID' : $FETCH_USERS['clientId']; ?></span><br/><?php echo $FETCH_USERS['fullCustName']; ?>
		        			</td>
		        			
		        			<td><?php echo $transDateExp[0]." ".$transDateExp[1]." ".$transDateExp[2]; ?></td>
		        			<td><?php echo $FETCH_ALL_TRANSACTION['transId']; ?></td>
		        			<td><?php echo $TRANS_STATUS; ?></td>
		        			<td>
		        				<?php $wallet = $amount-$investAmount; echo "Available: ".$wallet; ?><br/>
		        				<?php echo "Request: ".$FETCH_ALL_TRANSACTION['transAmt']; ?></td>
		        			
		        			
		        			<td>
		        				<?php echo $itemTransType; ?><br/>
		        				<select onchange="changeTransactionStatusFun(this,<?php echo $AUTO_TRANSACTION_ID; ?>,<?php echo $AUTO_USER_ID; ?>,this.value)">
		        					<?php if($status==0){ ?> 
		        						<option value="0">Select Action</option>
		        					<?php } ?>
		        					<?php foreach($ACTION_ARRAY as $A_V){ 
		        						$A_V_Exp = explode("|", $A_V);
		        						$optionVal = $A_V_Exp['0'];
		        					?>
		        						<option <?php if($status==$optionVal){ ?> selected='selected' <?php } ?> value="<?php echo $optionVal; ?>"><?php echo $A_V_Exp['1']; ?></option>
	

	        					<?php } ?>
		        				</select>
		        			</td>
		        		</tr>
		        	<?php } ?>
		        	</tbody>
		        </table>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">
function changeTransactionStatusFun(thisObj,transId,refUserId,val){
	//alert("here");
	if(confirm('Are you sure want to update?')){
		if(val!=""){
			$.ajax({
		        type:'POST',
		        data:"userTransactionUpdate=userTransactionUpdate&transId="+transId+"&refUserId="+refUserId+"&changeStatus="+val,
		        url:'model/ajaxDataModel.php',
		        success: function(data){
		    		$(thisObj).find('[value="0"]').remove();
		    		//$(".ct option[value='X']").remove();
		    	}
		    });
		}
	}
}
</script>