$(document).ready(function(){
    
    var loginPage = $("#loginPage"); //get pages
    var authorPage = $("#authorPage");
    var diaryPage = $("#diaryPage");
    var userToken;

    loginPage.show(); 
    authorPage.hide();
    diaryPage.hide();


    //request code here
    var userInfo = {};
    var login = $("#login");
    

    login.click(function(a) {
        a.preventDefault();
        userInfo.user = $("#user").val();
        userInfo.password = $("#password").val();

        $.ajax({

            method:'POST', //use asim's server2 folder
            url: 'http://ceclnx01.cec.miamioh.edu/~fauzika/api/user',
            contentType: 'application/json',
            data: JSON.stringify(userInfo),
            //contentType: 'application/json',
            //crossDomain: true,
            //async: true,
            //dataType: 'jsonp',
            success: function(result){
                //console.log(JSON.parse(result));
                if(JSON.parse(result).status == "OK"){//if(JSON.parse(result).status == "OK") {//if(result=>status == "OK"){
                    diaryPage.show();
                    loginPage.hide();
                    userToken = JSON.parse(result).token;
                    //console.log(items);
                    //alert(items);//alert(userToken);
                    action2();
                    action3();
                    action4();
                    
                } else {
                    alert("Error loggin in.");

                }
                //alert("here");
            },
            error: function(e) {
                alert("There was an error requesting user authentication" + e);
            }
        });

    });
    $("#authorPageButton").click(function(a) {
         loginPage.hide();
         authorPage.show();
    });
    $("#loginPageButton").click(function(a) {
        loginPage.show();
        authorPage.hide();
   });
    
    //function recordItem(itemButton){
    $("body").on('click', '.itemButton', function() {
        var itemPK = $(this).attr('pk');
        action5(itemPK);//(itemPK);
    });

    function action2(){
        $.ajax({
            method: 'GET',
            url: 'https://ceclnx01.cec.miamioh.edu/~fauzika/api/items',
            // contentType: 'application/json',
            // responseType: 'application/json',
            // dataType: 'jsonp',
            success: function(result){
                if(JSON.parse(result).status == "OK"){
                    //console.log(jQuery.parseJSON(result).items[0]);
                    var items = JSON.parse(result).items; //JSON.parse(result=>items); 
                    var buttons = $("#buttons");
                    //alert(typeof(items));
                    //alert(jQuery.parseJSON(items));
                    //alert(JSON.parse(items));
                    for(var i = 0; i < items.length; i++){
                        //alert(items.length);
                        buttons.append("<button class=\"itemButton\" pk=" + items[i].pk + ">"+items[i].item+"</button>");
                    } 
                }else{
                    alert("Action 2 Status: Fail");
                }
                
            },
            error: function() {
                alert("There was an error requesting diary items.");
            }
        });
    }

    function action3(){
        $.ajax({
            method: 'GET',
            url:'https://ceclnx01.cec.miamioh.edu/~fauzika/api/items/' + userToken,
            success: function(result){
                if(JSON.parse(result).status == "OK"){
                    var items = JSON.parse(result).items;
                    var timestampBody = $("#timestampBody");
                    timestampBody.empty();
                    var tblData ="";
                    var lim = items.length;
                    if(lim < 30){

                    } else {
                        lim = 30;
                    }
                    for(var i = 0; i < lim; i++){
                        tblData += "<tr><td>"+items[i]["item"]+"<\/td><td>"+items[i]["timestamp"]+"<\/td><\/tr>"
                    }
                    timestampBody.append(tblData);
                }else{
                    alert("Action 3 Status: Fail");
                }
            },
            error: function() {
                alert("There was an error requesting timestamps.");
            }
        });
    }
    function action4(){
        $.ajax({
            method: 'GET',
            url:'https://ceclnx01.cec.miamioh.edu/~fauzika/api/itemsSummary/' + userToken,
            success: function(result){
                if(JSON.parse(result).status == "OK"){
                    var items = JSON.parse(result).items;
                    //console.log(items[0]);
                    var summaryBody = $("#summaryBody");
                    var tblData ="";
                    summaryBody.empty();
                    for(var i = 0; i < items.length; i++){
                        if(items[i]["item"]!=null)
                           tblData += "<tr><td>"+items[i]["item"]+"<\/td><td>"+items[i]["count"]+"<\/td><\/tr>"
                    }
                    
                    summaryBody.append(tblData);
                }else{
                    alert("Action 4 Status: Fail");
                }
            },
            error: function() {
                alert("There was an error requesting item summary.");
            }
        });
    }
    function action5(itemPK){
        var inputData = {};
        inputData.token = userToken;
        inputData.itemFK = itemPK;
        $.ajax({
            method: 'POST',
            url:'https://ceclnx01.cec.miamioh.edu/~fauzika/api/items',
            data: JSON.stringify(inputData),
            contentType: 'application/json',
            success: function(result){
                if(JSON.parse(result).status == "OK"){
                    action3();
                    action4();
                }else{
                    alert("Action 5 Status: Fail");
                }
            },
            error: function() {
                alert("Error with actoin 5");
            }
        });
    }
});
