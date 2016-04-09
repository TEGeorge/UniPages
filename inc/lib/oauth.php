<?php
//developers.google.com/identity/protocols/OpenIDconnect
  const AUTH_ENDPOINT = 'https://accounts.google.com/o/oauth2/v2/auth';
  const TOKEN_ENDPOINT = 'https://www.googleapis.com/oauth2/v4/token';
  const CLIENT_ID = '466310370318-garp5g36h3usomluf7eim8co06ick0lr.apps.googleusercontent.com';
  const CLIENT_SECRET = 'GvCdT1OKKnit8-1nYTxTTcDj';
  const RESPONSE_TYPE = 'code';
  const SCOPE = 'openid email profile';
  const REDIRECT = 'http://localhost:8080/api/1/oauth/response';

  if (isset($routes[1])) {
    if($routes[1]== 'redirect'){
      $_SESSION['state'] = md5(uniqid(rand(), TRUE));
      $state = $_SESSION['state'];
      echo "".AUTH_ENDPOINT."?client_id=".CLIENT_ID."&response_type=".RESPONSE_TYPE."&scope=".SCOPE."&redirect_uri=".REDIRECT."&state=".$state;
    }
    if($routes[1] == 'response') {
      if(isset($_GET['state']) && ($_GET['state'] == $_SESSION['state'])) {
        $aHTTP = array(
        'http' => // The wrapper to be used
          array(
          'method'  => 'POST', // Request Method
          'header'  => 'Content-type: application/x-www-form-urlencoded',
          'content' => "code=".$_GET['code']."&client_id=".CLIENT_ID."&client_secret=".CLIENT_SECRET."&redirect_uri=".REDIRECT."&grant_type=authorization_code"
          )
        );
        $context = stream_context_create($aHTTP);
        $contents = file_get_contents(TOKEN_ENDPOINT, false, $context);
          //No need for JWT verfication due to communication directly from google
        //CONTENTS NEEDS PARSING
        $results = (array)json_decode($contents);
        list($header, $body, $sign) = explode(".", $results['id_token']);
        $body = (array)json_decode(base64_decode($body));
        if (verifyUser($body['sub'])) {
          login($body['sub']);
        }
        else {
          newUser($body);
          login($body);
        }
      }
      else {
        echo 'Liar Liar Pants on Fire Sent:'.$_SESSION['state']." Actual:".$_GET['state'];
      }
    }
  }

  function verifyUser ($gid) {
    global $DB;
    $user = $DB->query("SELECT * FROM login WHERE googleID =".$gid, True);
    if (count($user) > 0) {
      return TRUE;
    }
    //CHECK USER IS IN LOGIN DB USING groupID
    //return TRUE if success
    //FALSE IF NO RESULTS
    return FALSE;
  }

  function newUser ($details) {
    $_SESSION['gid'] = $details['sub'];
    echo ($details['sub']);
    header('Location: http://localhost:8080/newuser.php');
    exit;
  }





?>
