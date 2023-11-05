<?php

$FOREX_API_KEY = "f2615643e9-87cdaedbe0-rbfy0y";

$INDEX_ARRAY = array('NIFTY','BANKNIFTY','MIDCPNIFTY','FINNIFTY');

$TRANSCATION_WITHDRAWL_STATUS = array("0"=>"Request Sent|table-warning","1"=>"Request Seen|table-info","2"=>"Initialize|table-active","3"=>"Decline|table-danger","4"=>"Completed|table-success");
$TRANSCATION_DEPOSITE_STATUS = array("0"=>"Processing...|table-active","3"=>"Decline|table-danger","4"=>"Completed|table-success");

function pairCurrencyListFun(){
    global $con;
    $SQL = mysqli_query($con,"select id,fromCurrency,toCurrency FROM liveCurrency");
	while($FETCH = mysqli_fetch_assoc($SQL)){
	    $id = $FETCH['id'];
	    $fromCurrency = $FETCH['fromCurrency'];
	    $toCurrency = $FETCH['toCurrency'];
	    $DATA[$fromCurrency] = $toCurrency;
	}
	return $DATA;
}

function userWatchlistFun($userId){
    global $con;
    $SQL = mysqli_query($con,"select group_concat(currencyCode) as currencyList FROM user_watchlist WHERE refUserId=$userId");
	$FETCH = mysqli_fetch_assoc($SQL);
	$DATA['userWatchlist'] = $FETCH;
	return $DATA;
}

function userPortfolioFun($userId){
    global $con;
    $SQL = mysqli_query($con,"select group_concat(currencyCode) as currencyList FROM user_portfolio WHERE refUserId=$userId");
	$FETCH = mysqli_fetch_assoc($SQL);
	$DATA['userPortfolioList'] = $FETCH;
	
	$SQL = mysqli_query($con,"select * FROM user_portfolio WHERE refUserId=$userId");
	while($FETCH = mysqli_fetch_assoc($SQL)){
	    $currencyCode = $FETCH['currencyCode'];
	    $autoId = $FETCH['id'];
	    

	    $SQL_DETAIL = mysqli_query($con,"SELECT transactionType,sum(units) as totalUnits, sum(transcationAmt) as totalAmt FROM user_portfolio_details WHERE  refPortfolioId=$autoId and status=0 GROUP by transactionType");
	    //$SQL_DETAIL = mysqli_query($con,"select * FROM user_portfolio_details WHERE refPortfolioId=$autoId and status=0");
	    while($FETCH_DETAIL = mysqli_fetch_assoc($SQL_DETAIL)){
	        $transactionType = $FETCH_DETAIL['transactionType'];
	        //$units = $FETCH_DETAIL['units'];

	        $CURRENCY_CODE_ARRAY[$currencyCode]['refPortfolioId'] = $autoId;
	        
	        $CURRENCY_CODE_ARRAY[$currencyCode]['totalUnits_'.$transactionType] = $FETCH_DETAIL['totalUnits'];
	        $CURRENCY_CODE_ARRAY[$currencyCode]['totalAmt_'.$transactionType] = $FETCH_DETAIL['totalAmt'];
	        //$PORTFOLIO[$currencyCode][] = $FETCH_DETAIL;    
	    }
	}
	
	$total_revenue = 0;

	//print_r($CURRENCY_CODE_ARRAY);
	
	foreach($CURRENCY_CODE_ARRAY as $K_F => $V_F){
	    $totalUnits_buy = $V_F['totalUnits_buy'];
        $totalAmt_buy = $V_F['totalAmt_buy'];

        $refPortfolioId = $V_F['refPortfolioId'];
        
        $totalUnits_sell = $totalAmt_sell = 0;

        $currentUnit = (float)$totalUnits_buy;
        $currentAmt = (float)$totalAmt_buy;

        if(isset($V_F['totalAmt_sell'])){
            $totalUnits_sell = $V_F['totalUnits_sell'];
            $totalAmt_sell = $V_F['totalAmt_sell'];

            $currentUnit = (float)$totalUnits_sell - (float)$totalUnits_buy;
        	$currentAmt = (float)$totalAmt_sell - (float)$totalAmt_buy;
        }       

        
        $total_revenue = $total_revenue+$currentAmt;
        
        $CURRENCY_CODE_ARRAY[$K_F]['currentUnits'] = $currentUnit;
        $CURRENCY_CODE_ARRAY[$K_F]['currentAmt'] = $currentAmt;
        $CURRENCY_CODE_ARRAY[$K_F]['refPortfolioId'] = $refPortfolioId;
        
	}
	$DATA['userPortfolioData'] = $CURRENCY_CODE_ARRAY;
	$DATA['userTotalRevenue'] = $total_revenue;
	
	return $DATA;
}

