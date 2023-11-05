/*$(document).ready(function(){
    $("#depositeForm").submit(function(event){
    
        event.preventDefault();
        //$('#cover').text('Please wait').show();
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var formData = new FormData(this);
        $.ajax({
           url : post_url,
           type: request_method,
           data : formData,
           cache:false,
           contentType: false,
           processData: false,
        }).done(function(response){
            
        });
    });
});*/

function submitFundTransFun(){
    
    var form=$("#depositeForm");
    
    var post_url = form.attr("action"); //get form action url
    var request_method = form.attr("method"); //get form GET/POST method
    var formData = form.serialize();
    
    $.ajax({
        type: request_method,
        url: post_url,
        data: formData,
        success: function(response){
            console.log(response);  
        }
    });

}

function liveFeedFun(){
    $.ajax({
        type:'POST',
        data:"forexLiveDataAPI=forexLiveDataAPI",
        url:'model/liveFeedAPI.php',
        success: function(data){
            ajaxData = JSON.parse(data);
            lastupdated = ajaxData.updated;
            $(".lastUpdatedCls").text(lastupdated);
            //liveDataArray = ajaxData.results;
            $.each(ajaxData, function (key, val) {
                $(".feedLive_"+key).text(val);
                //console.log(key + val);
            });
        }
    });
}

function myWatchlistFun(currency,refUserId){
    
    dataString = "ajaxWatchlist=ajaxWatchlist&currency="+currency+"&refUserId="+refUserId;
    $.ajax({
        type:'POST',
        data: dataString,
        url:'model/ajaxDataModel.php',
        success: function(data){
            if(data=='add'){
                $(".icon_"+currency).removeClass("icon-heart");
                $(".icon_"+currency).addClass("icon-heart-on");
            }else{
                $(".icon_"+currency).removeClass("icon-heart-on");
                $(".icon_"+currency).addClass("icon-heart");
            }
        }
    });
}