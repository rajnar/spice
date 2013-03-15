<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

    public function index() {
        $this->load->view('include/header');
        //$this->load->view('fluid');
        $this->load->view('include/footer');
    }

    public function myfun() {
        $this->load->view('include/header');
        $this->load->view('templates/form');
        $this->load->view('include/footer');
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
