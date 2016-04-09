class Post {
  constructor(post) {
    this.id = post['id'];
    this.authorId = post['author']['Id'];
    this.targetID = post['targetID'];
    this.author = post['author'];
    this.target = post['target'];
    this.created_time = post['created_time'];
    this.updated_time = post['updated_time'];
    this.contents = post['content'];
    this.targetType = post['targetType'];
    if (this.targetType == 'profile') {
      this.targetUrl = `profile.php?id=${this.authorID}`;
    }
    else {
      this.targetUrl = `group.php?id=${this.targetID}&type=${this.targetType}`;
    }
    this.comments = [];
    if (post['comments']) {
      for (var i = 0; i < post['comments'].length; i++) {
        this.comments.push(new Comment (post['comments'][i], this.postID));
      }
    }
  }

  renderComments () {
    var output = ``;
    for(var i=0; i < this.comments.length; i++) {
      output = output + this.comments[i].render();
    }
    //OUTPUT + INPUT NEW COMMENTS?
    return output
  }

  render () {
    var output = `<body>
      <li>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><a id="post-author" href="profile.php?${this.authorID}">${this.author}</a> - <a id="post-target" href="${this.targetUrl}">${this.target}</a> - <a id="post-timestamp">${this.created_time}</a></h4>
          </div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <p id="post-content">
                  ${this.contents}
                </p>
              </div>
            </div>
            <ul id="comments" style="list-style-type: none;">
              ${this.renderComments()}
              <li>
                <form onsubmit='newComment(content.value,${this.postID});return false;'>
                  <div class="form-group">
                    <label for="input-post">Comment</label>
                    <textarea name="content" class="form-control" rows="3" id="input-post" style="resize:vertical"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-default">Submit</button>
                  </div>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </body>`;
    return output;
  }
}
