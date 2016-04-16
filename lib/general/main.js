var

  page; //Holds loaded page information

  /**
   * GET request
   * URL: relative url example('/user')
   * callback: callback function, parsed results are passed
   */
  get = function (url, callback) {
    fetch(window.location.origin+'/api/2'.concat(url), {
      method: 'GET',
      credentials: 'same-origin'
      })
      .then(function (response) {
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

  /**
   * DLETE request
   * URL: relative url example('/user')
   * callback: callback function, parsed results are passed
   */
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

  /**
   * POST request
   * url: relative url example('/user')
   * payload: Javascript object or array to be POSTed
   * callback: callback function, parsed results are passed
   */
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

  /**
   * PUT request
   * url: relative url example('/user')
   * payload: Javascript object or array to be PUT
   * callback: callback function, parsed results are passed
   */
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

  /**
   * File upload POST request
   * url: relative url example('/user')
   * data: File to be uploaded
   * payload: Javascript object or array to be POST
   */
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

  /**
   * Javascript redirect
   * url: url to redirect
   */
  redirect = function (url) {
    window.location=url;
  }

  /**
   * Takes javascript array of objects and attempts to parse into class Post
   * posts: Javascript array of objects that are parsable to Post object
   * RETURN: Array of Post objects
   */
  objectifyPosts= function (posts) {
    results = [];
    if (posts.length!=0) {
      for (var n = 0; n < posts.length; n++) {
        results.push(new Post(posts[n]));
      }
    }
    return results;
  };

  /**
   * Call render function on array of objects
   * objects: Javascript array of objects
   * RETURN: String of combined render of objects
   */
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

  /**
   * Triggers download of files
   * uri: Resource to download
   * name: Name of resource
   */
  download = function (uri, name) {
    uri = window.location.origin+'/api/2'.concat(uri);
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    link.setAttribute('display', 'none');
    document.body.appendChild(link);
    link.click();
  };
