var xhr = null;

//Клонирование строки таблицы
$(document).on('click', '.j-clone', function(){
	var tr = $(this).parents('tr').clone();
	var name = 	tr.find('input').eq(0).attr('id').replace(/_(\d+)_(\d+)/g,"");
	var highest = 0;
	$(this).parents('table').find('tr').each(function() {
		if(highest < parseInt($(this).attr('data-type')))
			highest = parseInt($(this).attr('data-type'));
	});
	highest++;
	
	tr.find('input').each(function(i) {
		i++;
		$(this).attr('name', ''+name+'['+highest+']['+i+']').attr('id', ''+name+'_'+highest+'_'+i+'');
	})
	
	tr.attr('data-type', highest);
	$(tr).insertAfter($(this).parents('tr'));
	return false;
})

//Удаление строки таблицы
$(document).on('click', '.j-remove', function(){
	if($(this).parents('table').find('tbody tr.j-btn_row').length < 2)
		return false;
	var isEmpty = true;
	var link = $(this);
	
	$(this).parents('tr').find('td input, td select').each(function() {
		if(parseInt($(this).val()) == 0 || $(this).val() == '') 
			{}
		else 
			isEmpty = false;
	})
	
	if(isEmpty) {
		$(this).parents('tr').remove();
	} else {
		$.confirm({
			text: "Please, confirm that you want to perform this action",
			confirm: function(button) {
				link.parents('tr').remove();
			},
			confirmButton: "Confirm",
			cancelButton: "Cancel",
		});
	}
	
	return false;
})

$(document).on('change', '.k-unit_input, .j-invoice_table tfoot input', function() {
	calculateInvoice();
})

//Подсчет общей суммы в таблице invoice
function calculateInvoice() {
	
	//Подсчет суммы
	$('.j-invoice_table').find('.invoice_price_row .k-unit_input').each(function() {
		
		var qty = parseInt($(this).parents('tr').find('td:eq(1) .k-unit_input').val());
		var price = parseFloat($(this).val());
		var total = qty * price;
		$(this).parents('tr').find('.j-invoice_total_row_input').val(total);
		$(this).parents('tr').find('.j-invoice_total_row').text(formatPrice(total.toFixed(2)));
	})
	
	//Стилизация
	$('.j-invoice_table').find('.invoice_price_row .k-unit_input').each(function() {
			
		var val = parseFloat($(this).val());
		if($(this).hasClass('j-number_float')) {
			val = val.toFixed(2); 
		}
		else
			val = Math.round(val);
		if(val <0 || isNaN(val))
			val = 0;
			
		$(this).val(val);
	});
	
	/*
	$('.j-invoice_table').find('.j-invoice_total_row').text(formatPrice(total.toFixed(2)));
	$('.j-invoice_table').find('.j-invoice_total_row_input').val(total);
	*/
	var totalSum = 0;
	
	$('.j-invoice_table').find('.j-invoice_total_row_input').each(function() {
		totalSum += parseFloat($(this).val());
	})
	
	
	//Set Subtotal
	$('.j-invoice_subtotal').text(formatPrice(totalSum.toFixed(2)));
	
	//Set tax
	var tax = parseFloat($('.j-invoice_tax_percent').text());
	var taxTotal = tax * 0.01 * totalSum;
	$('.j-invoice_table').find('.j-invoice_tax').text(formatPrice(taxTotal.toFixed(2)));
	$('.j-invoice_table').find('.j-invoice_tax_input').val(taxTotal.toFixed(2));
	
	//Discount
	var discount = parseFloat($('.j-invoice_discount').val());
	if(isNaN(discount))
		discount = 0;
	$('.j-invoice_discount').val(discount.toFixed(2));
	
	//Deposit
	var deposit = parseFloat($('.j-invoice_deposit').val());//Deposit
	if(isNaN(deposit))
		deposit = 0;
	$('.j-invoice_deposit').val(deposit.toFixed(2));
	
	//Shipping
	var shipping = parseFloat($('.j-invoice_shipping').val());
	if(isNaN(shipping))
		shipping = 0;
	$('.j-invoice_shipping').val(shipping.toFixed(2));
	
	//Set Total Due
	var totalDue = totalSum + taxTotal + shipping - discount;
	if(totalDue <0)
		totalDue = 0;
	
	$('.j-invoice_table').find('.j-invoice_total').text(formatPrice(totalDue.toFixed(2)));
	$('.j-invoice_table').find('.j-invoice_total_input').val(totalDue.toFixed(2));//Set Total Due
	
	//Set Payment
	var payment = totalDue - deposit;
	if(payment<0)
		payment = 0;
	$('.j-invoice_payment').text(formatPrice(payment.toFixed(2)));

}

//Получаем адрес для инвойса
$(document).on('change', '.a-get_invoice_address select', function() {
	var val = $(this).val();
	$.ajax({
		data: {'location':val},
		type: 'POST',
		url: '/locations/locations/getInvoiceAddress',
		success: function(data) {
			var json = $.parseJSON(data);
			for (var key in json) {
				$('#Orders_'+key+'').val(json[key]);
			}
		}
	});
})

function formatPrice(price) {
	return price.replace(/(\d+)(\.\d+)?/g, function (c, b, a) {
		return b.replace(/(\d)(?=(\d{3})+$)/g, "$1 ") + (a ? a : "")
	})
}

//Получаем пользователя инвойса
$(document).ready(function() {
	
	$(document).on('keypress, change', '.a-get_user', throttle(function () {
		var val = $(this).val();
		if(xhr!=null){
			xhr.abort();           
		}
		xhr =$.ajax({
			data: {'user':val},
			type: 'POST',
			url: '/invoice/view/getUserData',
			success: function(data) {
				var json = $.parseJSON(data);
				if(json.status == 'ok'){
					var requestData = json.data;
					for (var key in requestData) {
						$('#Invoice_'+key+'').val(requestData[key]);
					}
					$('.d-user_error').text('');
				}
				else{
					$('.d-user_error').text('This customer does not exists. You can add new customer by clicking "Add new customer" button');
				}
			}
		});
	}))
})

//Показ скрытого поля инвойса 
$(document).on('change', '.j-invoice_type', function() {
	var val = $(this).val();
	if(val == 0) 
		$('.j-invoice_name').show();
	 else 
		$('.j-invoice_name').hide();
	
	if(val == 2)
		$('.j-invoice_tax_percent').text('0');
	else {
		$('.j-invoice_tax_percent').text($('.j-invoice_tax_percent').attr('data-default'));
	}
	calculateInvoice();
})

//Автокомлиты в инвойсе
$(document).on('change, keypress', '.j-invoice_table tr td:first-child input', function() {
	
	var input = $(this);
	var invoiceType = $('.j-invoice_type').val();
	
	if(invoiceType != 0){
		var url = '/invoice/view/autocomplete/?type='+invoiceType;
		$(this).autocomplete({
			'delay':300,
			'minLength':1,
			'showAnim':'fold',
			'source':url,
			'select':function(event, ui) {
				event.preventDefault(); 
				input.val(ui.item.name);
				var price = parseFloat(ui.item.price);
				input.parents('tr').find('td:eq(1) input').val('1');
				input.parents('tr').find('td:eq(2) input').val(formatPrice(price.toFixed(2)));
				
				calculateInvoice();
			}	
		});
	}
})