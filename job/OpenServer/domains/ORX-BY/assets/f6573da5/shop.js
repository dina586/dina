$(document).ready(function() {
	/*Добавление товара в корзину*/
	$('.b-add_to_cart .j-add_to_cart').click(function() {
	
		var index = $('.b-add_to_cart .j-add_to_cart').index(this);
		
		var prod_id = $('.b-add_to_cart:eq('+index+') input[name = "k-prod_id"]').val();
		
		var prod_cost = $('.b-add_to_cart:eq('+index+') input[name = "k-prod_cost"]').val();
		
		$.ajax({
			type: "POST",
			url: "/shop/cart/addToCart",
			data: ({id : prod_id}),
			success: function(data){
				var item = $.parseJSON(data);
				$('#j-items_number').text(item.number);
				$('#j-items_sum').text(item.total_cost);
				$('.j-card_items_preview').show();
				$('.j-add_to_cart_mess').stop(true, true).fadeIn(500).delay(500).fadeOut(500);
			}
		});
		return false;
	})
	/*Изменение кол-ва заказываемого товара и изменние цены*/
	$('.cart_table input[name=prod_number]').change(function() {
		var index = $('.cart_table input[name=prod_number]').index(this);
		index++;
		var number = $(this).val();
		var id = $('.cart_table tr:eq('+index+') input[name=prod_id]').val();
		var oneCost = $('.cart_table tr:eq('+index+') .one_prod').text();
		var sum_price = number * oneCost;
		
		$.ajax({
		  type: "POST",
		  url: "/shop/cart/AjaxChange",
		  data: ({id : id, number : number}),
		  success: function(data){
			var sumNumber = 0;
			$('.cart_table input[name=prod_number]').each(function() {
				sumNumber = sumNumber + parseInt($(this).val());
			})
			$('.cart_table tr:eq('+index+') .sum_price').text(sum_price);
			$('#numberspan').text(sumNumber);
			$('#cost, .cart_table tfoot td:last').text(data);
		  }
		});
	})
	/*Удаление отдельной позиции из корзины*/
	$('.cart_table .a-delete_prod').click(function() {
		var index = $('.cart_table .a-delete_prod').index(this);
		var id = $('.cart_table tbody tr:eq('+index+') input[name=prod_id]').val();
		$.ajax({
			type: "POST",
			url: "/shop/cart/CartProdDelete",
			data: ({id : id}),
			success: function(data){
				/*Если в корзине не осталось товаров - прячем её*/
				if(data == 0) {
					$('.cart_table, .j-cart_link').hide();
					$('<div class = "empty_cart"><p>Ваша корзина пуста! Посетите магазин!</p></div>').appendTo('.b-cart');
				} else {
					$('.cart_table tfoot td:last').text(data);
					$('.cart_table tbody tr:eq('+index+')').hide();
				}
			}
		});
		return false;
	})
	
	/*Выбор чекбоксов в каталоге*/
	$('.j-catalog_tree input').change(function() {
		/*Отмечаем родителеские элементы*/
		if($(this).is(':checked')) {
			$(this).parents("li.checkbox").each(function() {
				$('> input[type="checkbox"]', this).attr('checked', 'checked');
			});
		}
		else {
			/*Удаляем все отмеченные значения у потомков*/
			$(this).parent('li').find('input[type="checkbox"]').removeAttr('checked');
		}	
		
	})
	
	
})