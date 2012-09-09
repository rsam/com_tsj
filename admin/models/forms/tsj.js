window.addEvent('domready', function() {
	document.formvalidator.setHandler('name',
		function (value) {
			regex=/^[^0-9]+$/;
			return regex.test(value);
	});
});