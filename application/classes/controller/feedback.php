<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Feedback extends Controller {
	
	public function action_index()
	{
		if ( ! $this->request->is_ajax()) {
			throw new HTTP_Exception_404();
		}
		
		$result = array(
			'errors' => array(),
		);
		
		$post = array_intersect_key($this->request->post(), array(
			'phone' => TRUE,
			'name' => TRUE,
		));
		
		$validation = Validation::factory($post)
			->rules('phone', array(
				array('not_empty'),
				array('phone'),
				array('max_length', array(':value', 255)),
			))
			->rules('name', array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			));
		
		if ($validation->check()) {
			$this->save($post);
			$this->send($post);
			
		} else {
			$result['errors'] = array_keys($validation->errors());
		}
		
		Ku_AJAX::send('json', $result);
	}
	
	private function save($data)
	{
		DB::insert('feedback', array_keys($data))
			->values($data)
			->execute();
	}
	
	private function send($data)
	{
		$message = 'Время заявки: '.date('Y-m-d H:i')."\r\n";
		$message .= 'Номер телефона:'.Arr::get($data, 'phone')."\r\n";
		$message .= 'Имя:'.Arr::get($data, 'name');
		Email::send(array(
			'to' => 'info@ask-meta.ru', 
			'bcc' => 'meta-architects@yandex.ru'
		), 'no-reply@meta-architects.ru', '[META Architects]: заказ звонка', $message);
	}
}