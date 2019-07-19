//common function to call the post services
function doPost($http, url, opt, token, callback){
    //console.log("opt")
    //console.log(JSON.stringify(opt));
    //console.log(isIE());
    if(opt=='undefined'){
        var opt = {};
    }
    if(isIE()<=9 && isIE()>0){
        //console.log("sadsadsads");
        //opt = opt['data']!='undefined' ? opt : {data: opt};
        if(token === '') {
            var token = localStorage.getItem("token");
        }
        $.ajax({
            url: url,
            type: "POST",
            data: JSON.stringify(opt),
            contentType: "application/json",
            headers: {
                "Content-Type" : 'application/x-www-form-urlencoded; charset=utf-8',
                "X-API-TOKEN" : token
            },
            success: function(data){
                console.log("data",JSON.stringify(data));
                callback(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                callback(jqXHR);
            }
        });
    }else{
        if(token === '') {
            var token = localStorage.getItem("token");
        }
        $http({
            method: "POST",
            url: url,
            data    : opt,
            //headers: {"Content-Type" : 'application/x-www-form-urlencoded; charset=utf-8'}
            headers: {
                "Content-Type" : 'application/x-www-form-urlencoded; charset=utf-8',
                "X-API-TOKEN" : token,
                // "Access-Control-Allow-Origin": "*",
                // "Access-Control-Allow-Headers": "origin, content-type, accept, authorization",
                // "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS, HEAD"
            }
            //headers : { "Content-Type" : "application/json; charset=UTF-8"}
        })
        .success( function(data, status, headers, config){ 
            callback(data);
        })
        .error(function(data, status, headers, config){
            callback(data);
            //callLogServiceOnError($http, url, status, {reqObj: opt}, 'application/x-www-form-urlencoded; charset=UTF-8', data, config);
        });
    }
};


//common function to call the get services
function doGet($http, url, callback){
    if(isIE()<=9 && isIE()>0){
        $.ajax({
            url: url,
            type: "GET",
            success: function(data){
                callback(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                callback(jqXHR);
            }
        });
    }else{
        $http({
            method: "GET",
            url: url,
            //headers : {"Content-Type" : "application/x-www-form-urlencoded; charset=UTF-8"}
            //headers : {"Content-Type" : "application/json; charset=UTF-8"}
        })
        .success( function(data, status, headers, config){      
            callback(data);
        })
        .error(function(data, status, headers, config){
            callback(data);
            //callLogServiceOnError($http, url, status, 'application/x-www-form-urlencoded; charset=UTF-8', data, config);
        });
    }
};

function doPostImage($http, url, opt, token, callback){
    if(token === '') {
        var token = localStorage.getItem("token");
    }
    $http({
        method: "POST",
        url: url,
        data    : opt,
        headers: {"Content-Type" : undefined,"X-API-TOKEN" : token}
        // headers : { "Content-Type" : "application/json; charset=UTF-8"}
    })
    .success( function(data, status, headers, config){      
        callback(data);
    })
    .error(function(data, status, headers, config){
        callback(data);
        //callLogServiceOnError($http, url, status, {reqObj: opt}, 'application/x-www-form-urlencoded; charset=UTF-8', data, config);
    });
};


function doPostJson($http, url, opt, token, callback){
    if(token === '') {
        var token = localStorage.getItem("token");
    }
    $http({
        method: "POST",
        url: url,
        data    : opt,
        headers : { "Content-Type" : "application/json; charset=UTF-8","X-API-TOKEN" : token}
    })
    .success( function(data, status, headers, config){      
        callback(data);
    })
    .error(function(data, status, headers, config){
        callback(data);
        //callLogServiceOnError($http, url, status, {reqObj: opt}, 'application/x-www-form-urlencoded; charset=UTF-8', data, config);
    });
};

function isIE () {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
};

function doPostWithOutToken($http, url, opt, token, callback){
    //console.log("opt")
    //console.log(JSON.stringify(opt));
    //console.log(isIE());
    if(opt=='undefined'){
        var opt = {};
    }
    if(isIE()<=9 && isIE()>0){
        //console.log("sadsadsads");
        //opt = opt['data']!='undefined' ? opt : {data: opt};
        if(token === '') {
            var token = localStorage.getItem("token");
        }
        $.ajax({
            url: url,
            type: "POST",
            data: JSON.stringify(opt),
            contentType: "application/json",
            headers: {
                "Content-Type" : 'application/x-www-form-urlencoded; charset=utf-8',
            },
            success: function(data){
                callback(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                callback(jqXHR);
            }
        });
    }else{
        if(token === '') {
            var token = localStorage.getItem("token");
        }
        $http({
            method: "POST",
            url: url,
            data    : opt,
            headers: {
                "Content-Type" : 'application/x-www-form-urlencoded; charset=utf-8',
            }
        })
        .success( function(data, status, headers, config){ 
            callback(data);
        })
        .error(function(data, status, headers, config){
            callback(data);
        });
    }
};