function userPortfolioDetailFun($autoId){
    global $con;
    $SQL_DETAIL = mysqli_query($con,"select * FROM user_portfolio_details WHERE refPortfolioId=$autoId and status=0 order by id desc");
    while($FETCH_DETAIL = mysqli_fetch_assoc($SQL_DETAIL)){
        $PORTFOLIO[] = $FETCH_DETAIL;    
    }
	$DATA['userPortfolioDetails'] = $PORTFOLIO;
	return $DATA;
}

function userProfileFun($userId){
	global $con;

	$SQL = mysqli_query($con,"select * FROM users WHERE id=$userId");
	$FETCH = mysqli_fetch_assoc($SQL);

	$DATA['personalDetailData']  = $FETCH;
	
	$SQL = mysqli_query($con,"select * FROM users_bank_detail WHERE refUserId=$userId");
	$FETCH = mysqli_fetch_assoc($SQL);
	$DATA['bankDetailData']  = $FETCH;
	
	return $DATA;
}

function userBankDetailsFun($userId){
    global $con;
    $SQL = mysqli_query($con,"select * FROM users_bank_detail WHERE refUserId=$userId");
	$FETCH = mysqli_fetch_assoc($SQL);
	$DATA['bankDetailData']  = $FETCH;
	
	return $DATA;
}

function userTransactionDetailsFun($userId){
    global $con;
    $SQL = mysqli_query($con,"select * FROM transcation WHERE refUserId=$userId order by id desc");
	while($FETCH = mysqli_fetch_assoc($SQL)){
	    $list_data[] = $FETCH;
	}
	$DATA['listData']  = $list_data;
	
	return $DATA;
}


