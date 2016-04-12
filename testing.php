<!doctype html>
<html>

<head>
  <php ? session_start(); ?>
    <title>UniPages</title>

    <script src="test.js"></script>
</head>

<body>


  <pre id="test">
    </pre>

  <style>
    #dnd {
      border: 10px solid black;
      text-align: center;
      padding: 10px;
      width: 400px;
      height: 100px;
      margin: auto;
      font-size: 40px;
      display: inline-block;
    }
  </style>
  <form onsubmit="dndUpload();return false;">
    <div id="dnd">DROP!</div>
    <button type="submit">Submit</button>
  </form>

  <script>
    var dnd = document.getElementById("dnd");
    dnd.ondragover = function(e) {
      e.preventDefault()
    }
    dnd.ondrop = function(e) {
      e.preventDefault();

      var transfer = e.dataTransfer;

      if (transfer.getFilesAndDirectories) {
        handleFirefoxUpload(transfer);
      }
    }

    function handleFirefoxUpload(transfer) {
      var promise = transfer.getFilesAndDirectories();
      promise.then(function(files) {
        console.log("dropped items: " + files.length);
        for (var i = 0, arrSize = files.length; i < arrSize; i++) {
          var file = files[i];
          iterateFilesAndDirs(file, "");
        }
      })
    }


  </script>






  <form onsubmit="upload('/user/picture', input.files[0]);return false;">
    <input name="input" type="file">
    <button type="submit">Submit</button>
  </form>
</body>

</html>
