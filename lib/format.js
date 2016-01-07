
window.onload = function () {
  locationHTML = document.getElementById("posts-content").innerHTML;
  document.getElementById("posts-content").innerHTML = locationHTML + formatPost(null, formatComment());
};

var formatPost = function (post, comment)
{
  var tmphead = '<body> \n <div class="panel panel-default"> \n <div class="panel-heading">';
  var tmptitle = '<h4><a id="post-author" href="#"> Author</a> - <a id="post-target" href="#">Target</a> - <a id="post-timestamp">HH:MM</a></h4> \n </div>';
  var tmpcontenthead = '<div class="panel-body"> \n <div class="panel panel-default"> \n <div class="panel-body">';
  var tmpcontent = '<p id="post-content"> \n Hello World \n</p> \n </div> \n </div>';
  var tmpcomment = '<ul id="comments" style="list-style-type: none;"> \n' + comment + insertInput() + ' \n </ul>';
  var tmptail = '</div> \n </div> \n </body>';
  return '<li> \n ' + tmphead + tmptitle + tmpcontenthead + tmpcontent + tmpcomment + tmptail + '\n </li>';
};

var formatComment = function (comment)
{
  var tmphead = '<body id="comment"> \n <div class="panel panel-default"> \n  <div class="panel-heading">';
  var tmptitle = '<h5><a id="comment-author" href="#">Author</a> - <a id="comment-timestamp">HH:MM</a></h4> \n </div>';
  var tmpcontent = '<div class="panel-body"> \n <p id="comment-content"> \n Hello World \n </p> \n </div>';
  var tmptail = '\n </div> \n </body>';
  return '<li>' + tmphead + tmptitle + tmpcontent + tmptail + '</li>';
};

var insertInput = function ()
{
  var tmphead = '<form> \n <div class="form-group">';
  var tmptextinput = '<label for="input-post">Comment</label> \n <textarea class="form-control" rows="3" id="input-post" style="resize:vertical"> \n </textarea> \n </div>';
  var tmpsubmit = ' <div class="form-group"> \n <button type="submit" class="btn btn-default">Submit</button> \n </div> \n </form>';
  return '<li>' + tmphead + tmptextinput + tmpsubmit + '</li>';
};

var searchResult = function (result)
{
  var tmphead = '<div class="panel panel-default"> \n <div class="panel-body"> \n <div class="row"> \n <div class="col-sm-12">';
  var tmpresult = '<img id="result-pic" src="profile.png" alt="" class="img-circle" style="width:100%; max-width:100px;"> \n <h3 style="display:inline; margin-left:40px;"><a id="result-name" href="#">Result Name</a></h3>';
  var tmptail = '</div> \n </div> \n </div>';
  return '<li>' + tmphead + tmpresult + tmptail + '</li>';
};
