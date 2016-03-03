var newUser = function (first_name, surname, email, profile_pic) {
  var user = {};
  user['first_name'] = first_name;
  user['surname'] = surname;
  user['email'] = email;

  payload = JSON.stringify(user);
  if (profile_pic!='') {
    var formData = new FormData();
    formData.append("profile_picture", profile_pic);
    }
  request('POST', 'api/1/profile', payload);
}
