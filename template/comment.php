<html>
  <body>
    <form <?php echo "onsubmit='createComment(content.value,".$author.",".$target.",\"".$targetType."\");return false;'";?> >
      <div class="form-group">
        <label for="input-post">Comment</label>
        <textarea class="form-control" rows="3" id="input-post" style="resize:vertical" name="content"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </body>
</html>
