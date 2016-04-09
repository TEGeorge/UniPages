var get = function (url, callback) {
  fetch('api/2'.concat(url))
    .then(function (response) {
      return response.json();
    })
    .then(function (json) {
      callback (json['payload']);
    });
};

var post = function (url, payload, callback) {
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
      callback (json['payload']);
    });
};
