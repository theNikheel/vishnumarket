<?php

$RETURN_DATA = userWatchlistFun($loginID);
$userWatchlist_RESULT = $RETURN_DATA['userWatchlist'];
$userWatchlist_RESULT_exp = explode(",",$userWatchlist_RESULT['currencyList']);

$CURRENCT_DATA = pairCurrencyListFun();
/*
$LIVE_DATA = forexCurlFun("fetch-all");
$LIVE_DATA_RESULT = $LIVE_DATA['results'];
$LIVE_DATA_UPDATED = $LIVE_DATA['updated'];
*/
//echo "<pre>"; print_r($CURRENCT_DATA); echo "</pre>";
?>

<style>

</style>

<div class="row">
        
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <!-- <h5>Currencies</h5> -->
            </div>
            <div class="card-body">
            	<div class="row">
	            	<div class="col-sm-12">
                        <?php
                        //unset($_SESSION['marketFilter']);
                        $dropdownArray = array();
                        $SQL_EXPIRYDATE = mysqli_query($con,"SELECT * FROM marketexpirydate where expiryDateStr>'$currentDateStr' order by expiryDateStr");
                        while($FETCH_EXPIRYDATE = mysqli_fetch_assoc($SQL_EXPIRYDATE)){
                            $indexName = $FETCH_EXPIRYDATE['indexName'];
                            $expiryDate = $FETCH_EXPIRYDATE['expiryDate'];

                            $dropdownArray[$indexName][] = $expiryDate;
                        }  
                        //echo "<pre>"; print_r($_SESSION); echo "</pre>";

                        if(isset($_SESSION['marketFilter']))
                        {
                            $selected_indexItem = $_SESSION['marketFilter']['index_item'];
                            $selected_expirydate = $_SESSION['marketFilter']['expirydate'];
                            $index_item_array = $dropdownArray[$selected_indexItem];
                        }else {
                            $default_index_item = $INDEX_ARRAY[0];
                            $index_item_array = $dropdownArray[$default_index_item];
                            $selected_indexItem = $_SESSION['marketFilter']['index_item'] = $default_index_item;
                            $selected_expirydate = $_SESSION['marketFilter']['expirydate'] = $index_item_array[0];
                        }

                        $monthCode = substr(date("M",strtotime($selected_expirydate)), 0, 1);
                        $prefixCode = $selected_indexItem.date("y",strtotime($selected_expirydate)).$monthCode.date("d",strtotime($selected_expirydate));

                        //print_r($index_item_array);
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <select class="form-control">
                                    <?php
                                    foreach($INDEX_ARRAY as $INDEX_NAME_ITEM)
                                    {
                                        ?>
                                        <option value="<?php echo $INDEX_NAME_ITEM; ?>"><?php echo $INDEX_NAME_ITEM; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">

                                <select class="form-control">
                                    <?php
                                    foreach($index_item_array as $EXPIRY_DATE_ITEM)
                                    {
                                        ?>
                                        <option value="<?php echo $EXPIRY_DATE_ITEM; ?>"><?php echo $EXPIRY_DATE_ITEM; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <?php
                        $CE_TABLE = $PE_TABLE = "";
                        $SQL_MARKETDATA = mysqli_query($con,"SELECT * FROM marketlivedata WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' ORDER BY strikeprice ");
                        $foundRcd = mysqli_num_rows($SQL_MARKETDATA);
                        if($foundRcd==0)
                        {
                            $para['getIndexItem'] = $selected_indexItem;
                            $para['getExpiryDate'] = $selected_expirydate;
                            //marketCurlFun($para);
                            $SQL_MARKETDATA = mysqli_query($con,"SELECT * FROM marketlivedata WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' ORDER BY strikeprice ");
                        }
                        while($FETCH_MARKETDATA = mysqli_fetch_assoc($SQL_MARKETDATA))
                        {
                            $heartIcon = $heartActiveIcon = "";
                            if($FETCH_MARKETDATA['ce_ltp']!='')
                            {
                                $CE_TABLE .= '<tr>
                                                <td>
                                                    <span class="whishlistCls" onclick="myWatchlistFun()">
                                                        <i class="icon feather'.$heartIcon.' '.$heartActiveIcon.' text-c-red mb-1"></i>
                                                    </span>
                                                </td>
                                                <td>'.$FETCH_MARKETDATA['strikeprice'].'</td>
                                                <td>'.$FETCH_MARKETDATA['ce_ltp'].'</td>
                                                <td>'.$FETCH_MARKETDATA['ce_changepercentage'].'</td>
                                                <td>'.$FETCH_MARKETDATA['ce_volume'].'</td>
                                                <td>'.$FETCH_MARKETDATA['ce_vol_per_change'].'</td>
                                            </tr>';
                            }

                            if($FETCH_MARKETDATA['pe_ltp']!='')
                            {
                                $PE_TABLE .= '<tr>
                                            <td>'.$FETCH_MARKETDATA['strikeprice'].'</td>
                                            <td>'.$FETCH_MARKETDATA['pe_ltp'].'</td>
                                            <td>'.$FETCH_MARKETDATA['pe_changepercentage'].'</td>
                                            <td>'.$FETCH_MARKETDATA['pe_volume'].'</td>
                                            <td>'.$FETCH_MARKETDATA['pe_vol_per_change'].'</td>
                                        </tr>';
                            }
                            
                        }
                        ?>
                    </div>

                    <div class="col-md-6">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="5">Call</th>
                                        </tr>
                                        <tr>
                                            <th>Strike Price</th>
                                            <th>LTP</th>
                                            <th>CNG %</th>
                                            <th>Vol (Cr)</th>
                                            <th>Vol %</th>
                                        </tr>
                                    </thead>
                                    <?php echo $CE_TABLE; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="5">Put</th>
                                        </tr>
                                        <tr>
                                            <th>Strike Price</th>
                                            <th>LTP</th>
                                            <th>CNG %</th>
                                            <th>Vol (Cr)</th>
                                            <th>Vol %</th>
                                        </tr>
                                    </thead>
                                    <?php echo $PE_TABLE; ?>
                                </table>
                            </div>
                        </div>
					</div>
            	</div>
   
            </div>
        </div>
    </div>
</div>

<script>
/*$(document).ready(function(){
	liveFeedFun();	
});*/

/*setInterval(function(){ 
    liveFeedFun();
}, 180000);*/
</script>
