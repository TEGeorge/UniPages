var user, posts;

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
};

var general = function (posts) {
  window.posts = objectifyPosts(posts);
  console.log(window.posts);
  document.getElementById('general-posts').innerHTML = render(window.posts);
};
