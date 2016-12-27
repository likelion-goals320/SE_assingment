<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  //static $userid_num=0; //전역변수 설정
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

	function get_from_10(){
		$data=$this->Topguard_model->gets_from_app10();
		$this->load->view('topguard_app_command_list',array('commands'=>$data));
		$data=$this->Topguard_model->gets_from_com10();
		$this->load->view('topguard_com_command_list',array('commands'=>$data));
		$this->load->view('footer');
	}

	function get_from_com10(){
		$data=$this->Topguard_model->gets_from_com10();
		$this->load->view('topguard_com_command_list',array('commands'=>$data));
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
        $this->load->view('command_name', array('commands'=>$data));
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
        $this->load->view('command_name', array('commands'=>$data));
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
          $tmp=explode('.',$_FILES['image']['name']); //파일의 이름을 '.'을 기준으로 나누어 배열로 저장한다.
          $file_ext=strtolower(end($tmp)); //end()를 이용해서 배열의 마지막 원소를 가리키게 한 후, 즉 파일의 확장자를 가리키게 한 후 소문자로 바꿔서 저장한다.
          
          $expensions= array("jpeg","jpg","png");
          
          if(in_array($file_ext,$expensions)=== false){
             $errors[]="extension not allowed, please choose a JPEG or PNG file."; //in_array함수를 이용하여 $file_ext에 jpeg, jpg, png 중에 하나라도 있는지 확인한다.
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
	
    function give_me_userid(){
      $userid= $this->Topguard_model->create_userid();
     $this->load->view('view_userid', array('commands'=>$userid));
     $this->load->view('footer');
    }

    function insert_gpsinfo(){
      $userid = $_GET['userid'];
      $lat = $_GET['latitude'];
      $long = $_GET['longitude'];
      $this->Topguard_model->insert_gpsinfo($userid, $lat, $long);
      $this->load->view('footer');
  }

      function insert_photoinfo(){
      $name = $_GET['file_name'];
      $lightness = $_GET['lightness'];
      $time = $_GET['timestamp'];
      $face_rg = $_GET['face_rg'];
      $id = $_GET['userid'];

      $this->Topguard_model->insert_photoinfo($name, $lightness, $time, $face_rg, $id);

      //photoinfo테이블과 gpsinfo테이블 join한 후에 위도 경도 뽑아내고 gpswarning 테이블에 해당 위도 경도 없으면 데이터 넣고 있으면 감지횟수 +1(얼굴인식 횟수 증가하면 +1) => 리눅스 mysql에 트리거를 이용하여 적용시킴

      $this->load->view('footer');
  }

  function send_ratio(){

    $userid = $_GET['userid'];

    $this->Topguard_model->set_ratio($userid);
    $this->load->view('footer');
  }
}
?>
