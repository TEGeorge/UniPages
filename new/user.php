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
    <h1><a>UniPages</a></h1>
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
            <h2>New User:</h2>
            <form class="" onsubmit="newUser(fname.value, surname.value, email.value, university.value, course.value, bio.value, private.value);return false;">
              <table style="width:50%">
                <tr>
                  <td><label for="">First Name</label></td>
                  <td><input name="fname" type="text"></td>
                </tr>
                <tr>
                  <td><label for="">Last Name</label></td>
                  <td><input name="surname" type="text"></td>
                </tr>
                <tr>
                  <td><label for="">Email</label></td>
                  <td><input name="email" type="text"></td>
                </tr>
                <tr>
                  <td><label for="">University</label></td>
                  <td>
                    <select id="university" name="university" onchange="get(`/university/${university.value}/courses`, populateCourses);">
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="">Course</label></td>
                  <td>
                    <select id="course" name="course">
                      <option value="profile">Profile</option>
                      <option value="group">Groups</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="">Bio</label></td>
                  <td><textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="bio"></textarea></td>
                </tr>
                <tr>
                  <td><label for="">Private</label></td>
                  <td>
                    <select id="private" name="private">
                      <option value="false">False</option>
                      <option value="true">True</option>
                    </select>
                  </td>
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
