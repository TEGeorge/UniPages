window.onload = function () {
  request('GET', 'api/1/profile', null, null, decode, console.log);
};


function loadDoc () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      console.log('Sent');
      console.log(xhttp.responseText);
    }
  };
  xhttp.open('GET', 'api/1/profile', true);
  xhttp.send();
}

function request (crud, url, payload, header, callback, extra) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      console.log('Sent Request');
      callback(xhttp.responseText, extra);
    }
  };
  xhttp.open(crud, url, true);
  xhttp.send(payload);
}

function decode (json, callback) {
  content = JSON.parse(json);
  callback(content);
}
