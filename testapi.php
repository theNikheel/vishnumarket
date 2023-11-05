<?php 
include "config/config.php";
header("Access-Control-Allow-Origin: *");

$INDEX_ARRAY = array('NIFTY','BANKNIFTY','MIDCPNIFTY','FINNIFTY');

$API_URL = "https://www.icicidirect.com/marketapi/market";

$dropdownArray = array();
$SQL_EXPIRYDATE = mysqli_query($con,"SELECT * FROM marketexpirydate where expiryDateStr>'$currentDateStr' order by expiryDateStr");
while($FETCH_EXPIRYDATE = mysqli_fetch_assoc($SQL_EXPIRYDATE)){
    $indexName = $FETCH_EXPIRYDATE['indexName'];
    $expiryDate = $FETCH_EXPIRYDATE['expiryDate'];

    $dropdownArray[$indexName][] = $expiryDate;
}

//$INDEX_ARRAY_DATA = array_keys($dropdownArray);

//unset($_SESSION['marketFilter']);
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

//echo $selected_indexItem." - ".$selected_expirydate;

?>
<select>
    <?php
    foreach($INDEX_ARRAY as $INDEX_NAME_ITEM)
    {
        ?>
        <option value="<?php echo $INDEX_NAME_ITEM; ?>"><?php echo $INDEX_NAME_ITEM; ?></option>
        <?php
    }
    ?>
</select>

<select>
    <?php
    foreach($index_item_array as $EXPIRY_DATE_ITEM)
    {
        ?>
        <option value="<?php echo $EXPIRY_DATE_ITEM; ?>"><?php echo $EXPIRY_DATE_ITEM; ?></option>
        <?php
    }
    ?>
</select>

<?php
$CE_TABLE = $PE_TABLE = "";
$SQL_MARKETDATA = mysqli_query($con,"SELECT * FROM marketlivedata WHERE indexName='$selected_indexItem' AND expiryDate='$selected_expirydate' ORDER BY strikeprice ");
while($FETCH_MARKETDATA = mysqli_fetch_assoc($SQL_MARKETDATA))
{
    if($FETCH_MARKETDATA['ce_ltp']!='')
    {
        $CE_TABLE .= '<tr>
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

<table>
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
    <?php echo $CE_TABLE; ?>
</table>

<table>
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
    <?php echo $PE_TABLE; ?>
</table>
<?php

die;

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

die;




foreach($INDEX_ARRAY as $INDEXNAME)
{
    $getExpiry_postfield = [
        "Method"=>"GetDerexpiryDate",
        "ResType"=>"",
        "Type_Id"=>"",
        "param[0][key]"=>"P_INSTNAME",
        "param[0][value]"=>"OPTIDX",
        "param[1][key]"=>"P_SYMBOL",
        "param[1][value]"=>$INDEXNAME
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$API_URL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$getExpiry_postfield);

    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    $result = json_decode($server_output, true);

    curl_close($ch);


    $EXPIRYDATE_ARRAY = $result['Data']['Table'];
    
    foreach($EXPIRYDATE_ARRAY as $val)
    {
        $EXPDATE = $val['EXPDATE'];
        $expiryDateStr = strtotime($EXPDATE."23:59:59");
        $EXPDATE_array[] = $EXPDATE;
        mysqli_query($con,"INSERT INTO marketexpirydate SET indexName='$INDEXNAME',expiryDate='$EXPDATE',expiryDateStr='$expiryDateStr'");
    }
}

echo "<pre>"; print_r($EXPDATE_array); die;



$url = "https://groww.in/v1/api/option_chain_service/v1/option_chain/nifty-bank?expiry=2023-11-01";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$result = json_decode($server_output, true);

curl_close($ch);

echo "<pre>"; print_r($result); die;
?>
