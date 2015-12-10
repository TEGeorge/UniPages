
<html>
  <body id="post">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><a id="post-author" href="#">Author</a> - <a id="post-group" href="#">Target</a> - <a id="post-time">HH:MM</a> - <a id="post-date">DD/MM/YY</a></h4>
      </div>
      <div class="panel-body">
        <div class="panel panel-default">
          <div class="panel-body">
            <p id="post-content">
              Hello World
            </p>
          </div>
        </div>
        <ul id="comments" style="list-style-type: none;">
          <li>
            <?php include 'template/comment.php'; ?>
          </li>
          <li>
            <?php include 'template/input-post.php'; ?>
          </li>
        </ul>
      </div>
    </div>
  </body>
</html>
