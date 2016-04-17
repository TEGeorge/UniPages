var group, posts;

window.onload = function () {
  var url = getUrlVars();
  get(`/group/${url['id']}`, load);
  get(`/group/${url['id']}/posts`, general);
};

var load = function (group) {
  window.group = group;
  window.page = group;
  document.getElementById('name').innerHTML = `${group['name']}`;
  document.getElementById('description').innerHTML = `${group['description']}`;
  document.getElementById('profile-picture').src = `/public/picture/${group['eid']}?v=` + new Date().getTime();
  university = document.getElementById('university');
  university.innerHTML = `${group['university']['name']}`;
  university.href = `page.php?id=${group['university']['eid']}`;
  if (group['owner']==true) {
    isowner();
  }

  if(group['course']==null) {
    document.getElementById('info_course').innerHTML = '';
  }
  else {
    course = document.getElementById('course');
    course.innerHTML = `${group['course']['name']}`;
    course.href = `page.php?id=${group['course']['eid']}`;
  }
};

var general = function (posts) {
  window.posts = objectifyPosts(posts);
  document.getElementById('posts').innerHTML = render(window.posts);
  if (!posts) {
    notMember();
  }
};

var notMember = function () {
  var member = document.getElementById('member');
  member.innerHTML = "Join";
  member.setAttribute('onclick', 'join();location.reload();');
};

var leave = function () {
  del(`/join/${window.group['id']}`)
};

var join = function () {
  post(`/join/${window.group['id']}`);
};

var isowner = function () {
  document.getElementById('owner').setAttribute('display', 'inline');
};
