<!DOCTYPE html>
<html lang="en">

<?php include 'public/header.php'; ?>

<script src="lib/bin/university.js"></script>

<body>
  <section id="main">
    <div class="contentBox">
      <input class="tabs" id="tab1" type="radio" name="tabs" checked>
      <label class="tabbar" for="tab1"><span><h3 class="tab-label">Posts</h3></span></label>

      <input class="tabs" id="tab2" type="radio" name="tabs">
      <label class="tabbar" for="tab2"><span><h3 class="tab-label">FAQ</h3></span></label>

      <input class="tabs" id="tab3" type="radio" name="tabs">
      <label class="tabbar" for="tab3"><span><h3 class="tab-label">Notices</h3></span></label>

      <input class="tabs" id="tab4" type="radio" name="tabs">
      <label class="tabbar" for="tab4"><span><h3 class="tab-label">Links</h3></span></label>

      <input class="tabs" id="tab5" type="radio" name="tabs">
      <label class="tabbar" for="tab5"><span><h3 class="tab-label">Repository</h3></span></label>

      <section id="content1" class="tab-content">
        <li class="panel">
          <div class="offset">
            <form class="post-input" onsubmit="newPost(content.value);return false;">
              <h3>New Post</h3>
              <textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="content"></textarea>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </li>
        <ul class="content" id="posts">
        </ul>
      </section>
      <section id="content2" class="tab-content">
        <ul class="content">
          <li class="panel">
            <div class="offset">
            </div>
          </li>
        </ul>
      </section>
      <section id="content3" class="tab-content">
        <!--content goes here-->
      </section>
      <section id="content4" class="tab-content">
        <ul class="content">
          <li class="panel">
            <div class="offset">
              <form class="link-input">
                <h3>Add Link</h3> Link Name:
                <input type="text" name="fname">
                <br> Link:
                <input type="text" name="lname">
                <br>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
          </li>
          <li class="panel">
            <div class="offset">
              <h3>Links:</h3>
              <div id="links">
                <table style="width:90%">
                  <tr>
                    <th>Link Title</th>
                    <th>Links</th>
                  </tr>
                  <tr>
                    <td>Facebook</td>
                    <td>
                      <a href="">http://www.facebook.com</a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </li>
        </ul>
      </section>
      <section id="content5" class="tab-content">
        <ul class="content">
          <li class="panel">
            <div class="offset">
              <h3>File Repository</h3>
              <div class="square 1-1">
              </div>
              <div class="square folder">
                <h1>Hello World My Name is tom</h1>
              </div>
              <div class="square img_1-3">
                <h1>Hello World My Name is tom</h1>
              </div>
              <div class="square img_1-3">
                <h1>Hello World My Name is tom</h1>
              </div>
              <div class="square img_1-3">
                <h1>Hello World My Name is tom</h1>
              </div>
              <div id="bottom">
                <h3>The End</h3>
              </div>

            </div>
          </li>
        </ul>
      </section>
    </div>
  </section>
  <section id="info">
    <div class="infopanel">
      <div class="info-container">
        <h2 id="name">(PLACEHOLDER)</h2>
        <img src="http://placekitten.com/200/200" onerror="this.src='http://placekitten.com/200/200'" alt="profile picture" id="profile-picture">
        <h4><strong>Description: <br></strong> <a id="description">(PLACEHOLDER) </a> <br> </h4>
      </div>
    </div>
  </section>
</body>

</html>
