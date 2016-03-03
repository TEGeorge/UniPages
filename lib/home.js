window.onload = function () {
  loadProfile();
};

loadProfile = function () {
  request('GET', 'api/1/profile', null, null, decode, insertProfileDetails);
  request('GET', 'api/1/university', null, null, decode, insertUniDetails);
  request('GET', 'api/1/course', null, null, decode, insertCourseDetails);
  request('GET', 'api/1/profile/posts', null, null, objPosts, insertProfilePosts);
  request('GET', 'api/1/university/posts', null, null, objPosts, insertUniversityPosts);
  request('GET', 'api/1/course/posts', null, null, objPosts, insertCoursePosts);
  request('GET', 'api/1/group/posts', null, null, objPosts, insertGroupPosts);
};

insertProfileDetails = function (details) {
  document.getElementById("profile-name").innerHTML = details[0].first_name + " " + details[0].surname + " : " + details[0].profileID;
};

insertUniDetails = function (details) {
  var uni = document.getElementById("profile-university");
  uni.innerHTML = details[0]['uni_name'];
  uni.href = 'group.php?id=' + details[0]['uniID'] + '&type=university';
};

insertCourseDetails = function (details) {
  var course = document.getElementById("profile-course");
  course.innerHTML = details[0]['course_name'];
  course.href = 'group.php?id=' + details[0]['courseID'] + '&type=course';
};

insertProfilePosts = function (posts) {
  document.getElementById('posts-content').innerHTML = renderPosts(posts);
};

insertUniversityPosts = function (posts) {
  document.getElementById('university-content').innerHTML = renderPosts(posts);
};

insertCoursePosts = function (posts) {
  document.getElementById('course-content').innerHTML = renderPosts(posts);
};

insertGroupPosts = function (posts) {
  console.log('BUILD GROUP BACKEND');
};

//POST EVENT, BUTTON PRESS GET CONTENT AND POST TO SERVER
