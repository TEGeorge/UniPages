<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../public/mystyle.css">
  <script src="../lib/general/main.js"></script>
  <script src="../lib/bin/new.js"></script>
  <meta charset="UTF-8">
  <title>UniPages</title>
</head>

<header>
  <div class="contentBox">
    <h1><a href="../home.php">UniPages</a></h1>
    <div id="controls">
      <button onclick="get('/logout');return false;">Log out</button>
    </div>
  </div>
</header>



<body>
  <section>
    <div class="center">
        <li class="panel">
          <div class="offset">
            <h2>New Course:</h2>
            <form class="" onsubmit="newCourse(name.value, description.value);return false;">
              <table style="width:50%">
                <tr>
                  <td><label for="name">Name</label></td>
                  <td><input name="name" type="text"></td>
                </tr>
                <tr>
                  <td><label for="">Description</label></td>
                  <td><textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="description"></textarea></td>
                </tr>
                <tr>
                  <td><button type="submit">Submit</button></td>
                </tr>
              </table>

            </form>

          </div>
        </li>

    </div>
  </section>
</body>

</html>
