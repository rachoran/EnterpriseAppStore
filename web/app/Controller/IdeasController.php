<?php

class IdeasController extends AppController {
	
	public $helpers = array('Form');
	
	public $components = array('Paginator');

    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Idea.created' => 'ASC'
        )
    );
	
	public function isAuthorized($user) {
		$ok = false;
	    if (Me::minUser()) {
	    	$a = strtolower($this->params['action']);
	    	if ($a == 'index') {
	        	$ok = Me::minAdmin();
	        }
	        else {
		        return true;
	        }
	    }
		if (!$ok) {
			Error::add('You are not authorized to access this section.', Error::TypeError);
		}
		return $ok;
	}
	
	public function index() {
		$this->setPageIcon('comments');
		
		/* Prepare the data to be paginated with the paginator component */
		$data = $this->paginate('Idea');
		
		/* Prepare the data to be sent to the view */
		$this->set(compact('page', 'subpage', 'title_for_layout', 'data'));

	}
	
	public function edit() {
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
			$idea = array('name'=>Me::get('firstname').' '.Me::get('lastname'), 'email'=>Me::get('email'), 'area'=>'0', 'message'=>'');
		}
		$this->set('idea', $idea);
	}
	
}
