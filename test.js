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
    });
  } else if (file instanceof File) {
    gotUpload(file);
  } else {
    console.log("unknown file type: " + (typeof file));
  }
}

var dnd = document.getElementById("dnd");
dnd.ondragover = function(e) {
  e.preventDefault()
}
dnd.ondrop = function(e) {
  e.preventDefault();

  var transfer = e.dataTransfer;

  if (transfer.getFilesAndDirectories) {
    handleFirefoxUpload(transfer);
  }
}

function handleFirefoxUpload(transfer) {
  var promise = transfer.getFilesAndDirectories();
  promise.then(function(files) {
    console.log("dropped items: " + files.length);
    for (var i = 0, arrSize = files.length; i < arrSize; i++) {
      var file = files[i];
      return iterateFilesAndDirs(file, "");
    }
  })
}

var upload = [];

function gotUpload(file) {
  window.upload.push(
    {
      file:file,
      info:
      {
        name:file.name,
        type:file.type,
        size:file.size
      }
    });
  addToUploadTable(file.name, file.type, file.size);
}

function addToUploadTable(name, type, size) {
  var row = document.createElement('tr');
  var nameData = document.createElement('td');
  nameData.innerHTML = name;
  var typeData = document.createElement('td');
  typeData.innerHTML = type;
  var sizeData = document.createElement('td');
  sizeData.innerHTML = size;
  row.appendChild(nameData);
  row.appendChild(typeData);
  row.appendChild(sizeData);
  document.getElementById('data').appendChild(row);
}

function dndUpload() {
  var files = new FormData;
  var json = [];
  for (var i = 0; i < window.upload.length; i++) {
    files.append(i, window.upload[i].file);
    json.push(window.upload[i].info);
  }
  upload('/repo/0', files, json);
  document.getElementById('data').innerHTML = "";
}

function load(results) {
  results.forEach(gotRepo)
};

function gotRepo(file) {
  addToRepoFile(id ,name, type, size)
}
