var postPicture = function (picture) {
  if (picture!='') {
    var formData = new FormData();
    formData.append("profile_picture", picture.files[0]);
    request('POST', 'api/1/profile/picture', formData);
    }
};
