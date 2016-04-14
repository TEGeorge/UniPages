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
            <h2>Upload picture:</h2>
            <form onsubmit="uploadPicture(input.files[0]);return false;">
              <table style="width:50%">
                <tr>
                  <td><label for=""><input name="input" type="file"></label></td>
                  <td><button type="submit">Upload</button></td>
                </tr>
              </table>
            </form>
          </div>
        </li>

    </div>
  </section>
</body>

</html>
