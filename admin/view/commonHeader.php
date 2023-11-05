<style>
.editableCls .badge {
    font-size: 82%;
    padding: 5px 4px;
    min-width: 78px;
}

.portfolioExtraDetails{
    width: 20px !important;
    height: 20px !important;
    font-size: 13px !important;
    margin-left: 5px;
}
</style>

<?php
$SQL_ALL_USER_DATA = mysqli_query($con,"SELECT * FROM users WHERE adminApprove in(2)");
$NUM_ALL_USER_DATA = mysqli_num_rows($SQL_ALL_USER_DATA);

$SQL_ACTIVE_USER_DATA = mysqli_query($con,"SELECT * FROM users WHERE adminApprove in(2) and allowTrading in(1)");
$NUM_ACTIVE_USER_DATA = mysqli_num_rows($SQL_ACTIVE_USER_DATA);

$SQL_NON_ACTIVE_USER_DATA = mysqli_query($con,"SELECT * FROM users WHERE adminApprove in(2) and allowTrading in(0)");
$NUM_NON_ACTIVE_USER_DATA = mysqli_num_rows($SQL_NON_ACTIVE_USER_DATA);

$SQL_NEW_USER_DATA = mysqli_query($con,"SELECT * FROM users WHERE adminApprove in(1)");
$NUM_NEW_USER_DATA = mysqli_num_rows($SQL_NEW_USER_DATA);

$SQL_INCOMPLETE_USER_DATA = mysqli_query($con,"SELECT * FROM users WHERE adminApprove in(0)");
$NUM_INCOMPLETE_USER_DATA = mysqli_num_rows($SQL_INCOMPLETE_USER_DATA);

?>

<div class="row">
    <div class="col-md-12 col-xl-6">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-4 card-body br">
                    <a href="?page=userList">
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                            </div>
                            <div class="col-sm-8 text-md-center">
                                <h5><?php echo sprintf("%02d", $NUM_ALL_USER_DATA); ?></h5>
                                <span>Users</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 card-body br">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="icon feather icon-music text-c-red mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-8 text-md-center">
                            <h5><?php echo sprintf("%02d", $NUM_ACTIVE_USER_DATA); ?></h5>
                            <span>Active Users</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 card-body br">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="icon feather icon-music text-c-red mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-8 text-md-center">
                            <h5><?php echo sprintf("%02d", $NUM_NON_ACTIVE_USER_DATA); ?></h5>
                            <span>Non-Active Users</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <a href="?page=registrationNew">
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                            </div>
                            <div class="col-sm-8 text-md-center">
                                <h5><?php echo sprintf("%02d", $NUM_NEW_USER_DATA); ?></h5>
                                <span>New Registration</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-8 text-md-center">
                            <h5><?php echo sprintf("%02d", $NUM_INCOMPLETE_USER_DATA); ?></h5>
                            <span>Incomplete Registration</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function mySearchFun() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("portfolioTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function updateFun(thisVar,userId){
    getEditVal = $(thisVar).text();
    getFieldname = thisVar.dataset.fieldname;
    if(getFieldname=='allowTrading')
    {
        getEditVal = $(thisVar).val();
    }
    getCurrval = thisVar.dataset.currval;
    getUserId = userId
    console.log(getEditVal);
    $.ajax({
        type:'POST',
        data:"updateUserAmt=updateUserAmt&getEditVal="+getEditVal+"&getFieldname="+getFieldname+"&getCurrval="+getCurrval+"&getUserId="+getUserId,
        url:'model/ajaxDataModel.php',
        success: function(data){
            if(getFieldname=='allowTrading')
            {

                if(getEditVal==1){
                    $("#tr_"+getUserId).removeClass();
                    $("#tr_"+getUserId).addClass('table-success');
                }else{
                    $("#tr_"+getUserId).removeClass();
                    $("#tr_"+getUserId).addClass('table-danger');
                }
            }
            
            /*ajaxData = JSON.parse(data);
            lastupdated = ajaxData.updated;
            $(".lastUpdatedCls").text(lastupdated);
            liveDataArray = ajaxData.results;
            $.each(liveDataArray, function (key, val) {
                $(".feedLive_"+key).text(val);
                //console.log(key + val);
            });*/
        }
    });
}

