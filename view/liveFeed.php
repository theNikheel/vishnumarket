<?php
include "../config/config.php";

$CURRENCT_DATA = pairCurrencyListFun();

//echo "<pre>"; print_r($CURRENCT_DATA); echo "</pre>";
$LIVE_DATA_RETURN = array();
foreach($CURRENCT_DATA as $from => $to){

	$curl = curl_init();
                
    curl_setopt_array($curl, [
    	CURLOPT_URL => "https://api.fastforex.io/fetch-multi?from=$from&to=$to&api_key=".$FOREX_API_KEY,
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
    
    $LIVE_DATA = json_decode($response,true);
    $LIVE_DATA_RESULT = $LIVE_DATA['results'];
    //echo "<pre>"; print_r($LIVE_DATA_RESULT); echo "</pre>";
    foreach($LIVE_DATA_RESULT as $K => $V){
        $newKey = $from."_".$K;

        $LIVE_DATA_RETURN[$newKey] = $V;
    }
}
/*$LIVE_DATA_UPDATED = $LIVE_DATA['updated'];*/
//echo "<pre>"; print_r($LIVE_DATA); echo "</pre>";
//echo "<pre>"; print_r($LIVE_DATA_RETURN); echo "</pre>";
echo json_encode($LIVE_DATA_RETURN);
?>