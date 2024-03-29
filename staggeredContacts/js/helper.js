export function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}    

export function getRequest(url, success, error, params) {
    var req = false;
    try{
        // most browsers
        req = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                return false;
            }
        }
    }
    if (!req) {return false;}
    if (typeof success !== 'function') {success = function () {};}
    if (typeof error!== 'function') {error = function () {};}



    if(params != null){

        req.open("GET", url+"?"+params, true);
        req.setRequestHeader('Cache-Control', 'no-cache');

    }else {
        req.open("GET", url, true);
    	req.setRequestHeader('Cache-Control', 'no-cache');
    }


    req.onreadystatechange = function(){
        if(req.readyState === 4) {
            return req.status === 200 ?
                success(req.responseText) : error(req.status);
        }
    };


    req.send(null);
    return req;
}

export function postRequest(url, success, error, data){
	
	var xhr = false;
    try{
        // most browsers
        xhr = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            // try an older version
            try{
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                return false;
            }
        }
    }
    //console.log(url);
	xhr.open("POST", url, true);
	//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
	//xhr.setRequestHeader('Data-Type', 'json');

    if (!xhr){return false;}
    if (typeof success !== 'function') {success = function () {};}
    if (typeof error!== 'function') {error = function () {};}

	xhr.onreadystatechange = function(){
        if(xhr.readyState === 4) {
            return xhr.status === 200 ?
                success(xhr.responseText) : error(xhr.status);
        }
    };
	xhr.send(data);
	return xhr;
}

export function toggleHidden(targetDiv) {
  var x = document.getElementById(targetDiv);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
} 

export function toggleHiddenFlex(targetDiv) {
  var x = document.getElementById(targetDiv);
  if (x.style.display === "none") {
    x.style.display = "flex";
  } else {
    x.style.display = "none";
  }
} 

export function getCookie(inputString, searchTerm)
{
    var v = parseCookie(inputString);
    var x;
    for (var i=0;i<v.length;i++)
    {
        if(v[i][0].includes(searchTerm))
        {
            x=v[i][1];
            return(x);
        }
    }
    return false;
}
export function parseCookie(inputString)
{


    let cookieAry = inputString.split(';');

    let KvP = new Array(cookieAry.length);

    for(let i = 0; i<cookieAry.length; i++)
    {
        KvP[i]=cookieAry[i].split('=');
    }

    return KvP;
}

export function keyupListener() {
    window.onkeyup = function(e) {
        if ( e.keyCode === 27 ) {
            //toggleMenuOff();
            }
        };
}

export function setCookie(fullCookieString)
{
    //console.log(fullCookieString);

    let d = new Date();
    d.setTime(d.getTime() + (8 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = fullCookieString+ ";" + expires + ";path=/";
}
export function addCookie(cname, cvalue) {
    setCookie(cname + "=" + cvalue + ";");
    //sessionStorage.setItem(cname,cvalue);
}
export function validEmail(e) {
    var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
    return String(e).search (filter) != -1;
}
export function clearAllCookies(){
    (function () {
    var cookies = document.cookie.split("; ");
    for (var c = 0; c < cookies.length; c++) {
        var d = window.location.hostname.split(".");
        while (d.length > 0) {
            var cookieBase = encodeURIComponent(cookies[c].split(";")[0].split("=")[0]) + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' + d.join('.') + ' ;path=';
            var p = location.pathname.split('/');
            document.cookie = cookieBase + '/';
            while (p.length > 0) {
                document.cookie = cookieBase + p.join('/');
                p.pop();
            };
            d.shift();
        }
    }
    })();
}
