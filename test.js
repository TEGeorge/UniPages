var get = function (url) {
  fetch('api/2'.concat(url))
    .then(function (response) {
      return response.json();
    })
    .then(function (json) {
      document.getElementById('test').innerHTML = JSON.stringify(json, null, 4);
    });
};
