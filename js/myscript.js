window.winWidth = $(window).width();
window.winWidthOut = $(window).width();
window.docHeight = $(document).outerHeight();
window.winHeight = $(window).height();

function log(message){
	console.log(message);
}

//log($('.option').css('z-index'));

var top_scroll = 0;
$('#page_up').click(function(event) {
	$('body,html').animate({scrollTop: ($('.head').offset().top - top_scroll)}, 600);
});

/*
var c_block_h = parseInt($('.categories_block').css('height'));
var footer_top = $('.footer').offset().top;
*/

$(window).resize(function(){
  	winHeight = $(window).height();
	docHeight = $(document).outerHeight();
	//log($('.option').css('z-index'));

	/*c_block_h = parseInt($('.categories_block').css('height'));
	footer_top = $('.footer').offset().top;
	log(c_block_h);
	log(footer_top);*/
});

$(document).ready(function() {
	$(window).trigger('scroll');

	var menu_name = $('#menu_view').attr('data-menu');

	$('.menu > ul > li').each(function(){
		if($(this).find('a').text() == menu_name && !$(this).hasClass('current-menu-item')){
			$(this).addClass('current-menu-item');
		}
	});

	$('.commands_view > img, .client_item_image > img, .blog_item .preview > img, .lawyers_view.blog_view.post img').removeAttr('sizes width height');
	$('.commands_picture img').removeAttr('sizes width height').prependTo($('.commands_picture'));

	var last_citem = $('.commands.page .commands_block .commands_item:last');
	last_citem.find('img').unwrap();
	last_citem.find('.title').text(last_citem.find('.title > span').text());
	last_citem.find('.title > span').detach();

	$('.review_block iframe').each(function(){
		$(this).parents('.review_block').find('.author').addClass('notop');
	});

	if($('.category .blog .blog_item').length <= 4){
		var bl = $('.category .blog .blog_item').length;
		var clone_item = $('.category .blog .blog_items > .blog_col_left .blog_item:first').clone();
		clone_item.css('visibility','hidden');

		for(var p = bl; p < 4; p++){
			$('.category .blog .blog_items > .blog_col_left').append(clone_item);

			clone_item = $('.category .blog .blog_items > .blog_col_left .blog_item:first').clone();
			clone_item.css('visibility','hidden');
		}
	}

	if($('.practika.page .practika_item').length <= 8){
		var pl = $('.practika.page .practika_item').length;
		var clone_item = $('.practika.page .practika_item:first').clone();
		clone_item.css('visibility','hidden');

		log(pl);

		for(var p = pl; p < 8; p++){
			$('.practika.page .practika_items').append(clone_item);

			clone_item = $('.practika.page .practika_item:first').clone();
			clone_item.css('visibility','hidden');
		}
	}
});

