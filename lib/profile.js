window.onload = function() {
  id = getUrlVars()['id'];
  console.log('api/1/profile/' + id);
  request ('GET', 'api/1/profile/' + id, null, null, debug, insertGroupDetails);
};

function insertProfileDetails (details) {
  document.getElementById("profile-name").innerHTML = details[0]['name'];
}
