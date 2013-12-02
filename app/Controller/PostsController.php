<?php
/**
*
*/
class PostsController extends AppController
{

	public $helpers = array('Html', 'Form');
	public $name = 'Posts';
	public $components = array('Session');

	public function index()
	{
		$this->set('posts', $this->Post->find('all'));
	}

	public function view($id= null)
	{
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());
	}

	public function add()
	{
		if ($this->request->is('post')) {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Seu post foi salvo.');
				$this->redirect(array('action' => 'index' ));
			}
		}
	}

	public function edit($id = null) {
		$this->Post->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Post->read();
		} else {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Seu post foi atualizado.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function delete($id)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash('O post com id: '. $id . ' foi deletado.');
			$this->redirect(array('action'=>'index'));
		}
	}



}