if(winWidth > 1024){
	var start_img = $('.start_image > .image');
	var clip_img  = $('.start_image > .clip');
	var positionTop, positionEl;
	var leftPos = winHeight / 60;

	var widthWin = 0;

	if($('.categories').is('div')){
		var categories_top = $('.categories').offset().top - 30;
	}

	var cblock_top = 30;

	var fade_block = [];
	$('.fade').each(function(){
		fade_block.push($(this).offset().top);
		$(this).attr('data-top',$(this).offset().top);
	});

	$(window).bind('scroll', function(){
		positionTop = $(window).scrollTop();
		leftPos = winHeight / 60;
		
		if(positionTop > 0){
			positionEl = parseInt(40 + (winHeight + positionTop) / leftPos - 60);
			//log(positionEl);
			clip_img.css({'width' : positionEl+'%'});
			start_img.css({'padding-left' : positionEl+'%'}); //,'background-position' : '0% '+(positionEl * 9)+'%'
		}
		//log(positionTop);
		//log($(window).scrollTop() + winHeight);

		/*if(positionTop >= categories_top){
			$('#scrolls, .categories_block').addClass('fixed');

			if((positionTop + winHeight) >= footer_top){
				cblock_top_new = (footer_top - (positionTop + winHeight)) + cblock_top;

				new_cblock_h = c_block_h - ((positionTop + winHeight) - footer_top);

				$('.categories_block').css('height', new_cblock_h + 'px');
				//$('#scrolls, .categories_block').css('top',cblock_top_new+'px');
			} else {
				$('#scrolls, .categories_block').removeAttr('style'); //.css('top', cblock_top+'px')
			}
		} else {
			$('#scrolls, .categories_block').removeClass('fixed');
		}*/

		if(fade_block){
			var st;
			if(winWidth > 1440){
				st = positionTop + winHeight - 140;
			} else if(winWidth > 1024 && winWidth < 1440){
				st = positionTop + winHeight - 100;
			} else {
				st = positionTop + winHeight + 40;
			}
			
			for(var i = 0; i < fade_block.length; i++){
				if(st > fade_block[i]){
					$('.fade').eq(i).addClass('_in');
				} else {
					$('.fade').eq(i).removeClass('_in');
				}
			}
		}
	});

	$('.categories_block ul > li').each(function(){
		if($(this).hasClass('active')){
			$(this).parent().prev().addClass('open');
			$(this).parent().css('display','block');
		}
	});
} else {
	$('.categories_block_title').click(function() {
		if(!$(this).parent().hasClass('open')){
			$(this).parent().addClass('open');
			$(this).next().slideDown(300);
		} else {
			$(this).next().slideUp(300);
			$(this).parent().removeClass('open');
		}
	});
}

if(winWidth <= 640){
	$('.head_contacts > a').empty();
} else {
	$('.commands_picture_names > a[href]').each(function(){
		$(this).wrapInner('<span></span>');
	});
}

$('.client_item').each(function(){
	var client_item = $(this);
	var client_img = client_item.find('img').clone();

	if(client_img){
		client_item.find('img').parent().detach();
		client_img.appendTo(client_item.children('.client_item_image'));
	}
});

var review_block_num = 0;
$('.review_blocks > .review_block').each(function(){
	var _r_this = $(this);

	if(_r_this.find('iframe').parent().is('p')){
		_r_this.addClass('video');
		//_r_this.find('iframe').parent().append('<div class="play" onclick="played(this)"></div>');
	}

	if(_r_this.hasClass('left')){
		_r_this.appendTo($('.review_col_left'));
	}

	if(_r_this.hasClass('right')){
		_r_this.appendTo($('.review_col_right'));
	}

	if(_r_this.hasClass('center')){
		_r_this.appendTo($('.review_col_center'));
	}

	if(review_block_num > 6){
		_r_this.addClass('none');
	}

	review_block_num++;
});

function played(data){
	log(data);
}

$('.mb_block').click(function(){
	var head_menu = $(this).parent();
	if(!head_menu.hasClass('open')){
		$('body').addClass('hiddens');
		head_menu.addClass('open');
		//head_menu.find('.menu').slideDown(300);
		head_menu.find('.menu').css({'display': 'block','opacity': 1, 'z-index': 2}).animate({'height': '100vh'}, 300);
	} else {
		$('body').removeClass('hiddens');
		//head_menu.find('.menu').slideUp(300);
		head_menu.find('.menu').animate({'height': '0px'}, 300, function(){
			$(this).css({'display': 'none', 'opacity': 0, 'z-index': -1});
		});
		setTimeout(function(){
			head_menu.removeClass('open');
		}, 150);
	}
});

$('.categories_switch').click(function(){
	var _this = $(this);
	
	if(!_this.hasClass('open')){
		_this.addClass('open');
		_this.next().slideDown(300);
	} else {
		_this.removeClass('open');
		_this.next().slideUp(300);
	}
});

