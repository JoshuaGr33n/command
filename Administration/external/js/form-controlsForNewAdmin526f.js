// Class definition
var KTFormControls = function () {
	// Private functions
	var _initDemo1 = function () {
		FormValidation.formValidation(
			document.getElementById('kt_form_1'),
			{
				fields: {
					firstname: {
						validators: {
							notEmpty: {
								message: 'Please Input First Name'
							}/*,
							emailAddress: {
								message: 'The value is not a valid email address'
							}*/
						}
					},

					lastname: {
						validators: {
							notEmpty: {
								message: 'Last Name is required'
							}/*,
							uri: {
								message: 'The website address is not valid'
							}*/
						}
					},


					
					email: {
						validators: {
							/*notEmpty: {
								message: 'Please Input First Name'
							},*/
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},

					phone: {
						validators: {
							/*notEmpty: {
								message: 'US phone number is required'
							},*/
							phone: {
								country: 'US',
								message: 'The value is not a valid US phone number eg: (+234) 8034679644'
							}
						}
					},
					

					gender: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly check this'
							}
						}
					},

					
					status: {
						validators: {
							notEmpty: {
								message: 'Please select a Status appointment'
							}
						}
					},

					session: {
						validators: {
							notEmpty: {
								message: 'School session is required'
							}
						}
					},

					term: {
						validators: {
							notEmpty: {
								message: 'Term is required'
							}
						}
					},

					file: {
						validators: {
							notEmpty: {
								message: 'Please Upload a file'
							}
						}
					},

					subjectID: {
						validators: {
							notEmpty: {
								message: 'Select Subject ID'
							}
						}
					},


					
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	}

	var _initDemo2 = function () {
		FormValidation.formValidation(
			document.getElementById('kt_form_2'),
			{
				fields: {
					billing_card_name: {
						validators: {
							notEmpty: {
								message: 'Card Holder Name is required'
							}
						}
					},
					billing_card_number: {
						validators: {
							notEmpty: {
								message: 'Credit card number is required'
							},
							creditCard: {
								message: 'The credit card number is not valid'
							}
						}
					},
					billing_card_exp_month: {
						validators: {
							notEmpty: {
								message: 'Expiry Month is required'
							}
						}
					},
					billing_card_exp_year: {
						validators: {
							notEmpty: {
								message: 'Expiry Year is required'
							}
						}
					},
					billing_card_cvv: {
						validators: {
							notEmpty: {
								message: 'CVV is required'
							},
							digits: {
								message: 'The CVV velue is not a valid digits'
							}
						}
					},

					billing_address_1: {
						validators: {
							notEmpty: {
								message: 'Address 1 is required'
							}
						}
					},
					billing_city: {
						validators: {
							notEmpty: {
								message: 'City 1 is required'
							}
						}
					},
					billing_state: {
						validators: {
							notEmpty: {
								message: 'State 1 is required'
							}
						}
					},
					billing_zip: {
						validators: {
							notEmpty: {
								message: 'Zip Code is required'
							},
							zipCode: {
								country: 'US',
								message: 'The Zip Code value is invalid'
							}
						}
					},

					billing_delivery: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly select delivery type'
							}
						}
					},
					package: {
						validators: {
							choice: {
								min:1,
								message: 'Please kindly select package type'
							}
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		);
	}

	return {
		// public functions
		init: function() {
			_initDemo1();
			_initDemo2();
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
