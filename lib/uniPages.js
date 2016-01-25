


function request (crud, url, payload, header, callback, extra) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      console.log('Sent Request');
      if (callback) {
      return callback(xhttp.responseText, extra);
      }
    }
  };
  xhttp.open(crud, url, true);

  xhttp.send(payload);
}

function debug (json, callback) {
  console.log(json);
  decode(json, callback);
}

function decode (json, callback) {
  content = JSON.parse(json);
  if (callback) {
    callback(content);
  }
  return content;
}
