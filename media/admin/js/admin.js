$(function(){
	$('.nav-tabs').each(function(){
		if (location.hash.length > 0) {
			$(this).find('[href="'+location.hash+'"]')
				.first()
					.tab('show');
		}
	});
	
	$('.btn-clear').click(function(e){
		$(this).closest('.form-inline')
			.find(':input')
				.not(':button, :submit, :reset, :hidden')
				.val('')
				.removeAttr('checked')
				.removeAttr('selected');
	});
});

$(function(){

	if ( $('.toggle_switcher').length) {
		$.each($('.toggle_switcher'), function(index, element){
			var $element = $(element),
				switchGroup = '.' + $element.attr('name');
			if ($element.is(':checked') != false) {
				$('.hide_toggle'+switchGroup).each(function(){
					$(this).hide();
				});
			} else {
				$('.hide_toggle_invert'+switchGroup).each(function(){
					$(this).hide();
				});
			}
		});
	}

	$('.toggle_switcher').click(function(){
		var switchGroup = '.'+$(this).attr('name');

		$('.hide_toggle'+switchGroup+', .hide_toggle_invert'+switchGroup).each(function(){
			$(this).toggle(1000);
		});
	});

	$('.hidden').each(function(){
		$(this).hide();
	});

	$("a[rel^='flyout']").flyout({
		closeTip: '(кликните по изображению, чтобы закрыть)'
	});

	jQuery.datepicker.setDefaults(jQuery.datepicker.regional['ru']);
	jQuery.datepicker.setDefaults({ dateFormat: 'yy/mm/dd' });

	$.timepicker.regional['ru'] = {
		timeOnlyTitle: 'Выберите время',
		timeText: 'Время',
		hourText: 'Часы',
		minuteText: 'Минуты',
		secondText: 'Секунды',
		millisecText: 'миллисекунды',
		currentText: 'Сейчас',
		closeText: 'Закрыть',
		ampm: false
	};
	$.timepicker.setDefaults($.timepicker.regional['ru']);

	$( "input:submit, a.button, button").button();

	$('body > .container').css('min-height', ($(window).height() - 30) + 'px');
});

$(function(){
	$('button.kr-dyn-creator').live("click", function(){
		var _li = $(this).closest('.kr-dyn-list');
		var _li_clone = _li.clone();

		$('select', _li_clone).val('');
		$('input', _li_clone).val('');

		_li.after(_li_clone);
	});
	$('button.kr-dyn-deleter').live("click", function(){
		if (confirm("Вы действительно хотите удалить выбранный элемент?")) {
			$(this).closest('.kr-dyn-list')
				.remove();
		}
	});

	$('.delete_button').live("click", function(){
		return confirm("Вы действительно хотите удалить выбранный элемент?");
	});
	$('.btn[name="cancel"]').live("click", function(){
		return confirm("Выйти без сохранения?");
	});
});

$(function(){
	var el = $("#js-multiupload-holder");
	if ( ! el.length) return;
	el.pluploadQueue({
		runtimes : 'gears,flash,silverlight,html5',
		url : el.attr('data-url'),
		max_file_size : '10mb',
		chunk_size : '1mb',
//		unique_names : true,
		resize : {width : 1200, height : 1000, quality : 90},
		filters : [
			{title : "Image files", extensions : "jpg,jpeg,gif,png"}
		],
		flash_swf_url : '/media/admin/vendor/plupload/plupload.flash.swf',
		silverlight_xap_url : '/media/admin/vendor/plupload/plupload.silverlight.xap',
		preinit : {
			Init: function(up, info) {
			},

			UploadFile: function(up, file) {
				up.settings.multipart_params = {
						category_id : $('#album_select').val(),
						add_to_head : $('#add_to_head:checked').length
				};

				// You can override settings before the file is uploaded
				// up.settings.url = 'upload.php?id=' + file.id;
				// up.settings.multipart_params = {param1 : 'value1', param2 : 'value2'};
			},
			ChunkUploaded: function(up, file, chunkArgs) {
				var data = $.parseJSON(chunkArgs.response);
				if (data && data.error) {
					chunkArgs.cancelled = true;
					up.trigger("Error", {message: "'" + data.error.message + "'", file: file});
					window.setTimeout(function(){
						$('#'+file.id)
							.find('.plupload_file_name')
							.after($('<span class="plupload_error_message" />').text(data.error.message));
					}, 100);
					return false;
				}
			},
			FileUploaded: function(up, file, response) {
				var data = $.parseJSON(response.response);
				if (data && data.error) {
					up.trigger("Error", {message: "'" + data.error.message + "'", file: file});
					$('#'+file.id).find('.plupload_file_name').append($('<span class="plupload_error_message" />').text(data.error.message));
					return false;
				}
			}
		}
	});
});

$(function(){
	var $list = $('.js-dyn-input');
	if ($list.length) {
		$(window).on('click', function(e){
			if ($(e.target).hasClass('casted-input')) {
				return;
			}
			$list.filter('.casted').each(function(){
				var $this = $(this);
				$('body').addClass('ajax-requestion');
				$.ajax({
					url: $this.data('action'),
					type: 'post',
					data: {
						id: $this.data('id'),
						field: $this.data('field'),
						value: $.trim($this.children('input').val())
					},
					dataType: 'json',
					cache: false
				}).done(function(data){
					$this.html(data);
				}).fail(function(){
					$this.html($this.data('value'));
				}).always(function(){
					$this.removeClass('casted');
					$('body').removeClass('ajax-requestion');
				});
			});
		});
		
		$list.on('click', function(e){
			e.stopPropagation();
		});
		$list.on('dblclick', function(e){
			var $this = $(this);
			$this.addClass('casted');
			$this.data('value', $.trim($this.text()));
			$this.html('<input class="casted-input" value="'+$this.data('value')+'">');
			$this.children('input').select();
		});
	}
});

