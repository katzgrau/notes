//JAL Home Page Login Scripts

function handleKeyPress(event) {
	event = window.event ? window.event : event;
	
	//Enter Key
	if (event.keyCode == 13) {
		event.returnValue = false;
		event.cancel = true;
		
		var loginButton = document.getElementById('loginButton');
		if (loginButton.dispatchEvent) {
			var e = document.createEvent('MouseEvents');
			e.initEvent('click', true, true);
			loginButton.dispatchEvent(e);
		}
		else {
			loginButton.click();
		}
	}
}

function openLoginDialog() {
	new Dialog.Box('loginBox');
	$('loginBox').show();
}

function login(baseUrl) {
	var usernameTextBoxValue = document.getElementById('usernameTextBox').value;
	var passwordTextBoxValue = document.getElementById('passwordTextBox').value;
	
	if (usernameTextBoxValue.length == 0) usernameTextBoxValue = "0"
	if (passwordTextBoxValue.length == 0) passwordTextBoxValue = "0"
	
	var loginUrl = baseUrl + 'home/ajax_login/';
	
	var ajaxRequest = new Ajax.Request(loginUrl, {
		parameters: {site_name: usernameTextBoxValue, password: passwordTextBoxValue},
		onSuccess: function(transport) {
			if (transport.responseText != "0")
				window.location = transport.responseText;
			else {
				var loginErrorElem = document.getElementById('loginError');
				loginErrorElem.innerHTML = 'Incorrect username or password';
			}
		},
		onFailure: function(){
			var loginErrorElem = document.getElementById('loginError');
			loginErrorElem.innerHTML = 'Internal Error: Please try again.';
		}
	});
}

function loginClose() {
	document.getElementById('usernameTextBox').value = '';
	document.getElementById('passwordTextBox').value = '';
	
	var loginErrorElem = document.getElementById('loginError')
	loginErrorElem.innerHTML = '&nbsp;';
	$('loginBox').hide();
}