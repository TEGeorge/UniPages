function loadDoc (URI, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      var test = document.getElementById('dynmic_content');
      test.innerHTML = xhttp.responseText;
      console.log('Hello World');
    }
  };
  xhttp.open('GET', URI, true);
  xhttp.send();
}
