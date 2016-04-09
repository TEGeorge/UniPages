var user;

window.onload = function () {
  get('/user', load);
};

var load = function (user) {
  window.user = user;
  document.getElementById('name').innerHTML = `${user['fname']} ${user['surname']}`;
  university = document.getElementById('university');
  university.innerHTML = `${user['university']['name']}`;
  university.href = `page.php?id=${user['university']['eid']}`;
  course = document.getElementById('course');
  course.innerHTML = `${user['course']['name']}`;
  course.href = `page.php?id=${user['course']['eid']}`;
  document.getElementById('bio').innerHTML = `${user['bio']}`;
};