$('.btn, .modal_link').click(function(e){
	var _this = $(this);
	var btn_type = _this.data('type');
	var modal_title = _this.data('modal-title');
	var data_target = _this.data('target');
	
	if(btn_type == 'modal'){
		e = e || event;
		e.preventDefault();

		var modal_id = _this.data('modal-id');
		$('.modal[data-modal-id="'+modal_id+'"]').find('.form').attr('data-target', data_target);
		$('.modal[data-modal-id="'+modal_id+'"]').find('.form_title').text(modal_title);
		$('.modal[data-modal-id="'+modal_id+'"]').find('input[name="form_name"]').val(modal_title);
		if(!$('.modal[data-modal-id="'+modal_id+'"]').hasClass('open')){
			$('body').addClass('hiddens');
			$('.modal_block').fadeIn(300);
			$('.modal_bg').addClass('in').fadeIn(300);
			$('.modal[data-modal-id="'+modal_id+'"]').fadeIn(300).addClass('open');
		} else {
			$('.modal[data-modal-id="'+modal_id+'"]').fadeOut(300).removeClass('open');
			$('.modal_block').fadeOut(300);
			$('.modal_bg').removeClass('in').fadeOut(300);
			$('body').removeClass('hiddens');
		}
	}
});

$('.modal_close').click(function(){
	var modal_id = $(this).parent().data('modal-id');
	var modals_opened = false;

	if($('.modal[data-modal-id="'+modal_id+'"]').hasClass('open')){
		$('.modal[data-modal-id="'+modal_id+'"]').fadeOut(300).removeClass('open');
		if(modal_id == 3){
			if($('.modal[data-modal-id="1"]').hasClass('open') || $('.modal[data-modal-id="2"]').hasClass('open')){
				modals_opened = true;
			}

			if(!modals_opened){
				$('.modal_block').fadeOut(300);
				$('.modal_bg').removeClass('in').fadeOut(300);
				$('body').removeClass('hiddens');
			}
		} else {
			$('.modal_block').fadeOut(300);
			$('.modal_bg').removeClass('in').fadeOut(300);
			$('body').removeClass('hiddens');
		}
	}
});

$(document).mouseup(function (e) {
	if($('.modal_bg.in').is('div')){
		var container = $('.modal');
	  if (container.has(e.target).length === 0){
	  		container.fadeOut(300).removeClass('open');
	  		$('.modal_block').fadeOut(300);
			$('.modal_bg').removeClass('in').fadeOut(300);
			$('body').removeClass('hiddens');
	  }
	}
});

var cpi_a;

$('.practika.home .practika_item a').hover(
	function(){
		$(this).parents('.practika_item').addClass('hover');
	},
	function(){
		$(this).parents('.practika_item').removeClass('hover');
	}
);

var circles_fade_block = [];
var circles_fade_top = 100;
var circles_fade_top_mn = 150;
var cf_top = 0;

$('.circles_block').each(function(){
	var cr_top = $(this).offset().top;
	$(this).attr({'data-top': parseInt(cr_top)});
});

var cr1_data_top = $('.circles_block.c1');
var cr2_data_top = $('.circles_block.c2');
var cr3_data_top = $('.circles_block.c3');
var cr4_data_top = $('.circles_block.c4');
var cr5_data_top = $('.circles_block.c5');
var cr6_data_top = $('.circles_block.c6');
var cr7_data_top = $('.circles_block.c7');

