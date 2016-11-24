<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topguard extends CI_Controller {
    function __construct()
    {       
        parent::__construct();
        $this->load->database(); //autoloac에서 추가하였기 때문에 필요X
        $this->load->model('Topguard_model');
        $this->load->view('head');
    }
    function index(){
        $this->load->view('topguard_main');
        $data = $this->Topguard_model->gets_from_app();
        $this->load->view('topguard_app_command_list', array('commands'=>$data));
        $data = $this->Topguard_model->gets_from_com();
        $this->load->view('topguard_com_command_list', array('commands'=>$data));
        $this->load->view('footer');
    }
    function get_from_app(){
	$userid = $_GET['userid'];
        $id = $_GET['id'];
        $name = $_GET['name'];
        $this->Topguard_model->get_from_app($userid, $id, $name);
        $data = $this->Topguard_model->gets_from_app();
        $this->load->view('topguard_app_command_list', array('commands'=>$data));
        $this->load->view('footer');
    }
    function get_from_app_id(){
        $userid = $_GET['userid'];
	$id = $_GET['id'];
        $data = $this->Topguard_model->get_from_app_id($userid, $id);
        var_dump($data);
        $this->load->view('footer');
    }

    function get_from_com(){
	$userid = $_GET['userid'];
        $id = $_GET['id'];
        $name = $_GET['name'];
        $this->Topguard_model->get_from_com($userid, $id, $name);
        $data = $this->Topguard_model->gets_from_com();
        $this->load->view('topguard_com_command_list', array('commands'=>$data));
        $this->load->view('footer');
    }
    
    function get_from_com_id(){
	$userid = $_GET['userid'];
        $id = $_GET['id'];
        $data = $this->Topguard_model->get_from_com_id($userid, $id);
        var_dump($data);
        $this->load->view('footer');
    }

    function upload(){
        $this->load->view('my_upload');
        if(isset($_FILES['image'])){
          $errors= array();
          $file_name= $_FILES['image']['name'];
          $file_size=$_FILES['image']['size'];
          $file_tmp=$_FILES['image']['tmp_name'];
          $file_type=$_FILES['image']['type'];
          $tmp=explode('.',$_FILES['image']['name']);
          $file_ext=strtolower(end($tmp));
          
          $expensions= array("jpeg","jpg","png");
          
          if(in_array($file_ext,$expensions)=== false){
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
          }
          
          if($file_size > 2097152){
             $errors[]='File size must be excately 2 MB';
          }
          
          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"uploads/".$file_name);
             echo "Success";
          }else{
             print_r($errors);
          }
        }
    }
}
?>
