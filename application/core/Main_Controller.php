<?php
class Main_Controller extends MY_Controller 
{
   var $user_details;
   function __construct()
   {
      parent::__construct();
	  $this->user_details = unserialize($this->session->userdata['user_details']);
	  //print_r($this->user_details); die;
	  if(empty($this->user_details))
	  {
	  	redirect('login');
	  }
   }
}
