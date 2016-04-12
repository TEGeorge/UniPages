var
  load = function(r) {
    /*
      request object example:
      {
        "method?": HTTP METHOD
        "url": "url to be loaded"
        "callback": {
          "load": function called after success
          "error": function called on error
        }
        "data": as object to be JSONed
      }
     */

    if (!r.method) {
      r.method = 'GET';
    }
    r.url = 'api/2'.concat(r.url);
    r.data = JSON.stringify(r.data);
    send(r);
  };

  send = function(r) {
    var x = new XMLHttpRequest();
    x.setRequestHeader("Accept", "application/json");
    x.setRequestHeader("Content-Type", "application/json");
    x.onreadystatechange = function () {
      if (x.readyState === 4 && x.status === 200) {
        response(r, xhttp.responseText);
      }
      else if (x.readyState === 4 && x.status != 200) {
        error(r, xhttp.responseText);
      }
    };
    xhttp.open(r.method, r.url, true);
    xhttp.send(r.data);
  };

  response = function(r, result) {

  };

  error = function(r, meta) {
    
  }
