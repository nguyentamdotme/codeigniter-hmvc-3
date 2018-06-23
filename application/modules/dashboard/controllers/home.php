<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

 	public function __construct()
 	{
 		parent::__construct();

 	}

 	public function index()
 	{
 		$this->template->set_template('admin');
 		$this->template->write('title', $this->lang->line( 'Author' ), TRUE);
 		$this->template->write_view('content', 'home', NULL, TRUE);
 		$data = array(
      'menuitems' => array(
        array('title' => 'First Link', 'link' => '/first'),
        array('title' => 'Second Link', 'link' => '/second'),
      )
		);
		$this->template->parse_view('content', 'menu', $data);
 		$this->template->render();
 	}
}
