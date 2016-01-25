function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
}

window.onload = function() {
  id = getUrlVars()['id'];
  type = getUrlVars()['type'];
  console.log('api/1/' + type + "/" + id);
  request ('GET', 'api/1/' + type + "/" + id, null, null, debug, insertGroupDetails);
};

function insertGroupDetails (details) {
  document.getElementById("group-name").innerHTML = details[0]['name'];
}