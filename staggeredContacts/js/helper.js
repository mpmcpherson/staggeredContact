function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}    


// helper function for cross-browser request object
function getRequest(url, success, error, params) {
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


function postRequest(url, success, error, data){
	
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
    console.log(url);
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

function toggleHidden(targetDiv) {
  var x = document.getElementById(targetDiv);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
} 