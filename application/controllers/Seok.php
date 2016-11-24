<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
defined('BASEPATH') OR exit('No direct script access allowed');

class Seok extends CI_Controller {

	public function index()
	{
		echo 'seokseok';
	}
	public function test1($id)
	{
		echo 'seok2 : '.$id;
	}
}
