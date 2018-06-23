<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set( DEFAULT_TIMEZONE );
		$this->load->library('template');
		if (version_compare(CI_VERSION, '2.1.0', '<')) {
      $this->load->library('security');
    }
    $this->lang->load( 'general', $this->get_current_language() );
	}

	public function get_current_language() {
		switch ( $this->input->get( 'lang' ) ) {
			case 'en':
				$lang = 'english';
				break;
			case 'vi':
				$lang = 'vietnamese';
				break;
			default:
				$lang = $this->config->item( 'language' );
		}
		return $lang;
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
