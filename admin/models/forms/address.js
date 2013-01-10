window.addEvent('domready', function() {
	document.formvalidator.setHandler('address',
		function (value) {
			regex=/^[^0-9]+$/;
			return regex.test(value);
	});
});