var course, posts;

window.onload = function () {
  var url = getUrlVars();
  get(`/course/${url['id']}`, load);
  get(`/course/${url['id']}/posts`, general);
};

var load = function (course) {
  window.course = course;
  window.page = course;
  document.getElementById('name').innerHTML = `${course['name']}`;
  document.getElementById('description').innerHTML = `${course['description']}`;
  document.getElementById('university').innerHTML = `${course['university']['name']}`;
  document.getElementById('profile-picture').src = `/public/picture/${course['eid']}?v=` + new Date().getTime();
  if(course['units']==null) {
    document.getElementById('info_units').innerHTML = '';
  }
  else {
    course['units'].forEach(insertUnits);
  }
};

var insertUnits = function(group) {
  list = document.createElement("li");
  link = document.createElement("a");
  link.setAttribute('href', `page.php?id=${group['eid']}`);
  link.innerHTML = `${group['name']}`;
  list.appendChild(link)
  document.getElementById('units').appendChild(list);
};


var general = function (posts) {
  window.posts = objectifyPosts(posts);
  document.getElementById('posts').innerHTML = render(window.posts);
};