$(window).bind('scroll', function(){
	var cr_win_height = $(window).height();
	var cr_pos_top = parseInt($(window).scrollTop());

	if(location.pathname == '/contacts'){
		if((cr_pos_top + 130) >= parseInt(cr6_data_top.attr('data-top'))){
			if((cr_pos_top + 130) > (parseInt(cr6_data_top.attr('data-top')) + parseInt(cr6_data_top.attr('data-step')))){
				cr6_data_top.find('.c_4').addClass('_in');
			} else {
				cr6_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + 130) >= (parseInt(cr6_data_top.attr('data-top')) + parseInt(cr6_data_top.attr('data-step')) * 1.5)){
				cr6_data_top.find('.c_5').addClass('_in');
			} else {
				cr6_data_top.find('.c_5').removeClass('_in');
			}

			if((cr_pos_top + 130) >= (parseInt(cr6_data_top.attr('data-top')) + parseInt(cr6_data_top.attr('data-step')) * 2)){
				cr6_data_top.find('.c_6').addClass('_in');
			} else {
				cr6_data_top.find('.c_6').removeClass('_in');
			}
		}

		if((cr_pos_top + 200) >= parseInt(cr5_data_top.attr('data-top'))){
			if((cr_pos_top + 200) > (parseInt(cr5_data_top.attr('data-top')) + parseInt(cr5_data_top.attr('data-step')))){
				cr5_data_top.find('.c_4').addClass('_in');
			} else {
				cr5_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + 200) >= (parseInt(cr5_data_top.attr('data-top')) + parseInt(cr5_data_top.attr('data-step')) * 1.7)){
				cr5_data_top.find('.c_5').addClass('_in');
			} else {
				cr5_data_top.find('.c_5').removeClass('_in');
			}

			if((cr_pos_top + 200) >= (parseInt(cr5_data_top.attr('data-top')) + parseInt(cr5_data_top.attr('data-step')) * 2.2)){
				cr5_data_top.find('.c_6').addClass('_in');
			} else {
				cr5_data_top.find('.c_6').removeClass('_in');
			}
		}

		if((cr_pos_top + cr_win_height) >= parseInt(cr7_data_top.attr('data-top'))){
			if((cr_pos_top + cr_win_height - 100) > (parseInt(cr7_data_top.attr('data-top')) + parseInt(cr7_data_top.attr('data-step')))){
				cr7_data_top.find('.c_4').addClass('_in');
			} else {
				cr7_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + cr_win_height - 100) >= (parseInt(cr7_data_top.attr('data-top')) + parseInt(cr7_data_top.attr('data-step')) * 1.7)){
				cr7_data_top.find('.c_5').addClass('_in');
			} else {
				cr7_data_top.find('.c_5').removeClass('_in');
			}

			/*if((cr_pos_top + cr_win_height - 100) >= (parseInt(cr7_data_top.attr('data-top')) + parseInt(cr7_data_top.attr('data-step')) * 2.2)){
				cr7_data_top.find('.c_6').addClass('_in');
			} else {
				cr7_data_top.find('.c_6').removeClass('_in');
			}*/
		}
	}

	if(location.pathname == '/'){
		if((cr_pos_top + 100) >= parseInt(cr1_data_top.attr('data-top'))){
			if((cr_pos_top + 100) > (parseInt(cr1_data_top.attr('data-top')) + parseInt(cr1_data_top.attr('data-step')))){
				cr1_data_top.find('.c_4').addClass('_in');
			} else {
				cr1_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + 100) >= (parseInt(cr1_data_top.attr('data-top')) + parseInt(cr1_data_top.attr('data-step')) * 1.8)){
				cr1_data_top.find('.c_5').addClass('_in');
			} else {
				cr1_data_top.find('.c_5').removeClass('_in');
			}

			if((cr_pos_top + 100) >= (parseInt(cr1_data_top.attr('data-top')) + parseInt(cr1_data_top.attr('data-step')) * 2.8)){
				cr1_data_top.find('.c_6').addClass('_in');
			} else {
				cr1_data_top.find('.c_6').removeClass('_in');
			}
		}

		if((cr_pos_top + 140) >= parseInt(cr2_data_top.attr('data-top'))){
			if((cr_pos_top + 140) > (parseInt(cr2_data_top.attr('data-top')) + parseInt(cr2_data_top.attr('data-step')))){
				cr2_data_top.find('.c_4').addClass('_in');
			} else {
				cr2_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + 140) >= (parseInt(cr2_data_top.attr('data-top')) + parseInt(cr2_data_top.attr('data-step')) * 1.8)){
				cr2_data_top.find('.c_5').addClass('_in');
			} else {
				cr2_data_top.find('.c_5').removeClass('_in');
			}

			if((cr_pos_top + 140) >= (parseInt(cr2_data_top.attr('data-top')) + parseInt(cr2_data_top.attr('data-step')) * 2.8)){
				cr2_data_top.find('.c_6').addClass('_in');
			} else {
				cr2_data_top.find('.c_6').removeClass('_in');
			}
		}
	}

	if(location.pathname == '/command'){
		if((cr_pos_top + 200) >= parseInt(cr3_data_top.attr('data-top'))){
			if((cr_pos_top + 200) > (parseInt(cr3_data_top.attr('data-top')) + parseInt(cr3_data_top.attr('data-step')))){
				cr3_data_top.find('.c_4').addClass('_in');
			} else {
				cr3_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + 200) >= (parseInt(cr3_data_top.attr('data-top')) + parseInt(cr3_data_top.attr('data-step')) * 1.7)){
				cr3_data_top.find('.c_5').addClass('_in');
			} else {
				cr3_data_top.find('.c_5').removeClass('_in');
			}

			if((cr_pos_top + 200) >= (parseInt(cr3_data_top.attr('data-top')) + parseInt(cr3_data_top.attr('data-step')) * 2.2)){
				cr3_data_top.find('.c_6').addClass('_in');
			} else {
				cr3_data_top.find('.c_6').removeClass('_in');
			}
		}

		if((cr_pos_top + 80) >= parseInt(cr4_data_top.attr('data-top'))){
			if((cr_pos_top + 80) > (parseInt(cr4_data_top.attr('data-top')) + parseInt(cr4_data_top.attr('data-step')))){
				cr4_data_top.find('.c_4').addClass('_in');
			} else {
				cr4_data_top.find('.c_4').removeClass('_in');
			}

			if((cr_pos_top + 80) >= (parseInt(cr4_data_top.attr('data-top')) + parseInt(cr4_data_top.attr('data-step')) * 1.7)){
				cr4_data_top.find('.c_5').addClass('_in');
			} else {
				cr4_data_top.find('.c_5').removeClass('_in');
			}

			if((cr_pos_top + 80) >= (parseInt(cr4_data_top.attr('data-top')) + parseInt(cr4_data_top.attr('data-step')) * 2.2)){
				cr4_data_top.find('.c_6').addClass('_in');
			} else {
				cr4_data_top.find('.c_6').removeClass('_in');
			}
		}
	}

	/*if(circles_fade_block){
		positionCirclesTop = $(window).scrollTop();

		var sCT;
		
		if(winWidth > 1440){
			sCT = positionCirclesTop + winHeight - 140;
		} else if(winWidth > 1024 && winWidth < 1440){
			sCT = positionTop + winHeight - 100;
		} else {
			sCT = positionTop + winHeight + 40;
		}
			
		for(var i = 0; i < circles_fade_block.length; i++){
			if(sCT > circles_fade_block[i]){
				$('.circles_fade').eq(i).addClass('_in');
			} else {
				$('.circles_fade').eq(i).removeClass('_in');
			}
		}
	}*/
});

