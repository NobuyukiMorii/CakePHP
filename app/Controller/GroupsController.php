<?php
// File: /app/Controller/GroupsController.php
class GroupsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session' ,  'Search.Prg' , 'Paginator');
    public $uses = array('Group' , 'Post' , 'Group' , 'User');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    public function index() {
        $this->set('groups', $this->Group->find('all'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid group'));
        }

        $group = $this->Group->findById($id);
        if (!$group) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->set('group', $group);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('Your group has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your group.'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid group'));
        }

        $group = $this->Group->findById($id);
        if (!$group) {
            throw new NotFoundException(__('Invalid group'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Group->id = $id;
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('Your group has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your group.'));
        }

        if (!$this->request->data) {
            $this->request->data = $group;
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Group->delete($id)) {
            $this->Session->setFlash(
                __('The group with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The group with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

}