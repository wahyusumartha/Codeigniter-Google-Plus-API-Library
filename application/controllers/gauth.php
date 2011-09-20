<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gauth extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('gpluslibrary');
	}
	
	function index(){
		if($this->gpluslibrary->is_auth() === TRUE){
			redirect('gauth/callback');
		}else{
			$this->gpluslibrary->auth();
		}
	}
	
	function profile(){
			$profile = $this->gpluslibrary->get_user_profile();
			var_dump($profile);
	}
	
	function list_activity(){
		$activities = $this->gpluslibrary->get_list_activities();
		var_dump($activities);
	}
	
	function activity($activity_id = ''){
		$activity = $this->gpluslibrary->get_activity('z13fc3zgwqfbu1dj204chnfr2tmjsti5ufw');
		var_dump($activity);
	}
	
	
	function callback(){
		if(isset($_GET['code'])){ 
			$this->gpluslibrary->request_access_token(); 
			redirect('gauth/profile');
		}else{
			redirect('gauth/profile');
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
	}
}

/*
	End of gauth.php
	Location : .application/controllers/gauth.php
*/
