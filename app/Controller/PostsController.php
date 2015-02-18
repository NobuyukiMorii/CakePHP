<?php
// File: /app/Controller/PostsController.php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session' ,  'Search.Prg' , 'Paginator');
    public $uses = array('Post' , 'Category');

    public function isAuthorized($user) {
        // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->set('posts', $this->Post->find('all'));
        $this->set('categories', $this->Category->find('all'));

    }

    public function find() {
    	//おまじない
        $this->Prg->commonProcess();
        //ポストされた情報を受ける
        $foo = $this->Prg->parsedParams();
        //検索条件を設定する
        $conditions = $this->Post->parseCriteria($foo);
        //指定した条件で検索して$Postに値を格納する
        $Posts = $this->Post->find('all', array('conditions' => $conditions));
        //viewに渡す
        $this->set('Posts', $Posts);
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }

	public function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid post'));
	    }

	    $post = $this->Post->findById($id);
	    if (!$post) {
	        throw new NotFoundException(__('Invalid post'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Post->id = $id;
	        if ($this->Post->save($this->request->data)) {
	            $this->Session->setFlash(__('Your post has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your post.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $post;
	    }
	}
	
	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Post->delete($id)) {
	        $this->Session->setFlash(
	            __('The post with id: %s has been deleted.', h($id))
	        );
	    } else {
	        $this->Session->setFlash(
	            __('The post with id: %s could not be deleted.', h($id))
	        );
	    }

	    return $this->redirect(array('action' => 'index'));
	}

}