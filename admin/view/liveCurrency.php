<?php

if(isset($_POST['addNew'])){
    
    $currencyName = $_POST['currencyName'];
    $currencyNameTo = $_POST['currencyNameTo'];
    
    mysqli_query($con,"INSERT INTO liveCurrency SET fromCurrency='$currencyName',toCurrency='$currencyNameTo'");
    
}

?>

<form action="" method="post">
    <input type="text" name="currencyName">
    <input type="text" name="currencyNameTo">
    <input type="submit" value="submit" name="addNew">
    </form>