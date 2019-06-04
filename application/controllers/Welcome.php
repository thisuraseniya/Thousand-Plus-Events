<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
	public function index()
	{
        header("Location:".base_url()."index.php/home");
	}
}

?>
    
  
    