/*function userPortfolioFun(userId){
    $.ajax({
        type:'POST',
        data:"userPortfolio=userPortfolio&getUserId="+getUserId,
        url:'model/ajaxDataModel.php',
        success: function(data){

        }
    });
}*/

function deletePortfolioItemFun(refUserId,portfolioDetailAutoId){
    $.ajax({
        type:'POST',
        data:"deletePortfolioItem=deletePortfolioItem&portfolioDetailAutoId="+portfolioDetailAutoId+"&refUserId="+refUserId,
        url:'model/ajaxDataModel.php',
        success: function(data){
            $(".itemTr_"+portfolioDetailAutoId).remove();
        }
    });
}

function getUserPortfolioDetailDataFun(refUserId,portfolioId){
    $("#userPortfolioDetailData").html("");

    $.ajax({
        type:'POST',
        data:"userPortfolioDetailData=userPortfolioDetailData&portfolioId="+portfolioId,
        url:'model/ajaxDataModel.php',
        success: function(data){
            //console.log(data);
            ajaxData = JSON.parse(data);
            console.log(ajaxData);
            userPortfolioDetails_RESULT = ajaxData.userPortfolioDetails;

            $.each(userPortfolioDetails_RESULT, function (key, val) {
                typePr = val.transactionType;
                if(typePr=='buy'){
                    prTransType = "<span class='badge badge-success'>"+val.transactionType+"</span>";
                }else{
                    prTransType = "<span class='badge badge-danger'>"+val.transactionType+"</span>";
                }
                itemAutoId = val.id;
                deleteIcon = '<span onclick="deletePortfolioItemFun('+refUserId+','+val.id+')" class="deletePortfolioItemCls"><i class="feather icon-trash"></i></span>';

                $("#userPortfolioDetailData").append("<tr class='itemTr_"+itemAutoId+"'><td>"+deleteIcon+"</td><td>"+val.transactionDate+"</td><td>"+val.units+"</td><td> "+val.transcationAmt+"</td><td>"+prTransType+" </td>");
            });
        }   
    });

}

function getUserPortfolioDataFun(userId){
    $(".portfolioDetailTable").hide();    
    $("#userPortfolioData").html("");

    walletBalance = $(".portfolio_tr_"+userId+" .walletAmt").text();
    $("#walletBalance").val(walletBalance);    
    $("#portfolioUserId").val(userId);
    
    $.ajax({
        type:'POST',
        data:"userPortfolioData=userPortfolioData&refUserId="+userId,
        url:'model/ajaxDataModel.php',
        success: function(data){
            //console.log(data);
            ajaxData = JSON.parse(data);
            //console.log(ajaxData);
            userPortfolioData_RESULT = ajaxData.userPortfolioData;
            //console.log(userPortfolioData_RESULT);
            
            //extraIcon = '<button type="button" class="btn btn-icon btn-primary portfolioExtraDetails"><i class="feather icon-plus"></i></button>';

            $.each(userPortfolioData_RESULT, function (key, val) {
                key = key.replace("_", "/");
                portId = val.refPortfolioId;
                extraIcon = '<button type="button" class="btn btn-icon btn-primary portfolioExtraDetails" onclick="getUserPortfolioDetailDataFun('+userId+','+portId+')"><i class="feather icon-plus"></i></button>';

                $("#userPortfolioData").append("<tr><td>"+key+"</td><td>"+val.currentAmt+" "+extraIcon+"</td>");
            });

            $(".portfolioDetailTable").show();

            /*ajaxData_details = JSON.parse(userPortfolioData_RESULT);
            $.each(ajaxData_details, function (key, val) {
                console.log(key+" ");
            }*/
        }
    });
}

