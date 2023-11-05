<?php
//echo $loginID;
$RETURN_DATA = userPortfolioFun($loginID);
$RETURN_DATA_RESULT = $RETURN_DATA['userPortfolio'];
$userPortfolioData_RESULT = $RETURN_DATA['userPortfolioData'];
//echo "<pre>"; print_r($userPortfolioData_RESULT); echo "</pre>";

?>


<div class="row">
    <div class="col-sm-7">
        <div class="card">
            <div class="card-header">
                <h5>My Portfolio</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Currency Name</th>
                                <th>Live Rate</th>
                                <th>Total Units</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($userPortfolioData_RESULT as $KEY => $VAL){
                            /*
                            $totalUnits_buy = $VAL['totalUnits_buy'];
                            $totalAmt_buy = $VAL['totalAmt_buy'];
                            
                            $totalUnits_sell = $totalAmt_sell = 0;
                            
                            if(isset($VAL['totalUnits_sell'])){
                                $totalUnits_sell = $VAL['totalUnits_sell'];
                                $totalAmt_sell = $VAL['totalAmt_sell'];
                            }
                            $currentUnit = (float)$totalUnits_buy - (float)$totalUnits_sell;
                            $currentAmt = (float)$totalAmt_buy - (float)$totalAmt_sell;
                            */
                            $currentUnit = $VAL['currentUnits'];
                            $currentAmt = $VAL['currentAmt'];
                            
                            ?>
                            <tr>
                                <td><?php echo str_replace("_", "/", $KEY); ?></td>
                                <td></td>
                                <td><?php echo $currentUnit; ?></td>
                                <td><?php echo $currentAmt; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/*die;
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://api.fastforex.io/fetch-all?api_key=3cac46d73c-e4e94294a6-r9pl3z",
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

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
}

$aa = json_decode($response,true);
echo "<pre>"; print_r($aa);*/