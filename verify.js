function checked() {
  if (document.getElementById('password1').value ==
    document.getElementById('password2').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Gesli se ujemata';
	return true;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Gesli se ne ujemata';
	return false;
  }
}