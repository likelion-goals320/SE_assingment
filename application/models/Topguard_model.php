<?php
class Topguard_model extends CI_Model {
//table마다 model을 만들어주는 것이 깔끔하다. 
    function __construct()
    {       
        parent::__construct();
    }
 
    function gets_from_app(){ //table에 있는 정보 return
        return $this->db->query('SELECT * FROM command_app_to_com')->result();
    }
 
   function get_from_app($command_userid,$command_id, $command_name){ //table에 data 추가
       $this->db->query('INSERT INTO command_app_to_com (userid, id, name) values ('.$command_userid.','.$command_id.', '.$command_name.')');
    }
    function get_from_app_id($command_userid, $command_id){ //table에서 원하는 data 출력
      	$sql="SELECT name FROM command_app_to_com WHERE id=$command_id AND userid=$command_userid";
        return $this->db->query($sql)->result();
	//return $this->db->query($sql)->result_array();
	//return $this->db->query('SELECT name FROM command_app_to_com WHERE id=$command_id and userid=$command_userid')->result_array();
    }
    function gets_from_com(){ //table에 있는 정보 return
        return $this->db->query('SELECT * FROM command_com_to_app')->result();
    }
 	function get_from_com($command_userid, $command_id, $command_name){
		$this->db->query('INSERT INTO command_com_to_app (userid, id,name) values('.$command_userid.','.$command_id.','.$command_name.')');
	}
   function get_from_com_id($command_userid, $command_id){ //table에서 원하는 data 출력
       	$sql="SELECT name FROM command_com_to_app WHERE id=$command_id AND userid=$command_userid";
	return $this->db->query($sql)->result();
	//return $this->db->query('SELECT name FROM command_com_to_app WHERE id='.$command_id'and userid='.$command_userid)->result_array();
    }

    function create_userid(){
      $sql="SELECT distinct userid from command_com_to_app";
      return $this->db->query($sql)->num_rows();
    }
}
