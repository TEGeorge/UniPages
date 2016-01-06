var postformatter = function (id) {
  position = document.getElementById(id);
  position.innerHTML = "<li><?php $author = 'test'; include ('../template/post.php'); ?></li>";
};

window.onload = function () {
  locationHTML = document.getElementById("posts-content").innerHTML;
  document.getElementById("posts-content").innerHTML = locationHTML + formatpost(null);
};

var formatPost = function (post)
{
  var tmphead = '<body> \n <div class="panel panel-default"> \n <div class="panel-heading">';
  var tmptitle = '<h4><a id="post-author" href="#">Author</a> - <a id="post-target" href="#">Target</a> - <a id="post-timestamp">HH:MM</a></h4> \n </div>';
  var tmpcontenthead = '<div class="panel-body"> \n <div class="panel panel-default"> \n <div class="panel-body">';
  var tmpcontent = '<p id="post-content"> \n Hello World \n</p> \n </div> \n </div>';
  var tmpcomment = '<ul id="comments" style="list-style-type: none;"> \n <li> \n </li> \n </ul>';
  var tmptail = '</div> \n </div> \n </body>';
  return '<li> \n ' + tmphead + tmptitle + tmpcontenthead + tmpcontent + tmpcomment + tmptail + '\n </li>';
};
