<?php
// File: /app/Controller/CategoriesController.php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session' ,  'Search.Prg' , 'Paginator');
    public $uses = array('Category' , 'Post');

    public function index($category_id) {
        $Categories = $this->Category->find('all' ,array(
            'conditions' => array('id' => $category_id)
        ));
        $CategoriesList = $this->Category->find('all' , array(
            'recursive' => -1
        ));

        $this->set('Categories', $Categories);
        $this->set('CategoriesList', $CategoriesList);
        $this->set('category_id' , $category_id);
    }

    public function find() {
        //おまじない
        $this->Prg->commonProcess();
        //ポストされた情報を受ける
        $foo = $this->Prg->parsedParams();
        //検索条件を設定する
        $conditions = $this->Category->parseCriteria($foo);
        //指定した条件で検索して$Categoryに値を格納する
        $Categories = $this->Category->find('all', array('conditions' => $conditions));
        //viewに渡す
        $this->set('Categories', $Categories);
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }

        $category = $this->Category->findById($id);
        if (!$category) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->set('category', $category);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your category.'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }

        $category = $this->Category->findById($id);
        if (!$category) {
            throw new NotFoundException(__('Invalid category'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your category has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your category.'));
        }

        if (!$this->request->data) {
            $this->request->data = $category;
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Category->delete($id)) {
            $this->Session->setFlash(
                __('The category with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The category with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

}