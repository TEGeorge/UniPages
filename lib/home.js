window.onload = function () {
  alert("About to load profile");
  loadProfile();
};

loadProfile = function () {
  request('GET', 'api/1/profile', null, null, decode, insertProfileDetails);
  request('GET', 'api/1/university', null, null, decode, insertUniDetails);
};

insertProfileDetails = function (details) {
  document.getElementById("profile-name").innerHTML = details[0].first_name + " " + details[0].surname + " : " + details[0].profileID;
};

insertUniDetails = function (details) {
  document.getElementById("profile-university").innerHTML = details[0]['name'];
};
