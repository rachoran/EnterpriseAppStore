<?php

class IdeasController extends AppController {
	
	var $helpers = array('Form');
	
	public function index() {
		$this->setPageIcon('comment');
		$this->enablePageClass('basic-edit');
		
		$idea = NULL;
		if ($this->request->is('post')) {
			$idea = $this->Idea->saveIdea($this->request->data['idea']);
			if (isset($idea['id']) && (int)$idea['id']) {
				$this->redirect(array('action' => 'index'));
			}
		}
		if (!$idea) {
			$idea = array('fullname'=>'', 'email'=>'', 'area'=>'0', 'message'=>'');
		}
		$this->set('idea', $idea);
	}
	
}
