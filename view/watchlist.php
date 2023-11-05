<?php
$RETURN_DATA = userWatchlistFun($loginID);
$userWatchlist_RESULT = $RETURN_DATA['userWatchlist'];
$currencyListGet = $userWatchlist_RESULT['currencyList'];
$userWatchlist_RESULT_exp = explode(",",$currencyListGet);

$newCurrencyArray = array();
foreach($userWatchlist_RESULT_exp as $KK => $VV){
    $VV_exp = explode("_",$VV);
    $baseCurr = $VV_exp[0];
    $toCurr = $VV_exp[1];
    $newCurrencyArray[$baseCurr][] = $toCurr;
}

$CURRENCT_DATA_ARRAY = array();
foreach($newCurrencyArray as $K_N => $V_N){
    $CURRENCT_DATA_ARRAY[$K_N] = implode(",",$V_N);
}


/*$LIVE_DATA = forexCurlFun("fetch-multi?from=USD&to=",$userWatchlist_RESULT);
$LIVE_DATA_RESULT = $LIVE_DATA['results'];
$LIVE_DATA_UPDATED = $LIVE_DATA['updated'];*/


?>

<style>
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>My Watchlist</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-sm-12">
                        <p class="lastUpdatedP">Last updated <span class="lastUpdatedCls"><?php echo $LIVE_DATA_UPDATED; ?></span></p>
                    </div>
                <?php
                
                foreach($CURRENCT_DATA_ARRAY as $from => $to){
                    
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
                $LIVE_DATA_UPDATED = $LIVE_DATA['updated'];

                foreach($LIVE_DATA_RESULT as $K => $V){
                    $newKey = $from."_".$K;
                    $heartIcon = "icon_".$newKey;
                    
                    $heartActiveIcon = "icon-heart";
                    if(in_array($newKey,$userWatchlist_RESULT_exp)){
                        $heartActiveIcon = "icon-heart-on";    
                    }
                ?>
                    <div class="col-sm-3">
                        <div class="currList">
                            <span class="whishlistCls" onclick="myWatchlistFun('<?php echo $newKey; ?>','<?php echo $loginID; ?>')">
                                <i class="icon feather <?php echo $heartIcon; ?> <?php echo $heartActiveIcon; ?>  text-c-red mb-1"></i>
                            </span>
                            <p>
                                <span class="currencyCode"><?php echo $from."/".$K; ?></span>
                                <span class="currencyRate feedLive_<?php echo $newKey; ?>"><?php echo $V; ?></span>
                            </p>
                        </div>
                    </div>
                <?php } } ?>
                </div>    
            </div>
        </div>
    </div>
</div>

<script>
//liveFeedFun();
/*setInterval(function(){ 
    liveFeedFun();
}, 100000);*/
</script>