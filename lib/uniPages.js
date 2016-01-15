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
