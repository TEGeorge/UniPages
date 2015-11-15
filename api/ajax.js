function loadDoc (document, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      document.getElementById(id).innerHTML = xhttp.responseText;
    }
  };
  xhttp.open('GET', document, true);
  xhttp.send();
}
