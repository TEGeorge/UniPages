<!DOCTYPE html>
<html lang="en">

<?php include 'public/header.php'; ?>

<script src="lib/bin/search.js"></script>

<body>
  <section>
    <div class="center">
        <li class="panel">
          <div class="offset">
            <h2>Search:</h2>
            <form class="" onsubmit="search(searchBar.value, type.value);return false;">
              <input type="search" id="searchBox" name="searchBar">
              <select id="type" name="type">
                  <option value="profile">Profile</option>
                  <option value="group">Groups</option>
              </select>
              <button type="submit">Submit</button>
            </form>
            <div class="contentBox">
              <h2>Result:</h2>
              <ul id="results">
              </ul>
            </div>

          </div>
        </li>

    </div>
  </section>
</body>

</html>
