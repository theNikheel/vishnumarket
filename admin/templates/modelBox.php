<div class="outerPopupBox" style="display:none;">
    <div class="innerPopupBox">
        <div class="container">
            <div class="row">
                <p>Do you want to delete all records of this user?</p>
                <input type="hidden" class="removeUserId">
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn  btn-success" onclick="removeUserFun()">Yes</button>
                    <button type="button" class="btn  btn-danger" onclick="hideBoxFun()">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function removeUserFun(){
    getUserId = $(".removeUserId").val();
    $.ajax({
        type:'POST',
        data:"removeUser=removeUser&getUserId="+getUserId,
        url:'model/ajaxDataModel.php',
        success: function(data){
            $("#tr_"+getUserId).remove();
            hideBoxFun();
        }
    });
}

function showConfirmBoxFun(userId){
    $(".removeUserId").val(userId);
    $(".outerPopupBox").css("display","flex");
}

function hideBoxFun(){
    $(".outerPopupBox").hide();
}

</script>

<style>
.outerPopupBox {
    position: fixed;
    background-color: rgb(0,0,0,0.8);
    width: 100%;
    left: 0px;
    z-index: 99999;
    align-items: center;
    top: 0px;
    bottom: 0px;
    justify-content: center;
    display: flex;
}

.innerPopupBox {
    background-color: #fff;
    position: absolute;
    width: 410px;
    padding: 20px 30px;
    height: auto;
    top:25%;
}

.deleteIconCls{
    cursor:pointer;
}
</style>