var

  page;

  get = function (url, callback) {
    fetch('api/2'.concat(url))
      .then(function (response) {
        return response.json();
      })
      .then(function (json) {
        callback (json['payload']);
      });
  };

  post = function (url, payload, callback) {
    fetch('api/2'.concat(url), {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({payload})
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (json) {
        if (callback) {
          callback (json['payload']);
        }
      });
  };

  objectifyPosts= function (posts) {
    if (posts.length!=0) {
      results = [];
      for (var n = 0; n < posts.length; n++) {
        results.push(new Post(posts[n]));
      }
    }
    return results;
  };

  render = function (objects) {
    var string = "";
    for (var i = 0; i < objects.length; i++) {
      string = string + objects[i].render();
    }
    return string;
  };

  newPost = function (content, question) {
    if (!question) {
      question = false;
    }
    post('/posts', {'target':`${window.page['eid']}`, 'content':content, 'isquestion':question}, document.location.reload(true));
  };
