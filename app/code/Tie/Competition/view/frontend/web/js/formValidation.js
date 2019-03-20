require(["jquery"], function (jQuery) {
//<![CDATA[
    jQuery(document).ready(function() {
        jQuery("#competition-form").submit(function(e){
            // Block the submit action on click of 'Submit' button
            e.preventDefault();

            // Set all variables for this check list
            var isValid = true;
            var isValidInt = 0;
            var firstname   = jQuery.trim(jQuery('#firstname').val());
            var lastname    = jQuery.trim(jQuery('#lastname').val());
            var email       = jQuery.trim(jQuery('#email').val());
            var answer      = jQuery.trim(jQuery('#answer').val());

            // Call validateValues function for check up for each values
            isValidInt = validateValues('firstname', firstname, 1, isValid, isValidInt);
            isValidInt = validateValues('lastname', lastname, 2, isValid, isValidInt);
            isValidInt = validateValues('email', email, 3, isValid, isValidInt);
            isValidInt = validateValues('answer', answer, 4, isValid, isValidInt);
            checkIsValidalid(isValidInt);

            function validateValues($idName, $value, $action, $isValid, $isValidInt)
            {
                // Make the first letter upper for --- '#control...'
                var str = $idName;
                str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });

                // Check if passed value is not empty
                if($value.length === 0){
                    $isValid = false;
                    jQuery('#' + $idName).addClass("mage-error");

                    if(jQuery('#' + $idName + '-error').length === 0){
                        jQuery('#control' + str).append("<div for='" + $idName + "' generated='true' class='mage-error' id='" + $idName + "-error'>This is a required field.</div>");
                    }
                }

                // check first name and last name is alphabetical, space and apostrophe
                var arr = [ 0, 1, 2 ];

                if(jQuery.inArray( $action, arr ) > 0 ){

                    var strValue = $value;
                    strValue = strValue.replace(" ", "");
                    strValue = strValue.replace("-", "");
                    strValue = strValue.replace("'", "");

                    if(strValue.match(/[a-zA-Z -]+$/) === null){
                        $isValid = false;
                        jQuery('#' + $idName).addClass("mage-error");

                        if(jQuery('#' + $idName + '-error').length === 0){
                            jQuery('#control' + str).append("<div for='" + $idName + "' generated='true' class='mage-error' id='" + $idName + "-error'>Enterd information can not be with anything other than alpha characters (eg an apostrophe or a hyphen). Please check and type again.</div>");
                        }
                    }
                }

                // email validation
                if($action === 3)
                {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if(regex.test($value) === false){
                        $isValid = false;
                        jQuery('#' + $idName).addClass("mage-error");

                        if(jQuery('#' + $idName + '-error').length === 0){
                            jQuery('#control' + str).append("<div for='" + $idName + "' generated='true' class='mage-error' id='" + $idName + "-error'>Wrong email format.</div>");
                        }
                    }
                }

                if($isValid === true && jQuery('#' + $idName + '-error').length > 0){
                    jQuery('#' + $idName).removeClass("mage-error");
                    jQuery('#' + $idName + '-error').remove();
                }

                if($isValid === false)
                {
                    $isValidInt++;
                }

                return $isValidInt;
            }

            // Last checking of isValud value after all. If all good then path to action POST form via URL
            function checkIsValidalid($isValidInt) {
                // alert($isValidInt);
                if($isValidInt === 0){
                    var url = jQuery('#competition-form').attr('action');
                    jQuery.ajax({
                        url: url,
                        dataType: 'json',
                        data: jQuery('#competition-form').serialize(),
                        type: 'POST',
                        success: function(data) {

                            if (data.status === 'error'){
                                jQuery('#email').addClass("mage-error");
                                jQuery('#controlEmail').append("<div for='email' generated='true' class='mage-error' id='email-error'>We have held this email within our system.</div>");
                            } else {
                                jQuery("#competition-form").attr("style", "visibility: hidden");
                            }
                        }
                    });
                }
            }
        });
    });
//]]>
});