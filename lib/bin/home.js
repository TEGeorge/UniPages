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
  document.getElementById('profile-picture').src = `http://localhost:8080/public/picture/${user['eid']}?v=` + new Date().getTime();
  get(`/university/${user['university']['id']}/posts`, universityLoad);
  get(`/course/${user['course']['id']}/posts`, courseLoad);
  if(user['groups']==null) {
    document.getElementById('info_groups').innerHTML = '';
  }
  else {
    user['groups'].forEach(insertGroups);
  }

};

var insertGroups = function(group) {
  list = document.createElement("li");
  link = document.createElement("a");
  link.setAttribute('href', `page.php?id=${group['eid']}`);
  link.innerHTML = `${group['name']}`;
  list.appendChild(link)
  document.getElementById('groups').appendChild(list);
};
