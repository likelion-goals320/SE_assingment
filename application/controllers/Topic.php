<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends CI_Controller {
    function __construct()
    {       
        parent::__construct();
        //$this->load->database(); autoloac에서 추가하였기 때문에 필요X
        $this->load->model('topic_model');
    }
    function index(){        
        $this->load->view('head');
        $topics = $this->topic_model->gets();
        $this->load->view('main');
        $this->load->view('topic_list', array('topics'=>$topics));
        $this->load->view('footer');
    }
    function get($id){        
        $this->load->view('head');
        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
        $topic = $this->topic_model->get($id);
        $this->load->view('get', array('topic'=>$topic));
        $this->load->view('footer');
    }
}
?>