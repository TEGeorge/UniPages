window.onload = function () {
  loadDoc();
};


function loadDoc () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      console.log('Sent');
      console.log(xhttp.responseText);
    }
  };
  xhttp.open('GET', 'api/1/hello/jim', true);
  xhttp.send();
}
