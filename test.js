var get = function (url) {
  fetch('api/2'.concat(url), {
      credentials: 'same-origin'
      })
    .then(function (response) {
      return response.json();
    })
    .then(function (json) {
      if (json['meta']['redirect']) {
        window.location = json['meta']['redirect'];
      }
      document.getElementById('test').innerHTML = JSON.stringify(json, null, 4);
    });
};

var post = function (url, payload) {
  fetch('api/2'.concat(url), {
    method: 'POST',
    credentials: 'same-origin',
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

var pictureUpload = function (url, file) {
  var data = new FormData();
  data.append('picture', file);
}

var upload = function (url, data, payload) {
  data.append('payload', JSON.stringify(payload));
  fetch('api/2'.concat(url), {
    method: 'POST',
    credentials: 'same-origin',
    body: data
  })
  .then(function (response) {
    return response.json();
  })
  .then(function (json) {
    document.getElementById('test').innerHTML = JSON.stringify(json, null, 4);
  });
}

var x = function (url, payload) {
  var
    upload = function () {
      function picture (){console.log('hello world')}
    };

};

function iterateFilesAndDirs(file, path) {
  if (file instanceof Directory) {
    file.getFilesAndDirectories()
      .then(function(subfiles) {
        for (var i = 0, arrSize = subfiles.length; i < arrSize; i++) {
          var subfile = subfiles[i];
          iterateFilesAndDirs(subfile, file.path);
        }
        console.log(subfiles);
    });
  } else if (file instanceof File) {
    addFileStructre({file:file, path:path});
  } else {
    console.log("unknown file type: " + (typeof file));
  }
}

var dir = [];

function addFileStructre(file) {
  window.dir.push(file);
  console.log(window.dir);
}

function dndUpload() {
  var data = new FormData;
  var json = [];
  for (var i = 0; i < window.dir.length; i++) {
    data.append(i, window.dir[i].file);
    json.push(window.dir[i].path);
  }
  upload('/repo/0', data, json);
}
