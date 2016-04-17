<!DOCTYPE html>
<html lang="en">

<script src="lib/general/main.js"></script>
<script>
  var load = function (page) {
    switch(page['type']) {
      case 'profile':
        window.location = window.location.origin+`/profile.php?id=${page['entity']}`;
        break;
      case 'course':
        window.location = window.location.origin+`/course.php?id=${page['entity']}`;
        break;
      case 'university':
        window.location = window.location.origin+`/university.php?id=${page['entity']}`;
        break;
      case 'group':
        window.location = window.location.origin+`/group.php?id=${page['entity']}`;
        break;
      }
  };

  var url = getUrlVars();
  get(`/entity/${url['id']}`, load);
</script>

<p>Redirecting...</p>

</html>
