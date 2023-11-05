<?php include "view/commonHeader.php"; ?>

<div class="card">
    <div class="card-body table-border-style">
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="mySearchFun()" placeholder="Search for names.." title="Type in a name">
            <table class="table table-inverse" id="portfolioTable" style="text-align:center;">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Invest</th>
                        <th>Wallet Amount</th>
                        <th>Current Amount</th>
                        <th>Portfolio</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $l=0;
                $SQL_USERS = mysqli_query($con,"SELECT * FROM users order by id desc");
                while ($FETCH_USERS = mysqli_fetch_assoc($SQL_USERS)) {
                    $l++;
                    $AUTO_USER_ID = $FETCH_USERS['id'];
                    $RETURN_DATA_USER = userPortfolioFun($AUTO_USER_ID);
                    $RETURN_DATA_USER_RESULT = $RETURN_DATA_USER['userPortfolio'];
                    $userPortfolioData_USER_RESULT = $RETURN_DATA_USER['userPortfolioData'];
                    //echo "<pre>"; print_r($userPortfolioData_USER_RESULT); echo "</pre>";
                    $userPortfolioRevenue = $RETURN_DATA_USER['userTotalRevenue'];
                    $userAmount = $FETCH_USERS['amount'];
                    if($userAmount==''){
                        $userAmount =0;
                    }
                    
                    $amount = $FETCH_USERS['amount'];
                    $investAmount = $FETCH_USERS['investAmount'];
                    $availableWallet = (int)$amount - (int)$investAmount;
                    
                    $showAmount = $FETCH_USERS['showAmount'];
                    if($showAmount==""){
                        //$showAmount = $userAmount - $userPortfolioRevenue;
                        $showAmount = 0;
                    }

                    if($investAmount==""){
                        //$showAmount = $userAmount - $userPortfolioRevenue;
                        $investAmount = 0;
                    }

                    if($amount==""){
                        //$showAmount = $userAmount - $userPortfolioRevenue;
                        $amount = 0;
                    }
                    
                    $uName = $FETCH_USERS['fname']." ".$FETCH_USERS['lname'];
                    
                ?>
                <!--onclick="showConfirmBoxFun(<?php echo $AUTO_USER_ID; ?>)"-->
                    <tr id="tr_<?php echo $AUTO_USER_ID; ?>" class="portfolio_tr_<?php echo $AUTO_USER_ID; ?>">
                        <td><span onclick="showConfirmBoxFun(<?php echo $AUTO_USER_ID; ?>)" class="deleteIconCls"><i class="icon feather icon-trash text-c-red mb-1 d-block"></i></span></td>
                        <td><?php echo $l; ?></td>
                        <td><span class="badge badge-primary"><?php echo $FETCH_USERS['clientId']; ?></span></td>
                        <td><?php echo $uName; ?></td>
                        <td class="editableCls">
                            <i class="icon feather icon-edit text-c-yellow mb-1"></i>
                            <label onblur="updateFun(this,<?php echo $AUTO_USER_ID; ?>)" data-currval="<?php echo $userAmount; ?>" data-fieldname="amount" contenteditable="true" class="updateAmtData badge badge-success"><?php echo $userAmount; ?></label></td>
                        <!--<td class="editableCls">
                            <i class="icon feather icon-edit text-c-yellow mb-1"></i>
                            <label onblur="updateFun(this,<?php echo $AUTO_USER_ID; ?>)" data-currval="<?php echo $userPortfolioRevenue; ?>" data-fieldname="investAmount" contenteditable="true" class="updateAmtData badge badge-primary"><?php echo $userPortfolioRevenue; ?></label></td>-->
                        <td class="editableCls">
                            <i class="icon feather icon-edit text-c-yellow mb-1"></i>
                            <label onblur="updateFun(this,<?php echo $AUTO_USER_ID; ?>)" data-currval="<?php echo $investAmount; ?>" data-fieldname="investAmount" contenteditable="true" class="updateAmtData badge badge-primary"><?php echo $investAmount; ?></label></td>
                        <td class="editableCls">
                            <label class="updateAmtData walletAmt badge badge-primary"><?php echo $availableWallet; ?></label></td>
                        <td class="editableCls">
                            <i class="icon feather icon-edit text-c-yellow mb-1"></i>
                            <label onblur="updateFun(this,<?php echo $AUTO_USER_ID; ?>)" data-currval="<?php echo $showAmount; ?>" data-fieldname="showAmount" contenteditable="true" class="updateAmtData badge badge-warning"><?php echo $showAmount; ?></label></td>
                        
                        <td>
                            <button onclick="openPortfolioBoxFun(<?php echo $AUTO_USER_ID; ?>,'<?php echo $uName; ?>')" type="button" class="btn  btn-primary">Portfolio</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>