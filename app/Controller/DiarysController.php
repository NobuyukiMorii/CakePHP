<?php

class DiarysController extends AppController {

    public $components = array('RequestHandler');

    public function index() {
        $diaries = $this->Diary->find('all');
        $this->set(array(
            'diary' => $diaries,
            '_serialize' => array('diary')
        ));
    }

    public function view($id) {
        $diary = $this->Diary->findById($id);
        $this->set(array(
            'diary' => $diary,
            '_serialize' => array('diary')
        ));
    }

    public function add() {
        $this->Diary->create();
        if ($this->Diary->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function edit($id) {
        $this->Diary->id = $id;
        if ($this->Diary->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function delete($id) {
        if ($this->Diary->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}