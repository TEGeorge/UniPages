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
              <h2>Search Result:</h2>
              <ul id="results">
                <li id="result">
                  <img src="http://placekitten.com/200/200" onerror="this.src='http://placekitten.com/200/200'" alt="profile picture" id="picture-result">
                  <h3 id="name-result"><a href="">Name</a></h3>
                  <p id="description-result">
                    Hello world
                  </p>
                </li>
              </ul>
            </div>

          </div>
        </li>

    </div>
  </section>
</body>

</html>
