class Post {
  constructor(post) {
    this.id = post['id'];
    this.authorId = post['author']['eid'];
    this.targetId = post['target']['eid'];
    this.author = `${post['author']['fname']} ${post['author']['surname']}`;
    if(post['target']['name']) {
      this.targetName = post['target']['name'];
    }
    else {
      this.targetName = `${post['author']['fname']} ${post['author']['surname']}`;
    }
    this.created = post['created'];
    this.updated = post['updated'];
    this.contents = post['content'];
    this.comments = [];
    if (post['comments']) {
      for (var i = 0; i < post['comments'].length; i++) {
        this.comments.push(new Comment (post['comments'][i], this.id));
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
    var output = `
    <li class="panel">
      <div class="offset">
        <h3><a href="page.php?id=${this.authorId}">${this.author}</a> To <a href="page.php?id=${this.targetId}">${this.targetName}</a>:</h3>

        <p class="post-content">${this.contents}</p>
        <p class="timestamp">${this.created}</p>
        <div class="post-buttons">
          <button type="button">Watch</button>
        </div>

        <hr>
        <ul class="comments">
          ${this.renderComments()}
        <li>
          <form class="comment-input" onsubmit='newComment(${this.id}, content.value);return false;'>
            <h3>New Comment</h3>
            <textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="content"></textarea>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </li>
        </ul>
      `;
    return output;
  }
}

class Comment {
  constructor(comment) {
    this.authorId = comment['author']['eid'];
    this.author = `${comment['author']['fname']} ${comment['author']['surname']}`;
    this.created = comment['created'];
    this.content = comment['content'];
  }

  render () {
    var output = `
    <li class="comment">
      <h3><a href="page.php?id=${this.authorId}">${this.author}:</a></h3>
      <p class="comment-content">${this.content}</p>
      <p class="timestamp">${this.created}</p>
      <hr>
    </li>
    `;
    return output;
  }
}
