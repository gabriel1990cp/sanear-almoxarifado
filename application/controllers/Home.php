<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
	{
        $this->load->view('include/head.php');
        $this->load->view('include/nav.php');
	    $this->load->view('home/home.php');
        $this->load->view('include/footer.php');
	}
}
