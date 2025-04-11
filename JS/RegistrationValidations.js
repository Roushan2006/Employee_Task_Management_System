$.validator.setDefaults({
		submitHandler: function() {
			 entry();
			 show1();
		}
	});
    	

	         
$().ready(function () {

jQuery.validator.addMethod("name_check", function(value, element) {
  return this.optional(element) || /^[a-zA-Z]{2,20}$/.test(value);
}, "Should be alfa character only");

jQuery.validator.addMethod("user_name_check", function(value, element) {
  return this.optional(element) || /^[0-9\w]+$/.test(value);
}, "Username must be alfa numeric");

	jQuery.validator.addMethod("password_check", function(value, element) {
  return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$&]).{8,20})/.test(value);
}, "password should contain alteast 1:Small,Capital,numeric,special chars");



	         $("#registration_form").validate({
            errorClass: 'error',
			rules: {
				fname: {
					required:true,
					name_check:true,
					minlength:2
				},
				lname:{
					required:true,
					name_check:true,
					minlength:2
				},
				username: {
					required: true,
					user_name_check:true,
					minlength: 2
				},
				password: {
					required: true,
					password_check:true,
					minlength: 5
				},
				cpassword: {
					required: true,
          equalTo: "#password",
					minlength: 5
					
				},
				email: {
					required: true,
					email: true
				},
				
				
				
			},
			messages: {
			
         fname: {
          required: "Please enter your first name",
          minlength: "must be atleast 2 characters"
        },
        lname: {
          required: "Please enter your last name",
          minlength: "must be atleast 2 characters"
        },
				username: {
					required: "Please enter an username",
					minlength: "must be atleast 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				cpassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email:{
          required: "Email is required", 
          email: "Enter valid email" 
        },
			
		}
	            
                                                              
	    
});

});	         


/* script*/
 