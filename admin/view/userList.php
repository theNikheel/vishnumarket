<?php include "view/commonHeader.php"; ?>

<style type="text/css">
.infoDiv span{
	padding: 1px 11px;
    border: 1px solid;
    margin-right: 8px;
}
.newUserInfo{
	background-color: #d6d8db;
}
.activeUserInfo{
	background-color: #92e4b5;
}
.nonActiveUserInfo{
	background-color: #f8cdc8;
}
.brokerageCls{
	padding: 10px !important;
    background-color: white;
    border: 1px solid #000;
    color: black;
}
.tradingCls{
	width: 100%;
	padding: 6px;
}
</style>

<?php
$filterStatus = "all"; $sqlWhere = "";
if(isset($_POST['filterStatus']))
{		        		
	if($_POST['filterStatus']!='all'){
		$filterStatus = $_POST['filterStatus'];
		$sqlWhere = "and allowTrading='".$filterStatus."'";
	}
}

$SQL_USERS = mysqli_query($con,"SELECT * FROM users WHERE adminApprove in(2) $sqlWhere order by id desc");
?>

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
		    <h5>User List</h5>
		    <a href="?page=userAdd" class="btn  btn-secondary">Add User</a>
		</div>
		<div class="card-body table-border-style">
			<div class="infoDiv mb-4">
				<span class="newUserInfo"></span> New User
				<span class="activeUserInfo"></span> Active User
				<span class="nonActiveUserInfo"></span> Non-Active User
			</div>
		    <div class="table-responsive">
		    	<form action="" method="post">
			    	<div class="row2 ml-1">
				    	<input type="text" id="myInput" onkeyup="mySearchFun()" placeholder="Search for names.." title="Type in a name" class="col-md-5 border border-dark" style="float: left; margin-right: 12px;">
				    	
				    	<select onchange="this.form.submit()" name="filterStatus" class="ml-2 form-control col-md-5 border border-dark">
				    		<option <?php if($filterStatus=="all"){ echo "selected='selected'"; } ?> value="all">All Users</option>
				    		<option <?php if($filterStatus=="1"){ echo "selected='selected'"; } ?> value="1">Active Users</option>
				    		<option <?php if($filterStatus=="0"){ echo "selected='selected'"; } ?> value="0">Non Active Users</option>
				    	</select>
				    </div>
				</form>

		        <table id="portfolioTable" class="table table-inverse">
		            <thead>
		                <tr>
		                    <th></th>
		                    <th>#</th>
		                    <th>Client ID</th>
		                    <th>Name</th>
		                    <th>Username</th>
		                    <th>Password</th>
		                    <th>Amount</th>
		                    <!-- <th>Registerd Date</th> -->
		                    <th>Last Login</th>
		                    <th>Allow Trading</th>
		                    <th>Brokerage</th>
		                    <th>Action</th>
		                </tr>
		            </thead>
		            <tbody>
		        	<?php
		        	$l=0;
		        	
		        	$NUM_ROWS = mysqli_num_rows($SQL_USERS);
		        	if($NUM_ROWS==0){
		        		?>
		        		<tr>
		        			<td colspan="11">No records found</td>
		        		</tr>
		        		<?php
		        	}else{
			        	while ($FETCH_USERS = mysqli_fetch_assoc($SQL_USERS)) {
			        	    $AUTO_USER_ID = $FETCH_USERS['id'];
			        		$l++;

			        		$allowTrading = $FETCH_USERS['allowTrading'];
			        		$adminApprove = $FETCH_USERS['adminApprove'];
			        		$uBrokerage = $FETCH_USERS['brokerage'];

			        		$tableClass = "";
			        		if($adminApprove==1){
			        			$tableClass = "table-active";
			        		}

			        		if($adminApprove==2 && $allowTrading==0){
			        			$tableClass = "table-danger";
			        		}
			        		if($adminApprove==2 && $allowTrading==1){
			        			$tableClass = "table-success";
			        		}

			        		$FETCH_USERS['lastLoginDt'] = ($FETCH_USERS['lastLoginDt'] =='') ? "-" : $FETCH_USERS['lastLoginDt'];
			        	?>
			            	<tr id="tr_<?php echo $AUTO_USER_ID; ?>" class="portfolio_tr_<?php echo $AUTO_USER_ID; ?> <?php echo $tableClass; ?>">
			            	    <td>
			            	        <span onclick="showConfirmBoxFun(<?php echo $AUTO_USER_ID; ?>)" class="deleteIconCls badge badge-danger"><i class="icon feather icon-trash mb-1 d-block"></i></span>
			            		</td>
			            		<td><?php echo $l; ?></td>
			            		<td><span class="badge badge-primary"><?php echo $FETCH_USERS['clientId']; ?></span></td>
			            		<td><?php echo $FETCH_USERS['fname']." ".$FETCH_USERS['lname']; ?></td>
			            		<td><?php echo $FETCH_USERS['username']; ?></td>
			            		<td><?php echo $FETCH_USERS['password']; ?></td>
			            		<td><?php echo $FETCH_USERS['amount']; ?></td>
			            		<!-- <td><?php //echo $FETCH_USERS['createdDt']; ?></td> -->
			            		<td><?php echo $FETCH_USERS['lastLoginDt']; ?></td>
			            		<td>
			            			<select class="tradingCls" onchange="updateFun(this,<?php echo $AUTO_USER_ID; ?>)" data-currval="<?php echo $allowTrading; ?>" data-fieldname="allowTrading">
			            				<option value="1" <?php if($allowTrading==1){ echo "selected='selected'"; } ?>>Yes</option>
			            				<option value="0" <?php if($allowTrading==0){ echo "selected='selected'"; } ?>>No</option>
			            			</select>
			            		</td>
			            		<td class="editableCls">
		                            <i class="icon feather icon-edit text-c-black mb-1"></i>
		                            <label onblur="updateFun(this,<?php echo $AUTO_USER_ID; ?>)" data-currval="<?php echo $uBrokerage; ?>" data-fieldname="brokerage" contenteditable="true" class="updateAmtData badge  brokerageCls"><?php echo $uBrokerage; ?></label>
		                        </td>
			            		
			            		<td>
			            		    <a href="?page=userEdit&id=<?php echo $AUTO_USER_ID; ?>">
			            		        <span class="badge badge-success"><i class="icon feather icon-edit mb-1"></i></span>
			            		    </a>
			            		    <span class="badge badge-success"><i class="icon feather icon-eye  mb-1"></i></span>
			            		</td>
			            	</tr>
			        	<?php
			        	}
			        }
			        ?>
		            </tbody>
		        </table>
		    </div>
		</div>
	</div>
</div>
