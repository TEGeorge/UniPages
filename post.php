
<html>
  <body id="post">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><a id="post-author" href="#">Author</a> - <a id="post-group" href="#"> Tom George</a> - <a id="post-time" href="#">16:05</a> - <a id="post-date" href="#">12/12/93</a></h4>
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
            <?php include 'comment.php'; ?>
          </li>
          <li>
            <?php include 'postinput.php'; ?>
          </li>
        </ul>
      </div>
    </div>
  </body>
</html>
