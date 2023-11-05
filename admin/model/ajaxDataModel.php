<?php
include('../../config/config.php');

if(isset($_POST['userTransactionUpdate'])){
    $transId = $_POST['transId'];
    $refUserId = $_POST['refUserId'];
    
    $valTran = $_POST['changeStatus'];
    mysqli_query($con,"UPDATE transcation SET status='$valTran' WHERE id='$transId'");
    
    //$SQL_TRAN = mysqli_query($con,"SELECT transAmt,transType FROM transcation WHERE id=$transId");
    $SQL_TRAN = mysqli_query($con,"SELECT SUM(transAmt) as totalAmt,transType FROM transcation WHERE refUserId='$refUserId' and status='4' group by transType");
    //$transArray = array();
    $transArray['Deposite'] = $transArray['Withdrawal'] = 0;
    while($FETCH_TRAN = mysqli_fetch_assoc($SQL_TRAN)){
        $typeTran = $FETCH_TRAN['transType'];
        $amtTran = $FETCH_TRAN['totalAmt']; 
        $transArray[$typeTran] = $amtTran;
    }


    print_r($transArray);

    $amount = $transArray['Deposite'] - $transArray['Withdrawal'];
    mysqli_query($con,"UPDATE users SET amount='$amount' WHERE id='$refUserId'");
    /*if($typeTran=='Deposite'){
          mysqli_query($con,"UPDATE users SET amount=amount+$amtTran WHERE id='$refUserId'");
    }else{
        mysqli_query($con,"UPDATE users SET amount=amount-$amtTran WHERE id='$refUserId'");
    }*/
    echo $valTran;
    

}

if(isset($_POST['deletePortfolioItem'])){
    $refUserId = $_POST['refUserId'];
    $portfolioDetailAutoId = $_POST['portfolioDetailAutoId'];

    $SQL_ITEM = mysqli_query($con,"SELECT * FROM user_portfolio_details WHERE id=$portfolioDetailAutoId");
    $FETCH_ITEM = mysqli_fetch_assoc($SQL_ITEM);
    $get_transcationAmt = $FETCH_ITEM['transcationAmt'];

    mysqli_query($con,"UPDATE users SET investAmount=investAmount-$get_transcationAmt WHERE id=$refUserId");
    
    mysqli_query($con,"DELETE FROM user_portfolio_details WHERE id=$portfolioDetailAutoId");
    
}

if(isset($_POST['userAddPortfolio'])){
    $refUserId = $_POST['refUserId'];
    $currencyCode = $_POST['currencyCode'];
    $transcationAmt = $_POST['transcationAmt'];
    $actionType = $_POST['actionType'];
    $transcationUnits = $_POST['transcationUnits'];

    $CHK_RCD = mysqli_query($con,"SELECT * FROM user_portfolio WHERE refUserId='$refUserId' and currencyCode='$currencyCode'");

    $NUM_ROWS = mysqli_num_rows($CHK_RCD);
    if($NUM_ROWS==0){
        mysqli_query($con,"INSERT INTO user_portfolio SET refUserId='$refUserId',currencyCode='$currencyCode'");
        $PORTFOLIO_AUTO_ID = mysqli_insert_id($con);
    }else{
        $FETCH = mysqli_fetch_assoc($CHK_RCD);
        $PORTFOLIO_AUTO_ID = $FETCH['id'];
    }

    mysqli_query($con,"INSERT INTO user_portfolio_details SET refPortfolioId='$PORTFOLIO_AUTO_ID',transcationAmt='$transcationAmt',transactionType='$actionType',units='$transcationUnits',transactionDate='$curretDate'");

    if($actionType=='buy'){
        mysqli_query($con,"UPDATE users SET investAmount=investAmount+$transcationAmt WHERE id=$refUserId");
    }
    if($actionType=='sell'){
        mysqli_query($con,"UPDATE users SET investAmount=investAmount-$transcationAmt WHERE id=$refUserId");
    }
}

if(isset($_POST['userPortfolioData'])){
    $refUserId = $_POST['refUserId'];
    $RETURN_DATA = userPortfolioFun($refUserId);

    echo json_encode($RETURN_DATA,true);
}

if(isset($_POST['userPortfolioDetailData'])){
    $portfolioId = $_POST['portfolioId'];
    $RETURN_DATA = userPortfolioDetailFun($portfolioId);

    echo json_encode($RETURN_DATA,true);
}

if(isset($_POST['updateUserAmt'])){
    $getEditVal = $_POST['getEditVal'];
    $getFieldname = $_POST['getFieldname'];
    $getCurrval = $_POST['getCurrval'];
    
    $getUserId = $_POST['getUserId'];
    
    mysqli_query($con,"UPDATE users SET $getFieldname='$getEditVal' WHERE id=$getUserId");
    echo "Updated";
}

if(isset($_POST['ajaxCheckDuplicate'])){
    $colName = $_POST['colName'];
    $getVal = $_POST['getVal'];
    
    $SQL_CHK_RCD = mysqli_query($con,"SELECT id from users WHERE $colName='$getVal'");
    $NUM_ROWS = mysqli_num_rows($SQL_CHK_RCD);
    echo $NUM_ROWS;
}

if(isset($_POST['removeUser'])){
    $getUserId = $_POST['getUserId'];
    
    mysqli_query($con,"DELETE from users WHERE id=$getUserId");
    mysqli_query($con,"DELETE from users_bank_detail WHERE refUserId=$getUserId");
    mysqli_query($con,"DELETE from transcation WHERE refUserId=$getUserId");
    mysqli_query($con,"DELETE from user_portfolio WHERE refUserId=$getUserId");
    mysqli_query($con,"DELETE from user_portfolio_details WHERE  refPortfolioId NOT IN (SELECT id FROM user_portfolio)");
    mysqli_query($con,"DELETE from user_watchlist WHERE refUserId=$getUserId");
    
    echo "Deleted";
}
?>