function marketCurlFun($para){
	global $con;
	$selected_indexItem = $para['getIndexItem'];
	$selected_expirydate = $para['getExpiryDate'];


	$API_URL = "https://www.icicidirect.com/marketapi/market";

	$postfield_market = [
        "Method" => "GetDerivativeOptionChain",
        "param[0][key]" => "p_instrument",
        "param[0][value]" => "OPTIDX",
        "param[1][key]" => "p_symbol",
        "param[1][value]" => $selected_indexItem,
        "param[2][key]" => "p_expdt",
        "param[2][value]" => $selected_expirydate,
        "param[3][key]" => "p_pagenumber",
        "param[3][value]" => "1",
        "param[4][key]" => "p_pagesize",
        "param[4][value]" => "100"
    ];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$API_URL);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$postfield_market);

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	$result = json_decode($server_output, true);

	curl_close($ch);

	//echo "<pre>"; print_r($result['Data']); die;

	$CE_ARRAY = $result['Data']['Table'];
	$PE_ARRAY = $result['Data']['Table2'];

	foreach($CE_ARRAY as $val)
	{
	    $STRIKEPRICE = $val['STRIKEPRICE'];
	    $MKT_LOT = $val['MKT_LOT'];

	    $CE_CHANGEPERCENTAGE = $val['CHANGEPERCENTAGE'];
	    if($CE_CHANGEPERCENTAGE == 0)
	    {
	        $CE_CHANGEPERCENTAGE = "-";
	    }
	    $CE_VOLUME = $val['VOLUME'];
	    $CE_VOL_PER_CHANGE = $val['VOL_PER_CHANGE'];
	    if($CE_VOL_PER_CHANGE == 0)
	    {
	        $CE_VOL_PER_CHANGE = "-";
	    }

	    $CE_OPTTYPE = $val['OPTTYPE'];

	    $CE_LTP = $val['LTP'];

	    $CE_OPENPRICE = $val['OPENPRICE'];
	    $CE_HIGHPRICE = $val['HIGHPRICE'];
	    $CE_LOWPRICE = $val['LOWPRICE'];

	    $CE_CODE = $prefixCode.$STRIKEPRICE.$CE_OPTTYPE;

	    $dataSet = "indexName='$selected_indexItem', expiryDate='$selected_expirydate', strikeprice='$STRIKEPRICE', mkt_lot='$MKT_LOT', ce_ltp='$CE_LTP', ce_changepercentage='$CE_CHANGEPERCENTAGE', ce_volume='$CE_VOLUME', ce_vol_per_change='$CE_VOL_PER_CHANGE', ce_opttype='$CE_OPTTYPE', ce_openprice='$CE_OPENPRICE', ce_highprice='$CE_HIGHPRICE', ce_lowprice='$CE_LOWPRICE', ce_code='$CE_CODE'";

	    $sql_foundRecord = mysqli_query($con,"SELECT id FROM marketlivedata WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' AND strikeprice='$STRIKEPRICE'") or die(mysqli_error($con));
	    $num_foundRecord = mysqli_num_rows($sql_foundRecord);
	    if($num_foundRecord==0){
	        mysqli_query($con,"INSERT INTO marketlivedata SET $dataSet") or die(mysqli_error($con));
	    }else
	    {
	        mysqli_query($con,"UPDATE marketlivedata SET $dataSet WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' AND strikeprice='$STRIKEPRICE'") or die(mysqli_error($con));
	    }
	}


	foreach($PE_ARRAY as $val)
	{
	    $STRIKEPRICE = $val['STRIKEPRICE'];
	    $PE_CHANGEPERCENTAGE = $val['CHANGEPERCENTAGE'];
	    if($PE_CHANGEPERCENTAGE == 0)
	    {
	        $PE_CHANGEPERCENTAGE = "-";
	    }
	    $PE_VOLUME = $val['VOLUME'];
	    $PE_VOL_PER_CHANGE = $val['VOL_PER_CHANGE'];
	    if($PE_VOL_PER_CHANGE == 0)
	    {
	        $PE_VOL_PER_CHANGE = "-";
	    }

	    $PE_OPTTYPE = $val['OPTTYPE'];
	    $PE_LTP = $val['LTP'];

	    $PE_OPENPRICE = $val['OPENPRICE'];
	    $PE_HIGHPRICE = $val['HIGHPRICE'];
	    $PE_LOWPRICE = $val['LOWPRICE'];

	    $PE_CODE = $prefixCode.$STRIKEPRICE.$PE_OPTTYPE;

	    $dataSet = "indexName='$selected_indexItem', expiryDate='$selected_expirydate', strikeprice='$STRIKEPRICE', mkt_lot='$MKT_LOT', pe_ltp='$PE_LTP', pe_changepercentage='$PE_CHANGEPERCENTAGE', pe_volume='$PE_VOLUME', pe_vol_per_change='$PE_VOL_PER_CHANGE', pe_opttype='$PE_OPTTYPE', pe_openprice='$PE_OPENPRICE', pe_highprice='$PE_HIGHPRICE', pe_lowprice='$PE_LOWPRICE', pe_code='$PE_CODE'";

	    $sql_foundRecord = mysqli_query($con,"SELECT id FROM marketlivedata WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' AND strikeprice='$STRIKEPRICE'") or die(mysqli_error($con));
	    $num_foundRecord = mysqli_num_rows($sql_foundRecord);
	    if($num_foundRecord==0){
	        mysqli_query($con,"INSERT INTO marketlivedata SET $dataSet") or die(mysqli_error($con));
	    }else
	    {
	        mysqli_query($con,"UPDATE marketlivedata SET $dataSet WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' AND strikeprice='$STRIKEPRICE'") or die(mysqli_error($con));
	    }
	}
}

function forexCurlFun($para){
    
    $API_KEY = "3cac46d73c-e4e94294a6-r9pl3z";
    
    $curl = curl_init();

    curl_setopt_array($curl, [
    	CURLOPT_URL => "https://api.fastforex.io/".$para."?from=USD&api_key=".$API_KEY,
    	CURLOPT_RETURNTRANSFER => true,
    	CURLOPT_FOLLOWLOCATION => true,
    	CURLOPT_ENCODING => "",
    	CURLOPT_MAXREDIRS => 10,
    	CURLOPT_TIMEOUT => 30,
    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_CUSTOMREQUEST => "GET"
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    /*if ($err) {
    	echo "cURL Error #:" . $err;
    } else {
    	//echo $response;
    }*/

return $aa = json_decode($response,true);
}

function websiteDetailsFun(){
    global $con;
    $SQL = mysqli_query($con,"select * FROM website");
	$FETCH = mysqli_fetch_assoc($SQL);
	$DATA['websiteDetailData']  = $FETCH;
	
	return $DATA;
}
?>