<!doctype html>
<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <head>
    <script src="lib/classes.js"></script>
    <title>UniPages</title>
  </head>

  <body>
    <?php include 'header.php'; ?>
    <div id="demo">
    </div>
    <script>
      request('GET', 'api/1/profile/posts', null, null, objPosts, insertPost);
      function insertPost (result) {
        document.getElementById('demo').innerHTML = result[0].render();
      }
    </script>
  </body>
</html>
