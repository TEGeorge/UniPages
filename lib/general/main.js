var

  page;

  get = function (url, callback) {
    fetch(window.location.origin+'/api/2'.concat(url), {
      method: 'GET',
      credentials: 'same-origin'
      })
      .then(function (response) {
        console.log(response.headers.get('Content-Type'));
        if (response.headers.get('Content-Type')===('application/octet-stream')){
          download(response);
        }
        return response.json();
      })
      .then(function (json) {
        if (json['meta']['redirect']) {
          window.location = json['meta']['redirect'];
        }
        callback (json['payload']);
      });
  };

  del = function (url, callback) {
    fetch(window.location.origin+'/api/2'.concat(url), {
      method: 'DELETE',
      credentials: 'same-origin'
      })
      .then(function (response) {
        return response.json();
      })
      .then(function (json) {
        if (json['meta']['redirect']) {
          window.location = json['meta']['redirect'];
        }
        callback (json['payload']);
      });
  };

  post = function (url, payload, callback) {
    fetch(window.location.origin+'/api/2'.concat(url), {
      method: 'POST',
      credentials: 'same-origin',
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
        if (json['meta']['redirect']) {
          window.location = json['meta']['redirect'];
        }
        if (callback) {
          callback (json['payload']);
        }
      });
  };

  put = function (url, payload, callback) {
    fetch(window.location.origin+'/api/2'.concat(url), {
      method: 'PUT',
      credentials: 'same-origin',
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

  upload = function (url, data, payload) {
    if (payload) {
      data.append('payload', JSON.stringify(payload));
    }
    fetch(window.location.origin+'/api/2'.concat(url), {
      method: 'POST',
      credentials: 'same-origin',
      body: data
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

  redirect = function (url) {
    window.location=url;
  }

  objectifyPosts= function (posts) {
    results = [];
    if (posts.length!=0) {
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

  newComment = function (id, content) {
    post(`/posts/${id}/comment`, {'content':content}, document.location.reload(true));
  };

  getUrlVars = function () {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
    });
    return vars;
  }

  redirectUploadPicture = function () {
    window.location = `/new/picture.php?id=${window.page['eid']}`
  }

  download = function (uri, name) {
    uri = window.location.origin+'/api/2'.concat(uri);
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    link.setAttribute('display', 'none');
    document.body.appendChild(link);
    link.click();
  };