function openPortfolioBoxFun(userId,userName){
    
    $(".userNameData").text(userName);
    getUserPortfolioDataFun(userId);
    $("#portfolioBox").click();
}

function userPortfolioActionFun(actionType){
    
    userTransCurr = $("#userTransCurr").val();
    userTransAmt = $("#userTransAmt").val();
    
    if(userTransCurr=='' || userTransAmt==''){
        alert("Blank value not allowed");
        return false;
    }
    
    formData = $("#addPortfolioForm").serializeArray();
    console.log(formData);
    //formData.append("userAddPortfolio","userAddPortfolio");
    formData.push({name: "userAddPortfolio", value:"userAddPortfolio"});
    formData.push({name: "actionType", value:actionType});
    
    
    $.ajax({
        type:'POST',
        data:formData,
        url:'model/ajaxDataModel.php',
        success: function(data){
            $("#addPortfolioForm")[0].reset();
        }
    });
}


/*function updateUserPortfolio(refUserId){
    getUserPortfolioDataFun(userId);
}*/

</script>


<?php $CURRENCT_DATA = pairCurrencyListFun(); ?>

<span id="portfolioBox" style="display: none;" data-toggle="modal" data-target=".bd-example-modal-lg"></span>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span class="userNameData"></span> Portfolio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Available Balance</label>
                    <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="walletBalance" value="500000">
                    </div>
                </div>
                <form id="addPortfolioForm" method="post" action="model/ajaxDataModel.php">
                    <input type="hidden" name="refUserId" value="" id="portfolioUserId">
                    <div class="form-row">
                        <div class="form-group col-md-3 mb-2">
                            <select name="currencyCode" id="userTransCurr" class="form-control ">
                                <option >Select Currency</option>
                                <?php foreach($CURRENCT_DATA as $from => $to_array){
                                    foreach (explode(",", $to_array) as $to) {
                                        $val_dp = $from.'_'.$to;
                                ?>
                                        <option value="<?php echo $val_dp; ?>"><?php echo $from."/".$to; ?></option>
                                <?php } } ?>
                            </select>
                            
                        </div>
                        <div class="form-group col-md-3 mb-2">                                
                            <input name="transcationUnits" type="text" class="form-control" id="userUnits" placeholder="Unit Lots">
                        </div>
                        <div class="form-group col-md-3 mb-2">                                
                            <input name="transcationAmt" type="text" class="form-control" id="userTransAmt" placeholder="Transcation Amount">
                        </div>
                        <button onclick="userPortfolioActionFun('buy')" type="button" class="btn  btn-primary mb-2">BUY</button>
                        <button onclick="userPortfolioActionFun('sell')" type="button" class="btn  btn-danger ml-2 mb-2">SELL</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-4">
                        <table style="border: 1px solid #ccc;" class="table table-inverse">
                            <thead>
                                <tr>
                                    <th class="headTh">Currency</th>
                                    <th class="headTh">Invest</th>
                                </tr>
                            </thead>
                            <tbody id="userPortfolioData">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div class="portfolioDetailTable" style="display: none;">
                            <table style="border: 1px solid #ccc;" class="table table-inverse">
                                <thead>
                                    <tr>
                                        <th class="headTh"></th>
                                        <th class="headTh">Date</th>
                                        <th class="headTh">Units</th>
                                        <th class="headTh">Amount</th>
                                        <th class="headTh">Type</th>
                                    </tr>
                                </thead>
                                <tbody id="userPortfolioDetailData">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
.portfolioDetailTable{
    display: none;
}
.headTh{
    background-color: gray !important;
    color: white !important;
}
.portfolioExtraDetails,.deletePortfolioItemCls{
    cursor: pointer;
}
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 10px 20px 9px 20px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

/*#portfolioTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#portfolioTable th, #portfolioTable td {
  text-align: left;
  padding: 12px;
}

#portfolioTable tr {
  border-bottom: 1px solid #ddd;
}

#portfolioTable tr.header, #portfolioTable tr:hover {
  background-color: #f1f1f1;
}*/

</style> 