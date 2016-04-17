var university, posts;

window.onload = function () {
  var url = getUrlVars();
  get(`/university/${url['id']}`, load);
  get(`/university/${url['id']}/posts`, general);
};

var load = function (university) {
  window.university = university;
  window.page = university;
  document.getElementById('name').innerHTML = `${university['name']}`;
  document.getElementById('description').innerHTML = `${university['description']}`;
  document.getElementById('profile-picture').src = `/public/picture/${university['eid']}?v=` + new Date().getTime();
};

var general = function (posts) {
  window.posts = objectifyPosts(posts);
  document.getElementById('posts').innerHTML = render(window.posts);
};
