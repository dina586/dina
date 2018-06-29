$(document).ready(function(){
	$("#g-form").validate();
});






jQuery(document).ready(function(){
	
		
	$('#la-response_form').hide();
        $('#g-form').ajaxForm({    beforeSubmit: validate,
                                    success: showResponse 
                });
				
})

function showResponse(){
    
    $('#a-request_form').hide();
    $('#a-response_form').show();
}

function validate(formData, jqForm, options){
	
    var validEmail = false;
	var validPhone = false;
	var validCity = false;
	var validCityTo = false;
	var validCityFrom = false;
	
    if (validateEmail(formData[1].value)==false){
            $(jqForm).find("[name = email]").addClass('edit_f_error');
            validEmail = false;
    }
    else 	{
		$(jqForm).find("[name = email]").removeClass('edit_f_error');
		 validEmail = true;
	}
	
    if (validatePhone(formData[2].value)==false){
            $(jqForm).find("[name = phone]").addClass('edit_f_error');
            validPhone = false;
    }
	else {
		$(jqForm).find("[name = phone]").removeClass('edit_f_error');
            validPhone = true;
	}
    
	var cityFrom = formData[3].value;
	var cityTo = formData[4].value;
	
	if (cityFrom == 0){
		$(jqForm).find("[name = city-from]").addClass('edit_f_error');
        validCityFrom = false;
    }
	else {
		$(jqForm).find("[name = city-from]").removeClass('edit_f_error');
        validCityFrom = true;
	}
		
	if (cityTo == 0){
		$(jqForm).find("[name = city-to]").addClass('edit_f_error');
        validCityTo = false;
    }
	else {
		$(jqForm).find("[name = city-to]").removeClass('edit_f_error');
        validCityTo = true;
	}
	
	if (cityFrom != 0 && cityTo != 0){
		if (cityTo !== cityFrom){
			$(jqForm).find("[name = city-to]").removeClass('edit_f_error');
			$(jqForm).find("[name = city-from]").removeClass('edit_f_error');
			validCity = true;
			
		}
		else {
			$(jqForm).find("[name = city-to]").addClass('edit_f_error');
			$(jqForm).find("[name = city-from]").addClass('edit_f_error');
			validCity = false;
		}
	}
	
	return validEmail && validPhone && validCity && validCityTo && validCityFrom;
}

function validateEmail(address) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(address) == false) {
          return false;
   }
   return true;
}



function validatePhone(phone) {
        var reg = /^\+?[+\-()\s\d]+$/;
        return reg.test(phone);
}