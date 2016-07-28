<?php defined('SYSPATH') or die('No direct script access.'); ?>

	<div class="feedback-modal-holder">
		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#feedback-modal">Заказать расчет стоимости проекта</button>
	</div>

	<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Заказать звонок</h4>
					<div class="inner-spacer color-bg"></div>
				</div>
				<div class="modal-body">
	
					<article class="text">
						<p>Укажите номер телефона, на который следует перезвонить нашему менеджеру.</p>
					</article>
	
					<form id="feedback-form" action="#" data-action="/feedback" method="post"> 
						<div class="form-row">
							<input type="text" placeholder="Имя" name="name" class="border-form">
						</div>
	 					<div class="form-row">
							<input type="text" placeholder="Номер телефона" name="phone" class="border-form">
						</div>
					</form>
	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default js-cancel" data-dismiss="modal">Закрыть</button>
					<button type="button" class="btn btn-primary js-submit">Отправить</button>
				</div>
				<div class="js-loader"><img src="/media/default/images/bx_loader.gif"></div>
			</div>
		</div>
	</div>
	