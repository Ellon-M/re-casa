(function($) {

	'use strict';

	/*
	Contact Form: Basic
	*/
	$('#contact-form').validate({
		submitHandler: function(form) {

			var $form = $(form),
				$submitButton = $(this.submitButton);

				$form.submit();
		}
	});


}).apply(this, [jQuery]);