$('.curses_more').click(function(){
	$(this).fadeOut(200);
	$('.curses_item.none').fadeIn(300);
});

var item_publication = 1;
$('.publication_items > p').each(function(){
	if(item_publication > 4){
		$(this).addClass('none');
	}

	item_publication++;
});

if(item_publication > 4){
	$('.publication_more').css('display','inline-block');
}

$('.publication_more').click(function(){
	$(this).fadeOut(200);
	$('.publication_items > p.none').fadeIn(300);
});

/* FORMS */

var count_politics = 1;
$('input#politics').each(function(){
	$(this).attr('id','politics'+count_politics);
	$(this).next().attr('for','politics'+count_politics);

	count_politics++;
});

$('#file_btn > div > p').click(function(){
	$(this).parents('.form_col').find('input[type="file"]').trigger('click');
});

$('#file_btn_service > div > p').click(function(){
	$('#file_service').trigger('click');
});

var key_file_num = 0;
$('#file').change(function(e){
	var this_files = this.files;
	var this_file = $(this);
	var this_form = this_file.parents('.form');

	file_error = false;

	log(e.currentTarget.files);

	var files_form = new FormData();
	$.each( e.currentTarget.files, function( key, value ){
		if(value.size > 10100000){
        	this_form.find('.file_upload_block__caption').append('<p class="error">Файл: '+value.name+' слишком большой!</p>');
        	file_error = true;
        }

        files_form.append( key, value );
	});

	//console.log(files_service.getAll('files'));

	if(file_error){
		return false;
	} else {
		var data_form = {
			'action': 'addformfiles',
			'files': files_form,
		};

		$.ajax({
			url: ajaxurl + '?user_file_upload=true', // обработчик funcfile
			data: files_form,
			type: 'post',
			dataType: 'json',
			processData: false, 
			contentType: false,
			beforeSend: function(){
				this_form.find('.form_col.xs > div > p').fadeOut(300);
				this_form.find('.cssload-spin-box').removeClass('none');
			},
			success:function(json){
				log(json);
				$.each(json.files, function(key, value){
					this_form.find('.file_upload_block__caption > .small').detach();
					this_form.find('.file_upload_block__file_name').append('<p id="file'+key_file_num+'" class="small" data-url-file="'+value.url+'">'+value.name+'<span class="close_file" onclick="remove_file('+key_file_num+', \''+value.url+'\');"></span></p>');

					this_form.append('<input type="hidden" name="files" value="'+value.url+'">');
					key_file_num++;
				});
			},
			complete: function(){
				this_form.find('.file_upload_block__file_name').removeClass('none')
				this_form.find('.cssload-spin-box').addClass('none');
			}
		});
	}
});

