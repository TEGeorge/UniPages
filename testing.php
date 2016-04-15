<!doctype html>
<html>

<head>
    <title>UniPages</title>

    <script src="test.js"></script>
</head>

<body>


  <pre id="test">
    </pre>

  <style>
    #dropzone {
      border: 2px dashed grey;
      text-align: center;
      padding: 10px;
      width: 200px;
      height: 200px;
      display: inline-block;
    }
  </style>
  <form onsubmit="dropLoad();return false;">
    <div id="dropzone"><h3>Drag and drop files/folders here</h3></div>
    <div id="uploaded" style="height:150px;overflow:auto;width:25%;">
      <table style="width:100%;">
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Size</th>
        </tr>
        <tbody id="upload">
        </tbody>
      </table>
    </div>
    <button type="submit">Upload</button>
    <p>Maximum Number of files 20 by php limit</p>

  </form>


  <form>
    <div id="repo" style="height:150px;overflow:auto;width:25%;">
    <table id="repotable" style="width:100%;">
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Size</th>
      </tr>
      <tbody id="files">
      </tbody>
    </table>
    </div>
    <button type="submit">Download</button>
    <button type="submit">Delete</button>
  </form>
  <form onsubmit="upload('/user/picture', input.files[0]);return false;">
    <input name="input" type="file">
    <button type="submit">Submit</button>
  </form>
  <script></script>
</body>

</html>
