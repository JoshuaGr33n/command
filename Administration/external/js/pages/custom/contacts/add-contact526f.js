"use strict";

// Class definition
var KTContactsAdd = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _avatar;
	var _validations = [];

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		_wizard = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		_wizard.on('beforeNext', function (wizard) {
			// Don't go to the next step yet
			_wizard.stop();

			// Validate form
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
			validator.validate().then(function (status) {
				if (status == 'Valid') {
					_wizard.goNext();
					KTUtil.scrollTop();
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Change Event
		_wizard.on('change', function (wizard) {
			KTUtil.scrollTop();
		});
	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					firstname: {
						validators: {
							notEmpty: {
								message: 'First Name is required'
							}
						}
					},
					lastname: {
						validators: {
							notEmpty: {
								message: 'Last Name is required'
							}
						}
					},
					gender: {
						validators: {
							choice: {
								min: 1,
								message: 'Please select a Gender'
							}
						}
					},

					dob: {
						validators: {
							notEmpty: {
								message: 'Date of Birth is required'
							}
						}
					},

					address: {
						validators: {
							notEmpty: {
								message: 'Address is Required'
							}
						}
					},

					state: {
						validators: {
							notEmpty: {
								message: 'State is required'
							}
						}
					},

					lga: {
						validators: {
							notEmpty: {
								message: 'Local Government Area is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					// Step 2
					
					class: {
						validators: {
							notEmpty: {
								message: 'Please assign a class'
							}
						}
					},

					session: {
						validators: {
							notEmpty: {
								message: 'Please select the current school year'
							}
						}
					},
					term: {
						validators: {
							notEmpty: {
								message: 'Please select the current school term'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					

				/*	phone: {
						validators: {
							notEmpty: {
								message: 'Phone is required'
							},
							phone: {
								country: 'NG',
								message: 'The value is not a valid US phone number. (e.g +234 707 456 7807)'
							}
						}
					},*/
					
					/* email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							}, 
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					}, */
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));
	}

	var initAvatar = function () {
		_avatar = new KTImageInput('kt_contact_add_avatar');
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_contact_add');
			_formEl = KTUtil.getById('kt_contact_add_form');

			initWizard();
			initValidation();
			initAvatar();
		}
	};
}();

jQuery(document).ready(function () {
	KTContactsAdd.init();
});
