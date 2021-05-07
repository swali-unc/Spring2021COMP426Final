import comp426twitter from '/js/comptwitterapi.js'

$( () => {
	window.AttemptLogin = AttemptLogin;
});

export function AttemptLogin() {
	const $form = $('#login-form');
	const $message = $('#message');

	$form.submit(function(e) {
		e.preventDefault();

		$message.html('');

		const data = $form.serializeArray().reduce((o, x) => {
			o[x.name] = x.value;
			return o;
		}, {});

		$.ajax({
			url: 'https://comp426-1fa20.cs.unc.edu/sessions/login',
			type: 'POST',
			data,
			xhrFields: {
				withCredentials: true,
			},
		}).then(() => {
			$message.html('<span>Success! You are now logged in, <a href="/play">go back to playing by clicking here.</a></span>');
		}).catch(() => {
			$message.html('<span>Something went wrong and you were not logged in. Check your email and password and your internet connection.</span>');
		});
	});
}