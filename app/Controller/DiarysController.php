<?php

class DiarysController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index(){
        //①検索する
        $data = $this->Diary->find('all',
            array(
                'conditions' => array('Diary.id' => 1)
            )
        );
        //②ビューで変数が使えるように渡す
        $this->set('data', $data);
    }
}