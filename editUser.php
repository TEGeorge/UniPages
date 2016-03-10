<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit User Info</title>
    <script src="lib/editUser.js"></script>
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
              <form onsubmit="postPicture(picture);return false;">
                <div class="form-group">
                  <label for="profile_picture">Profile Picture Upload</label>
                  <input type="file" id="picture">
                  <p class="help-block">Upload your profile picture here</p>
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
