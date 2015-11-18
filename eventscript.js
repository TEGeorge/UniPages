window.onload = function() {
  var elem = document.getElementById('posts.flip');
  elem.addEventListener("onclick", loadDoc('profile_posts.html', 'dynmic_content'), false);
  if (elem.checked)
  {
    loadDoc('profile_posts.html', 'dynmic_content');
  }
}
