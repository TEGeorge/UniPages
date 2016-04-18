var user, posts;

var general = function (posts) {
  window.posts = objectifyPosts(posts);
  document.getElementById('general-posts').innerHTML = render(window.posts);
};

var universityLoad = function (posts) {
  var university = objectifyPosts(posts);
  document.getElementById('university-posts').innerHTML = render(university);
};

var courseLoad = function (posts) {
  var course = objectifyPosts(posts);
  document.getElementById('course-posts').innerHTML = render(course);
};

window.onload = function () {
  get('/user', load);
  get('/user/posts', general);
  repoLoad();
};

var load = function (user) {
  window.user = user;
  window.page = user;
  document.getElementById('name').innerHTML = `${user['fname']} ${user['surname']}`;
  university = document.getElementById('university');
  university.innerHTML = `${user['university']['name']}`;
  university.href = `page.php?id=${user['university']['eid']}`;
  course = document.getElementById('course');
  course.innerHTML = `${user['course']['name']}`;
  course.href = `page.php?id=${user['course']['eid']}`;
  document.getElementById('bio').innerHTML = `${user['bio']}`;
  document.getElementById('profile-picture').src = `/public/picture/${user['eid']}?v=` + new Date().getTime();
  get(`/university/${user['university']['id']}/posts`, universityLoad);
  get(`/course/${user['course']['id']}/posts`, courseLoad);
  if(user['groups']==null) {
    document.getElementById('info_groups').innerHTML = '';
  }
  else {
    user['groups'].forEach(insertGroups);
  }
  get(`/repo/${user['eid']}`, populateRepo);
};



var uploadDir = [];

/**
 * Set events for drag and drop div
 * Partly inspired from: http://stackoverflow.com/questions/23423163/html5-drag-and-drop-folder-detection-in-firefox-is-it-even-possible
 */
var repoLoad = function () {
  var drop = document.getElementById("dropzone");
  drop.ondragover = function(e) {
    e.preventDefault();
  }
  drop.ondrop = function(e) {
    e.preventDefault();

    var data = e.dataTransfer;

    //Using new function getFilesAndDirectories
    if (data.getFilesAndDirectories) {
      handle(data);
    }
  }
};

/**
 * Iterate through dropped files/file
 * @param  {File} data Drag and dropped files
 */
function handle(data) {
  data.getFilesAndDirectories()
    .then(function(files) {
      for (var i = 0, arrSize = files.length; i < arrSize; i++) {
        var file = files[i];
        getFiles(file);
      }
    })
};

function sendUpload() {
  var files = new FormData;
  var info = [];
  for (var i = 0; i < window.uploadDir.length; i++) {
    files.append(i, window.uploadDir[i].file);
    info.push(window.uploadDir[i].info);
  }
  upload(`/repo/${window.page['eid']}`, files, info);
  document.getElementById('upload').innerHTML = "";
}

/**
 * Get file or recursively iterate through sub directory
 * @param  {File} file file or directory
 */
function getFiles(file) {
  if (file instanceof Directory) {
    file.getFilesAndDirectories()
      .then(function(subfiles) {
        for (var i = 0, arrSize = subfiles.length; i < arrSize; i++) {
          var subfile = subfiles[i];
          getFiles(subfile, file.path);
        }
    });
  } else if (file instanceof File) {
    addToUpload(file);
  } else {
    console.log("unknown file type: " + (typeof file));
  }
};

function addToUpload(file) {
  if(window.uploadDir.length > 20) {
    alert('You cannot upload more then 20 files');
  }
  else {
    window.uploadDir.push(
      {
        file:file,
        info:
        {
          name:file.name,
          type:file.type,
          size:file.size
        }
      });
    insertUploadTable(file.name, file.type, file.size);
  }

};

function insertUploadTable(name, type, size) {
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
  document.getElementById('upload').appendChild(row);
};

var insertGroups = function(group) {
  list = document.createElement("li");
  link = document.createElement("a");
  link.setAttribute('href', `page.php?id=${group['eid']}`);
  link.innerHTML = `${group['name']}`;
  list.appendChild(link)
  document.getElementById('groups').appendChild(list);
};

var populateRepo = function(files) {
  files.forEach(insertRepo);
}

var insertRepo = function (file) {
  var row = document.createElement('tr');
  row.setAttribute('onclick', `SelectRow(${file['id']}, '${file['name']}', this);`);
  row.id = `${file['id']}`
  var nameData = document.createElement('td');
  var sizeData = document.createElement('td');
  var typeData = document.createElement('td');
  nameData.innerHTML = file['name'];
  typeData.innerHTML = file['type'];
  sizeData.innerHTML = file['size'];
  row.appendChild(nameData);
  row.appendChild(sizeData);
  row.appendChild(typeData);
  document.getElementById('files').appendChild(row);
};

var currentRowId=-1;
var currentSelected = null;
var currentName = null;

function SelectRow(id, name, selected)
{
  if(currentRowId!=-1) {
    currentSelected.bgColor = '';
  }
  selected.bgColor = '#90caf9';
  currentSelected = selected;
  currentRowId = id;
  currentName = name;
}

function downloadFile(id, name) {
  if (id!=-1) {
    download(`/repo/${window.user.eid}/${id}`, name);
  }
}
