<?php
include "../config/config.php";

/*if(isset($_POST['forexLiveDataAPI'])){
    $LIVE_DATA = forexCurlFun("fetch-all");
    $LIVE_DATA_RESULT = $LIVE_DATA['results'];
    $LIVE_DATA_UPDATED = $LIVE_DATA['updated'];
    //echo "<pre>"; print_r($LIVE_DATA); echo "</pre>";
    echo json_encode($LIVE_DATA,true);
}*/

if(isset($_POST['ajaxWatchlist'])){
    $loginId = $_POST['refUserId'];
    $newCurrency = $_POST['currency'];
    $SQL_CURRENCY_GET = mysqli_query($con,"SELECT currencyCode FROM user_watchlist WHERE refUserId='$loginId'");
    $num_rcd = mysqli_num_rows($SQL_CURRENCY_GET);
    if($num_rcd==0){
        $newCurrencyArray[] = $newCurrency;
        $newCurrency_imp = implode(",",$newCurrencyArray);
        mysqli_query($con,"INSERT INTO user_watchlist SET currencyCode='$newCurrency_imp',refUserId='$loginId'");
        echo "add";
    }else{
        $FETCH_CURRENCY_GET = mysqli_fetch_assoc($SQL_CURRENCY_GET);
        $FETCH_CURRENCY_GET['currencyCode'];
        $currencyCode_exp = explode(",",$FETCH_CURRENCY_GET['currencyCode']);
        
        //print_r($currencyCode_exp);
        if(in_array($newCurrency,$currencyCode_exp)){
            if (($key = array_search($newCurrency, $currencyCode_exp)) !== false) {
                unset($currencyCode_exp[$key]);
            }
            $newCurrencyArray = $currencyCode_exp;
            echo "remove";
        }else{
            $currencyCode_exp[] = $newCurrency;
            $newCurrencyArray = $currencyCode_exp;
            echo "add";
        }
        $result = array_filter($newCurrencyArray);
        
        $newCurrency_imp = implode(",",$result);
        mysqli_query($con,"UPDATE user_watchlist SET currencyCode='$newCurrency_imp' WHERE refUserId='$loginId'");
    }
}

?>