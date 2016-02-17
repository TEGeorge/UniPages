<html>
  <body>
    <form <?php echo "onsubmit='newPost(content.value,".$target.",\"".$targetType."\");return false;'";?> >
      <div class="form-group">
        <label for="input-post">Create New Post</label>
        <textarea class="form-control" rows="3" id="input-post" style="resize:vertical" name="content"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </body>
</html>
