<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rsvp extends CI_Controller {
    public function index()
    {
        header("location:".base_url()."index.php/home");       
    }
    
    public function event($event_name, $event_id)
    {
        $id = $event_id/23;        
        $data['events'] = $this->tpe_model->summary($id);
        
       
        if (!empty($data['events']) and md5($data['events']['name']) == $event_name){
       
            $exist = $this->tpe_model->get_departments($id);            
            if ($exist['registration'] == null) {
                header("location:".base_url()."index.php/rsvp");                
            }
            else {

                $data['id_passed'] = $event_id;
                $this->load->view('rsvp_confirm', $data);
                $this->load->view('footer');

                if($this->input->post('btn_save'))
                {
                    $person = array(
                        'dept_id' =>  $this->tpe_model->get_registrations_dept_id($id),
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'telephone' => $this->input->post('tele'),
                        'address' => $this->input->post('address')                    
                    );
                    $result = $this->tpe_model->register_rsvp($person);
                    echo "<script>alert('$result');</script>";
                }
            }
        
        }
        else{
            header("location:".base_url()."index.php/rsvp");     
        }
    }
   
}

?>
