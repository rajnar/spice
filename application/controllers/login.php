<?php if (!defined('BASEPATH')) die();
class Login extends MY_Controller {

    function __construct() {
        parent::__construct();

    }

    public function index() {

        $user_details = '';
        if(isset($this->session->userdata['user_details'])) {
            $user_details = unserialize($this->session->userdata['user_details']);
        }
        if(!empty($user_details)) {
            redirect('stock');
        }

        $header_data['active_tab'] = 'Login';
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('login/index',$data);
    }

    public function loginUser() {
    //print_r($_POST);
        if($this->login_model->login($_POST)) {
            $user_details = unserialize($this->session->userdata['user_details']);
            echo 'success';
        }
        else {
            echo 'fail';
        }
    }
    public function logout() {
        $this->login_model->logout();
        redirect('login');
    }

    public function changepwd() {

        $user_details = '';
        if(isset($this->session->userdata['user_details'])) {
            $user_details = unserialize($this->session->userdata['user_details']);
        }
        if(empty($user_details)) {
            redirect('login');
        }

        $header_data['active_tab'] = 'Login';
        $header_data['user_details'] = $user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('login/change_pwd',$data);
    }
}