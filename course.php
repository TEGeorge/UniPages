<!DOCTYPE html>
<html lang="en">

<?php include 'public/header.php'; ?>

<script src="lib/bin/course.js"></script>

<body>
  <section id="main">
    <div class="contentBox">
        <div class="panel">
          <div class="offset">
            <form class="post-input" onsubmit="newPost(content.value);return false;">
              <h3>New Post</h3>
              <textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="content"></textarea>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </div>
        <ul class="content" id="posts">
        </ul>

    </div>
  </section>
  <section id="info">
    <div class="infopanel">
      <div class="info-container">
        <h2 id="name">(PLACEHOLDER)</h2>
        <img onerror="this.src='/public/picture/placeholder'" alt="profile picture" id="profile-picture">
        <h4><strong>Description: <br></strong> <a id="description">(PLACEHOLDER) </a> <br> </h4>
        <h4><strong>University: <br></strong> <a id="university">(PLACEHOLDER) </a> <br> </h4>
        <h4 id="info_units"><strong>Units: <br></strong>
          <ul id="units">
          </ul>
        </h4>
      </div>
    </div>
  </section>
</body>

</html>
