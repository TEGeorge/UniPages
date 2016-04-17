var search = function (search, type) {
  document.getElementById('results').innerHTML = "";
  get(`/search/${type}/${search}`, recieve);
};

var recieve = function (results) {
  if (results==null) {
    document.getElementById('results').innerHTML = "";
  }
  else {
    results.forEach(load)
  }
};

var load = function (result) {
  if(result['description']==null) {
    result['description'] = result['bio'];
  }
  if(result['name']==null) {
    result['name'] = `${result['fname']} ${result['surname']}`
  }
  results =document.getElementById('results');
  results.appendChild(render(result['name'], result['eid'], result['description']));
};


var render = function (name, eid, description) {
  result = document.createElement('li');
  result.setAttribute('class', "result");
  result.innerHTML =   `
      <img src="/public/picture/${eid}" onerror="this.src='/public/picture/placeholder'" alt="profile picture" id="picture-result">
      <h2 id="name-result"><a href="page.php?id=${eid}">${name}</a></h2>
      <p id="description-result">
        ${description}
      </p>`;
  return result;
}
