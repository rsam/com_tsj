window.addEvent('domready', function() {
	document.formvalidator.setHandler('street',
		function (value) {
			regex=/^[^0-9]+$/;
			return regex.test(value);
	});
});