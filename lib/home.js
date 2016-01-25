window.onload = function () {
  alert("About to load profile");
  loadProfile();
};

loadProfile = function () {
  request('GET', 'api/1/profile', null, null, decode, insertProfileDetails);
  request('GET', 'api/1/university', null, null, decode, insertUniDetails);
  request('GET', 'api/1/profile/posts', null, null, debug, null);
};

insertProfileDetails = function (details) {
  document.getElementById("profile-name").innerHTML = details[0].first_name + " " + details[0].surname + " : " + details[0].profileID;
};

insertUniDetails = function (details) {
  var uni = document.getElementById("profile-university");
  uni.innerHTML = details[0]['name'];
  uni.href = 'group.php?id=' + details[0]['uniID'] + '&type=university';
};

insertPosts = function (posts) {
  var formatted;
  posts = posts[0];
  var i = 0;
  for each (var post in posts) {
    formatted[i] = formatPost(post);
    i++;
  }
};