$('#file_service').change(function(e){
	var this_files = this.files;
	var this_file = $(this);
	var this_form = this_file.parents('.form');

	file_error = false;

	log(e.currentTarget.files);

	var files_service = new FormData();
	$.each( e.currentTarget.files, function( key, value ){
		if(value.size > 10100000){
        	this_form.find('.file_upload_block__caption').append('<p class="error">Файл: '+value.name+' слишком большой!</p>');
        	file_error = true;
        }

        files_service.append( key, value );
	});

	//console.log(files_service.getAll('files'));

	if(file_error){
		return false;
	} else {
		var data_form = {
			'action': 'addformfiles',
			'files': files_service,
		};

		$.ajax({
			url: ajaxurl + '?user_file_upload=true', // обработчик funcfile
			data: files_service,
			type: 'post',
			dataType: 'json',
			processData: false, 
			contentType: false,
			beforeSend: function(){
				this_form.find('.form_col.xs > div > p').fadeOut(300);
				this_form.find('.cssload-spin-box').removeClass('none');
			},
			success:function(json){
				log(json);
				$.each(json.files, function(key, value){
					this_form.find('.file_upload_block__caption > .small').detach();
					this_form.find('.file_upload_block__file_name').append('<p id="file'+key_file_num+'" class="small" data-url-file="'+value.url+'">'+value.name+'<span class="close_file" onclick="remove_file('+key_file_num+', \''+value.url+'\');"></span></p>');

					this_form.append('<input type="hidden" data-file="'+key_file_num+'" name="files" value="'+value.url+'">');
					key_file_num++;
				});
			},
			complete: function(){
				this_form.find('.file_upload_block__file_name').removeClass('none')
				this_form.find('.cssload-spin-box').addClass('none');
			}
		});
	}
});

function remove_file(id, url){
	log(id);
	log(url);

	var data_form = {
		'action': 'remove_file',
		'path': url,
	};

	$('input[data-file="'+id+'"]').detach()
	$('p#file'+id).detach();

	/*$.ajax({
		url: ajaxurl, // обработчик funcfile
		data: data_form,
		type: 'post',
		dataType: 'json',
		success: function(json){
			log(json);
		}
	});*/
}

