var get = function (url) {
  fetch('api/2'.concat(url))
    .then(function (response) {
      return response.json();
    })
    .then(function (json) {
      document.getElementById('test').innerHTML = JSON.stringify(json, null, 4);
    });
};

var post = function (url, payload) {
  fetch('api/2'.concat(url), {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({payload})
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (json) {
      document.getElementById('test').innerHTML = JSON.stringify(json, null, 4);
    });
};
