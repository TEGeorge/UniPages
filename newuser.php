<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <script src="lib/newuser.js"></script>
    <title>New User</title>
  </head>
  <body>
    <?php include 'header.php'; ?>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 id="profile-name">User Details</h2>
            </div>
            <div class="panel-body">
              <form onsubmit="newUser(first_name.value, surname.value, email.value, profile_picture.value);return false;">
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" id="first_name" placeholder="Jane">
                </div>
                <div class="form-group">
                  <label for="surname">Surname</label>
                  <input type="text" class="form-control" id="surname" placeholder="Bloggs">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                </script>
                <div class="form-group">
                  <label for="profile_picture">Profile Picture Upload</label>
                  <input type="file" id="profile_picture">
                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
            </div>
        </div>
        <div class="col-sm-4">

        </div>
      </div>
  </body>
</html>
