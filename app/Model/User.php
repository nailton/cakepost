<?php
// app/Model/User.php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel
{
	public $name = 'User';
	public $validate = array(
		array('username' => array(
			'required' => array(
				'rule'=>array('notEmpty'),
				'message'=> 'O nome de usuário e obrigatório'
				)
			),
		'password'=>array(
			'required'=>array(
				'rule'=>array('notEmpty'),
				'message'=>'A senha é obrigatório'
				)
			),
		'role'=>array(
			'valid'=>array(
				'rule'=>array('inList', array('admin' , 'author')),
				'message'=>'Por favor entre com uma função válida',
				'allowEmpty'=>false
				)
			)
		)
		);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

}

