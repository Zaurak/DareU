function validateSignInForm() {
	// TODO
}


function validateSignUpForm() {
	alert('Pouet');
	return (checkName() && checkEmail() && checkPassword());
}

function checkName() {
	var name = document.getElementById('username');

	if(nickname.value == '' || nickname.value.length <= 4) {
		// Nickname is required and must be at least 4 characters long
		nickname.style.color = 'red';
		return false;
	}
	else {
		nickname.style.color = 'black';
		return true;
	}
}

function checkEmail() {
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	if(!filter.test(email.value) || email.value == '') {
		email.style.color = 'red';
		return false;
	}
	else {
		email.style.color = 'black';
		return true;
	}
}

function checkPassword() {
	var password = document.getElementById('password');
	if(password.value == '' || password.value.length < 4) {
		password.style.color = 'red';
		return false;
	}
	else {
		password.style.color = 'black';
		return true;
	}
}

