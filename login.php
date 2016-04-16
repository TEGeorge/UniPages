<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="public/mystyle.css">
  <script src="lib/general/main.js"></script>
  <meta charset="UTF-8">
  <title>UniPages</title>
</head>

<?php
  session_start();
  if (isset($_SESSION['authorised']) && $_SESSION['authorised'] == True) {
    if (!isset($_SESSION['login']) || $_SESSION['login'] === FALSE) {
      header("Location: /new/user.php");
    } else {
      header("Location: /home.php");
    }
  }
?>

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
        <li class="panel">
          <div class="offset">
            <h2>Testing Purposes</h2>
            <div class="contentBox">
              <p style="color:red;">Due to google oAuth not able to redirect to a public IP address, it is not possible for oAuth to work on VM's.
                oAuth will only work when the server is hosted at localhost, as it also will only redirect to specfied uris.
                To get around this for testing purposes I have added alternative methods of creating users and logging in:
              </p>
              <button onclick="redirect('/new/debugUser.php');return false;">Create new user</button>
              <form>
                <select id="login">
                </select>
                <button onclick="loginSelected(login.value);return false;">Login as selected</button>
              </form>
            </div>

          </div>
        </li>
    </div>
  </section>
</body>

<script>

var populateLogins = function (results) {
  var login = document.getElementById('login')
  login.innerHTML = "";
  results.forEach(function (result) {
    option = document.createElement('option');
    option.value = result['id'];
    option.innerHTML = `${result['fname']} ${result['surname']}`;
    login.appendChild(option);
  });
};

get('/debug/user', populateLogins);

var loginSelected = function (id) {
  get(`/debug/login/${id}`);
};
</script>

</html>
