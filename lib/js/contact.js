$(document).ready(function () {
    //button register click
    $("#btn-contact").click(function () {
    	 	
        if(contact.validateContactForm () === true) {
            //validation passed

            var contactName     = $("#name").val(),
            	contactEmail     = $("#email").val(),
            	contactPhone     = $("#phone").val(),
            	contactMessage = $("#message").val(),
                regBotSsum  = $("#reg-bot-sum").val();

            //create data that will be sent to server
            var data = { 
                contactData: {
                	contactName           : contactName,
                	contactEmail        : contactEmail,
                	contactPhone        : contactPhone,
                	contactMessage: contactMessage,
                    bot_sum         : regBotSsum
                },
                fieldId: {
                	contactName           : "name",
                	contactEmail        : "email",
                	contactPhone        : "phone",
                	contactMessage: "message",
                    bot_sum         : "reg-bot-sum"
                }
            };
            
            //send data to server
            contact.sendContact(data);
        }                        
    });
});



/** CONTACT NAMESPACE
 ======================================== */

var contact = {};


/**
 * Generate new contact mesagge.
 * @param {Object} data Register form data.
 */
contact.sendContact = function (data) {
    //get contact button
    var btn = $("#btn-contact");
    
    //put button to loading state
    asengine.loadingButton(btn, $_lang.creating_account);
    
 
    //send data to server
    $.ajax({
        url: "config/ajax.php",
        type: "POST",
        data: {
            action  : "contactMe",
            contact    : data
        },
        success: function (result) {
            //return button to normal state
            asengine.removeLoadingButton(btn);

            console.log(result);
            
            //parse result to JSON
            var res = JSON.parse(result);
            
            if(res.status === "error") {
                //error
                
                //display all errors
                for(var i=0; i<res.errors.length; i++) {
                    var error = res.errors[i];
                    asengine.displayErrorMessage($("#"+error.id), error.msg);
                }
            }
            else {
                //display success message
                asengine.displaySuccessMessage($("#contact-form fieldset"), res.msg);
            }
        }
    });
};


/**
 * Validate contact form.
 * @returns {Boolean} TRUE if form is valid, FALSE otherwise.
 */
contact.validateContactForm = function () {
    var valid = true;
    
    //remove previous error messages
    asengine.removeErrorMessages();
   
    
    //check if all fields are filled
    $("#contact-form").find("input").each(function () {
        var el = $(this);
       
        if($.trim(el.val()) === "") {
            asengine.displayErrorMessage(el);
            valid = false;
        }
    });
   
    //get email, 
    var contactEmail     = $("#email");
    
    //check if email is valid
    if(!asengine.validateEmail(contactEmail.val()) && contactEmail.val() != "") {
        valid = false;
        asengine.displayErrorMessage(contactEmail,$_lang.email_wrong_format);
    }


    return valid;
};