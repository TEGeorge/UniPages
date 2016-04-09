<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="template.css">
  <script src="lib/general/main.js"></script>
  <script src="lib/general/classes.js"></script>
  <script src="lib/bin/home.js"></script>
  <meta charset="UTF-8">
  <title>UniPages</title>
</head>

<header>
  <div class="contentBox">
    <h1><a href="">UniPages</a></h1>
    <div id="controls">
      <button>Log out</button>
      <button>Manage Account</button>
    </div>
  </div>
</header>

<body>
  <section id="main">
    <div class="contentBox">
      <input class="tabs" id="tab1" type="radio" name="tabs" checked>
      <label class="tabbar" for="tab1"><span><h3 class="tab-label">General</h3></span></label>

      <input class="tabs" id="tab2" type="radio" name="tabs">
      <label class="tabbar" for="tab2"><span><h3 class="tab-label">University</h3></span></label>

      <input class="tabs" id="tab3" type="radio" name="tabs">
      <label class="tabbar" for="tab3"><span><h3 class="tab-label">Course</h3></span></label>

      <input class="tabs" id="tab4" type="radio" name="tabs">
      <label class="tabbar" for="tab4"><span><h3 class="tab-label">Links</h3></span></label>

      <input class="tabs" id="tab5" type="radio" name="tabs">
      <label class="tabbar" for="tab5"><span><h3 class="tab-label">Repository</h3></span></label>

      <section id="content1" class="tab-content">
        <ul class="content">
          <li class="panel">
            <div class="offset">
              <h3><a href="">Author</a> To <a href="">Target</a>:</h3>

              <p class="post-content">Hello World</p>
              <p class="timestamp">HH:MM:SS - DD/MM/YY</p>
              <div class="post-buttons">
                <button type="button">Watch</button>
              </div>

              <hr>
              <ul class="comments">
                <li class="comment">
                  <h3><a href="">Author:</a></h3>
                  <p class="comment-content">Hello World</p>
                  <p class="timestamp">HH:MM:SS - DD/MM/YY</p>
                  <hr>
                </li>
                <li>
                  <form class="comment-input">
                    <h3>New Comment</h3>
                    <textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="comment"></textarea>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                </li>

              </ul>

            </div>
          </li>

          <li class="panel">
            <div class="offset">
              <form class="post-input">
                <h3>New Post</h3>
                <textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="comment"></textarea>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
          </li>

          <li class="panel">
            <div class="offset">
              <h3><a href="">Author</a> Asked <a href="">Target</a>: </h3>

              <p class="post-content">Hello World?</p>
              <p class="timestamp">HH:MM:SS - DD/MM/YY</p>
              <div class="post-buttons">

              </div>
              <hr>
              <h3><a href="">Author</a> Answered: </h3>
              <p class="post-content">Ah yes, Hello World!</p>
              <p class="timestamp">HH:MM:SS - DD/MM/YY</p>
              <hr>

              <ul class="comments">
                <li class="comment">
                  <h3><a href="">Author:</a></h3>
                  <p class="comment-content">Hello World</p>
                  <p class="timestamp">HH:MM:SS - DD/MM/YY</p>
                  <hr>
                </li>
                <li>
                  <form class="comment-input">
                    <h3>New Answer</h3>
                    <textarea class="form-control" cols="50" rows="3" style="resize:vertical" name="comment"></textarea>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                </li>

              </ul>

            </div>
          </li>

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
              <h3>File Upload</h3>
              <form action="">
                <input type="file">
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
          </li>
          <li class="panel">
            <div class="offset">
              <h3>File Repository</h3>
              <div class="square 1-1">
                <h3>Folder</h3>
              </div>
              <div class="square folder">
                <h3>.IMG</h3>
              </div>
              <div class="square img_1-3">
                <h1>Hello World My Name is tom</h1>
              </div>
              <div id="bottom">
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
        <img src="http://placekitten.com/200/200" alt="profile picture" id="profile-picture">
        <h4><strong>University: <br></strong> <a id="university">(PLACEHOLDER) </a> <br> </h4>
        <h4><strong>Course: <br></strong> <a id="course">(PLACEHOLDER) </a> <br> </h4>
        <h4><strong>Bio: <br></strong> <a id="bio">(PLACEHOLDER) </a> <br> </h4>
      </div>

    </div>
  </section>
</body>

</html>
