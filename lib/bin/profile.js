var profile, posts;

window.onload = function () {
  var url = getUrlVars();
  get(`/profile/${url['id']}`, load);
  get(`/profile/${url['id']}/posts`, general);
};

var load = function (profile) {
  window.profile = profile;
  window.page = profile;
  document.getElementById('name').innerHTML = `${profile['fname']} ${profile['surname']}`;
  university = document.getElementById('university');
  university.innerHTML = `${profile['university']['name']}`;
  university.href = `page.php?id=${profile['university']['eid']}`;
  course = document.getElementById('course');
  course.innerHTML = `${profile['course']['name']}`;
  course.href = `page.php?id=${profile['course']['eid']}`;
  document.getElementById('bio').innerHTML = `${profile['bio']}`;
  document.getElementById('profile-picture').src = `http://localhost:8080/public/picture/${profile['eid']}?v=` + new Date().getTime();
};

var general = function (posts) {
  window.posts = objectifyPosts(posts);
  console.log(window.posts);
  document.getElementById('posts').innerHTML = render(window.posts);
};
