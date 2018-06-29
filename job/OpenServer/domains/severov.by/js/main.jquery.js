$(document).on('click', '.j-cart_tabs a', function() {
	var eq = $('.j-cart_tabs a').index(this);
	$('.j-cart_tabs li').removeClass('active');
	$('.j-cart_tabs li').eq(eq).addClass('active');
	$('.j-order_form').hide();
	$('.j-order_form').eq(eq).show();
	return false;
});

$(function(){
	$('.menu li a').each(function () {
		var location = window.location.href;
		var link = this.href; 
		if(location == link) {
			$(this).addClass('current-menu-parent');
		}
	});
});

function callForm(css_class) {
	var xhrFrom = null;
	$(document).on('click', '.j-show_'+css_class+'_dialog', function() {
		$("#j-get_"+css_class+"_dialog").modal("show");
		return false;
	});
	
	$(document).on('click', '.a-get_'+css_class+'', function() {
		var formAction = $(this).parents('form').attr("action");
		var form = $(this).parents('form');
		form.ajaxForm({
			beforeSubmit:  function() {
				if(xhrFrom!= null){
					return false;
				}
				xhrFrom = 'not allow';
			},
			error: function(data){
				$("#j-message_dialog").modal("show");
				$("#j-message_dialog .modal-body").html(data);
			},
			success: function(data) {
				$("#j-get_"+css_class+"_dialog").modal("hide");
				var json = $.parseJSON(data);
				
				$("#j-message_dialog .modal-body").html(json.message);
				$("#j-message_dialog").modal("show");
			},
			complete: function(responseText, statusText, xhr) {
				form.clearForm();
				xhrFrom = null;
			}
		})
	});
}

/* 
 * Запрет копирования
 */
function cancelCopy() {
	$('.g-content:not(input,select,textarea)').disableSelection();
}


(function($){

  $.fn.ctrlCmd = function(key) {

    var allowDefault = true;

    if (!$.isArray(key)) {
       key = [key];
    }

    return this.keydown(function(e) {
        for (var i = 0, l = key.length; i < l; i++) {
            if(e.keyCode === key[i].toUpperCase().charCodeAt(0) && e.metaKey) {
                allowDefault = false;
            }
        };
        return allowDefault;
    });
};


$.fn.disableSelection = function() {

    this.ctrlCmd(['a', 'c']);

    return this.attr('unselectable', 'on')
               .css({'-moz-user-select':'-moz-none',
                     '-moz-user-select':'none',
                     '-o-user-select':'none',
                     '-khtml-user-select':'none',
                     '-webkit-user-select':'none',
                     '-ms-user-select':'none',
                     'user-select':'none'})
               .bind('selectstart', false);
};

})(jQuery);
