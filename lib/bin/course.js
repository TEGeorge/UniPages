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
  document.getElementById('profile-picture').src = `http://localhost:8080/public/picture/${course['eid']}?v=` + new Date().getTime();
};

var general = function (posts) {
  window.posts = objectifyPosts(posts);
  document.getElementById('posts').innerHTML = render(window.posts);
};
