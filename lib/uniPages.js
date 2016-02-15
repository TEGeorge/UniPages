


function request (crud, url, payload, header, callback, extra) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      console.log('Sent Request');
      if (callback) {
      return callback(xhttp.responseText, extra);
      }
    }
  };
  xhttp.open(crud, url, true);

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
  console.log(posts.length);
  console.log(posts);
  if (posts.length!=0) {
    for (var n = 0; n < posts.length; n++) {
      console.log(n);
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

function createPost(content, author, target, targetType) {
  var post = {};
  post['content'] = content;
  post['authorID'] = author;
  post['targetID'] = target;
  post['targetType'] = targetType;
  console.log(post);
  payload = JSON.stringify(post);
  console.log(payload);
  request('POST', 'api/1/post', payload, null, debug, null);
}

function renderPosts(posts) {
  var renderedPosts = "";
  for (var i = 0; i < posts.length; i++) {
    renderedPosts = renderedPosts + posts[i].render();
  }
  return renderedPosts;
}
