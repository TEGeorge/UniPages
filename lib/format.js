
window.onload = function () {
  document.getElementById("posts-content").appendChild(formatPost(null, null));
};

var formatPost = function (post)
{
  var postNode = document.createElement("LI");

  var nodePanel = document.createElement("div");
  nodePanel.className = "panel panel-default";

  var nodePanelHeading = document.createElement("div");
  nodePanelHeading.className = "panel-heading";
  var heading = document.createElement("h4");
  var author = document.createElement("a"); //HREF AND ID NEED ADDING?
  author.appendChild(document.createTextNode(post['author']));
  var target = document.createElement("a");
  target.appendChild(document.createTextNode(post['target']));
  var timestamp = document.createElement("a");
  timestamp.appendChild(document.createTextNode("MM:HH DD:MM:YY"));
  var nodePanelContent = document.createElement("div");
  nodePanelContent.className = "panel-body";
  var contentPanel = document.createElement("div");
  contentPanel.className = "panel panel-default";
  var contentPanelContent = document.createElement("div");
  contentPanelContent.className = "panel-body";
  var content = document.createElement("p");
  content.appendChild(document.createTextNode(post['content']));
  var commentList = document.createElement("UL");
  commentList.id = "comments";

  heading.appendChild(author);
  heading.appendChild(target);
  heading.appendChild(timestamp);
  nodePanelHeading.appendChild(heading);
  nodePanel.appendChild(nodePanelHeading);
  contentPanelContent.appendChild(commentList);
  contentPanelContent.appendChild(content);
  contentPanel.appendChild(contentPanelContent);
  nodePanelContent.appendChild(contentPanel);
  nodePanel.appendChild(nodePanelContent);
  postNode.appendChild(nodePanel);

  return postNode;
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
