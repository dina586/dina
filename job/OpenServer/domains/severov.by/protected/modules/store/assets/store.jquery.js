/*Полет в корзину товара*/
function flyToCart(index) {
	var productX 		= $('.j-item_image img').eq(index).offset().left;
	var productY 		= $('.j-item_image img').eq(index).offset().top;
	
	var basketX 		= $(".j-shopping_cart_preview").offset().left;
	var basketY 		= $(".j-shopping_cart_preview").offset().top;

	var gotoX 			= basketX - productX;
	var gotoY 			= basketY - productY;
	
	$('.j-item_image img').eq(index).clone().css({'position' : 'absolute', 'z-index' : '1000000000', 'left': '0', 'float':'left'})
		.appendTo(".j-item_image:eq("+index+")")
		.animate({opacity: 0.5,   
			marginLeft: gotoX, 
			marginTop: gotoY,
			width: 50,   
			height: 50
			}, 700, 
			function() {  
				$(this).remove();  
	});
}
$.fn.prevOrLast = function(selector){
	var prev = this.prev(selector);
	return (prev.length) ? prev : this.nextAll(selector).last();
}

$(document).on('change', '.a-order_type', function() {
	var totalSum = 0;
	var val = parseFloat($(this).val());
	var more = $('.k-cart_more').val();
	var cartCost = parseFloat($('.d-cart_cost').text()).toFixed(2);
	var totalSum = parseFloat(val) + parseFloat(cartCost);
	
	if(cartCost < more) {
		
	}
	$('.j-order_total').text(totalSum.toFixed(2));
})

function pageStyles(perRow) {
	var current = 0;
	var heights = new Array();
	var size = $('.j-item_height_container').size();
	var rowNumber = Math.floor(size / perRow);
	if(rowNumber == 0)
		rowNumber = 1;
	$('.j-item_height_container').each(function(){
		var index = $('.j-item_height_container').index(this);
		if(index == (size-1)) {
			var memory = perRow;
			if(rowNumber == 1)
				perRow = size;
			else
				perRow = size - rowNumber * perRow;
			if(perRow == 0)
				perRow = memory;
		}
		
		var i = 0;
		$('.j-item_height', this).each(function(){
			if(typeof heights[i] == 'undefined') {
				heights[i] = $(this).height();
			}
			else if(heights[i] < $(this).height())
				heights[i] = $(this).height();
			i++;
		})

		current++;
		
		if(current == perRow) {
			for(var k = index; k > index - perRow; k--) {
				for(var i =0; i <= heights.length; i++)
					$('.j-item_height_container:eq('+k+') .j-item_height').eq(i).css({'height': ''+heights[i]+'px'});
			}
			current = 0;	
			heights = new Array();
		}
	})
}

$(document).on('click', '.a-add_to_cart', function() {
	var index = $('.a-add_to_cart').index(this);
	var url = $(this).attr('href');
	try{
		flyToCart(index);
	}
	catch(e){ }
		
	$.ajax({
		url: url,
		success: function(data){
			var item = $.parseJSON(data);
			$('.d-cart_total').text(item.number);
			$('.d-cart_cost').text(item.total_cost);
			$('.j-shopping_cart_empty').hide();
			$('.j-shopping_cart_full').show();
		}
	});
	return false;
})

//Выбор чекбоксов в каталоге
$(document).on('change', '.j-catalot_tree_checkbox input', function() {
	var level = $(this).attr('class');
	level = parseInt((""+level).replace(/\D+/g,""));
	level = level - 1;
	
	var eq = $('.j-catalot_tree_checkbox input').index(this);
	//Отмечаем родителеские элементы
	if($(this).is(':checked')) {
		for(var i = level; i >=0; i--) {
			$('.j-catalot_tree_checkbox').eq(eq).prevAll('.b-catalog_level_'+i+'').eq(0).find('input').attr('checked', 'checked');
		}
	}
	else {
		
	}	
})



	/*Удаление отдельной позиции из корзины*/
	$(document).on('click', '.d-cart_table .a-cart_delete', function() {
		var index = $('.d-cart_table .a-cart_delete').index(this);
		var url = $('a', this).attr('href');
		$.ajax({
			url: url,
			success: function(data){
				var item = $.parseJSON(data);
				$('.d-cart_total').text(item.number);
				$('.d-cart_cost').text(item.total_cost);
				/*Если в корзине не осталось товаров - прячем её*/
				if(item.number == 0) {
					$('.d-cart_table, .j-shopping_cart_links').hide();
					$('<p>Ваша корзина пуста! Посетите магазин!</p>').appendTo('.j-shopping_cart');
				} else {
					$('.d-cart_table tbody tr:eq('+index+')').hide();
				}
			}
		});
		return false;
	})

	/*Изменение кол-ва заказываемого товара и изменние цены*/
	$(document).on('change', '.d-cart_table .j-cart_number', function() {
		var index = $('.d-cart_table .j-cart_number').index(this);
		index++;
		var number = $(this).val();
		var id = $('.d-cart_table tr:eq('+index+') .k-prod_id').val();
		var oneCost = $('.d-cart_table tr:eq('+index+') .k-one_prod').text();
		oneCost = parseFloat(oneCost.replace(/(\s)+/g, '')).toFixed(2);
		var price = $('.d-cart_table tr:eq('+index+') .k-prod_type').val();
		var sum_price = number * oneCost;
		
		$.ajax({
		  type: "POST",
		  url: "/store/cart/ajaxChange",
		  data: ({id : id, number : number, price : price}),
		  success: function(data){
			var sumNumber = 0;
			$('.d-cart_table .j-cart_number').each(function() {
				sumNumber = sumNumber + parseInt($(this).val());
			})
			$('.d-cart_table tr:eq('+index+') .j-sum_price').text(whiteSpace(sum_price));
			var item = $.parseJSON(data);
			$('.d-cart_total').text(item.number);
			$('.d-cart_cost').text(whiteSpace(item.total_cost));
		  }
		});
	})
	
	
	/*Выезжающее меню каталога*/
	$(document).on('click', '.j-catalog_menu a', function() {
		var index = $('.j-catalog_menu a').index(this);
		$('.j-catalog_menu ul').removeClass('j-active');
		
		$(this).siblings('ul').addClass('j-active');
		$(this).parents("ul").each(function() {
			$(this).addClass('j-active');
		});
		
		$('.j-catalog_menu ul').not('.j-active').slideUp(500);
		$('.j-catalog_menu ul.j-active').slideDown(500);
		var url = $(this).attr('href');
		if($('.c-right').hasClass('d-content')) {
			ajaxRender(url);
			return false;
		}
	})

function whiteSpace(n) {
	return (""+n).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1 ");
}
