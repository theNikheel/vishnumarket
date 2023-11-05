$(document).ready(function(){
    $('.noBlankSpace').on('keypress', function(e) {
        if (e.which == 32){
            //console.log('Space Detected');
            return false;
        }
    });
});

$(".onlyNumber").on("input", function(evt) {
    var self = $(this);
	//self.val();
	//alert(evt.which);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57))
    {
        evt.preventDefault();
    }
});

$(".onlyAlphabet").keypress(function(event){
    var inputValue = event.charCode;
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
        event.preventDefault();
    }
});

function checkDuplicateFun(thisvar){
    //console.log(thisvar);
    getValOrg = $(thisvar).val().trim();
    $(thisvar).val(getValOrg);
    colName = $(thisvar).attr('name');
    getVal = getValOrg;
    if(colName=='clientId'){
        getVal = "FX-"+getVal;    
    }
    $(thisvar).next().removeClass("success");
    $(thisvar).next().removeClass("error");
    $(thisvar).next().text("");
    
    labelText = $(thisvar).attr('placeholder'); //thisvar.dataset.labelname;
    
    if(getValOrg==""){
        $(thisvar).next().addClass("error");
        $(thisvar).next().text("This field can not be blank");
        return false;   
    }
    
    dataString = "ajaxCheckDuplicate=ajaxCheckDuplicate&colName="+colName+"&getVal="+getVal;
    $.ajax({
        type:'POST',
        data: dataString,
        url:'admin/model/ajaxDataModel.php',
        success: function(res){
            $("#checkvalue").val(res);
            if(res==0){
                $(thisvar).next().addClass("success");
                $(thisvar).next().text(labelText+" is available");
            }else{
                $(thisvar).next().addClass("error");
                $(thisvar).next().text(labelText+" is not available");
            }
        }
    });
    
}