$('.form').submit(function(e){
	e = e || event;
	e.preventDefault();

	var _this = $(this);
	var error_form = false;
	if(_this.attr('name') == 'review'){
		var _this_target = _this.attr('data-target');
	} else {
		var _this_target = 'zapis_konsultaciya';
	}

	_this.find('label.error .error_message').detach();
	_this.find('label.error').removeClass('error');

	_this.find('input.required, textarea.required').each(function(){
		_this_val = $(this).val();
		//log(_this_val);
		$.trim(_this_val);
		if(_this_val == ''){
			error_form = true;

			$(this).parent().addClass('error');
			//$(this).after('<p class="error_message">пожалуйста, заполните поле</p>');
		}
	});

	//log(error_form);
	if(!error_form){
		var set_data = _this.serializeArray();
		var action_func;

		if(_this.attr('name') == 'standart'){
			action_func = 'add_form_st';
		} else if(_this.attr('name') == 'review'){
			action_func= 'add_form_review';
		}

		var data_form = {
			'action': action_func,
			'data': set_data,
		};

		$.ajax({
			url: ajaxurl, // обработчик funcfile
			data: data_form,
			type: 'post',
			dataType: 'json',
			success: function(json){
				//log(json);
				if(json.success == true){
					_this.fadeOut(300);
					_this.prev().fadeIn(300);
				}
			}
		});

		if (typeof _this_target !== typeof undefined && _this_target !== false){
			yaCounter47765593.reachGoal(_this_target);
			gtag('event', 'Задать вопрос', {'event_category': 'клик по кнопке', 'event_action': _this_target});
		}
	}
});

$('input[name="politics"]').change(function(e) {
	var _this = $(this);
	var form = _this.parents('.form');

	if(!_this.is(':checked')){
		form.find('input[type="submit"]').attr('disabled','disabled').addClass('disabled');
	} else {
		form.find('input[type="submit"]').removeAttr('disabled').removeClass('disabled');
	}
});

/* MORE_POSTS */

$('.ajax_more').click(function(e) {
	var this_more = $(this);
	var set_more_data = {};

	var type = this_more.data('type');
	var offset = this_more.data('offset');
	var cat_id = this_more.data('cat-id');
	var step = this_more.data('step');

	var data_form = {
		'action': 'get_posts_'+type,
		'type': type,
		'offset': offset,
		'cat_id': cat_id,
	};

	log(data_form);

	$.ajax({
		url: ajaxurl, // обработчик funcfile
		data: data_form,
		type: 'post',
		dataType: 'json',
		success: function(json){
			log(json);
			if(json.success == true){
				switch(type){
					case 'practika' :
						$('.practika .practika_view > .practika_items').append(json.items);

						if(parseInt(json.found_posts) > offset){
							offset += step;
							this_more.data('offset', offset);
						}

						if(parseInt(json.found_posts) <= offset){
							this_more.detach();
						}
						break;
					default : break;
				}
				
			}
		}
	});
});

$('.close_file').click(function(e){
	e.preventDefault();

	log($(this).parent().data('url-file'));
});

$('.command_pr_more').click(function() {
	var pr_more = $(this);
	var pr_more_count = pr_more.data('count');
	var pr_more_offset = pr_more.data('offset');
	var new_offset = pr_more_offset + 4;

	for(var pr = pr_more_offset; pr < new_offset; pr++){
		$('.commands_view > .practika_items .practika_item').eq(pr).removeClass('none');
	}

	pr_more.data('offset', new_offset);

	if(pr_more_count <= new_offset){
		pr_more.detach();
	}
});

/* EVENTS METRICS */

$('.menu a[href^=mailto]').click(function(){
	yaCounter47765593.reachGoal('pochta_klick');
	gtag('event', 'Клик по почте', {'event_category': 'knock', 'event_action': 'pochta_klick'});
});