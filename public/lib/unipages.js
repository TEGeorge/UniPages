


function request (crud, url, payload, header, callback, extra) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      if (callback) {
      return callback(xhttp.responseText, extra);
      }
    }
  };
  xhttp.open(crud, url, true);
  console.log(payload);
  xhttp.send(payload);
}

function debug (json, callback) {
  console.log(json);
  if (callback) {
    decode(json, callback);
  }
}

function decode (json, callback) {
  if (json.length == 0) {
    return;
  }
  content = JSON.parse(json);
  if (callback) {
    callback(content);
  }
  return content;
}

function objPosts (json, callback) {
  if (json.length == 0) {
    return;
  }
  posts = JSON.parse(json)
  results = [];
  if (posts.length!=0) {
    for (var n = 0; n < posts.length; n++) {
      results.push(new Post(posts[n]));
    }
  }
  if (callback) {
    callback (results);
  }
}

function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
}

function newPost(name, author, target, targetType) {
  content = document.forms[name]["content"]
  createPost(content, author, target, targetType);
}

function newPost(content, target, targetType) {
  var post = {};
  post['content'] = content;
  post['targetID'] = target;
  post['targetType'] = targetType;
  payload = JSON.stringify(post);
  request('POST', 'api/1/post', payload);
  window.location.reload();
}

function newComment(content, post) {
  var comment = {};
  comment['content'] = content;
  comment['postID'] = post;
  payload = JSON.stringify(comment);
  request('POST', 'api/1/comment', payload);
  window.location.reload();
}

function renderPosts(posts) {
  var renderedPosts = "";
  for (var i = 0; i < posts.length; i++) {
    renderedPosts = renderedPosts + posts[i].render();
  }
  return renderedPosts;
}
