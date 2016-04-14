<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="public/mystyle.css">
  <script src="lib/general/main.js"></script>
  <meta charset="UTF-8">
  <title>UniPages</title>
</head>

<header>
  <div class="contentBox">
    <h1><a href="/home.php">UniPages</a></h1>
  </div>
</header>

<body>
  <section>
    <div class="center">
        <li class="panel">
          <div class="offset">
            <h2>Login:</h2>
            <div class="contentBox">
              <p>Login or create a new account using Google</p>
              <img style="cursor:pointer;"
                onmouseover="this.src='/public/img/btn_google_signin_focus.png';"
                onmouseout="this.src='/public/img/btn_google_signin_normal.png';"
                onclick="this.src='/public/img/btn_google_signin_pressed.png';get('/oauth');return false;"
                class="center-block" src="public/img/btn_google_signin_normal.png" alt="Google Sign in Button">
            </div>

          </div>
        </li>

    </div>
  </section>
</body>

</html>
