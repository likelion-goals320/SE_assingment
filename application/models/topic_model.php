<?php
class Topic_model extends CI_Model {
//table마다 model을 만들어주는 것이 깔끔하다. 
    function __construct()
    {       
        parent::__construct();
    }
 
    function gets(){
        return $this->db->query("SELECT * FROM topic")->result();
    }
 
    function get($topic_id){
        return $this->db->get_where('topic', array('id'=>$topic_id))->row();
        //위의 active record는
        //return $this->db->query('SELECT * FROM topic WHERE id='.$topic_id)와 같다.
    }
}