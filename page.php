<!DOCTYPE html>
<html lang="en">

<script src="lib/general/main.js"></script>
<script>
  var load = function (page) {
    switch(page['type']) {
      case 'profile':
        window.location = `http://localhost:8080/profile.php?id=${page['entity']}`;
        break;
      case 'course':
        window.location = `http://localhost:8080/course.php?id=${page['entity']}`;
        break;
      case 'university':
        window.location = `http://localhost:8080/university.php?id=${page['entity']}`;
        break;
      case 'group':
        window.location = `http://localhost:8080/group.php?id=${page['entity']}`;
        break;
      }
  };

  var url = getUrlVars();
  get(`/entity/${url['id']}`, load);
</script>

<p>Redirecting...</p>

</html>
