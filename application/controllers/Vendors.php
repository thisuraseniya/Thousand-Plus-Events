<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Vendors extends CI_Controller {  
        public function index()
        {
            $user = $_SESSION['username'];
            $data['businesses'] = $this->tpe_model->get_my_businesses($user);
            $this->notifications();
		    $this->load->view('navbar');
            $this->load->view('vendors_home', $data);
            $this->load->view('footer');
            
            if($this->input->post('add_vendor'))
            {
                $data = array(
                    'owner' => $_SESSION['username'],
                    'name' => $this->input->post('name'),
                    'telephone' => $this->input->post('telephone'),
                    'category' => $this->input->post('type'),
                    'address' => $this->input->post('address'),
                    'open' => $this->input->post('open'),
                    'close' => $this->input->post('close'),
                    'lon' => $this->input->post('lng'),
                    'lat' => $this->input->post('lat'),                   
                    'pic' => "images/types/".($this->input->post('type')).".jpg"                  
                );
                
                $this->tpe_model->add_vendor($data);
                header("location:".base_url()."index.php/vendors");
            }
        }
        
        public function view($id)
        {
            $user = $_SESSION['username'];
            $data['view_business'] = $this->tpe_model->get_business($id/23);
            $this->notifications();
		    $this->load->view('navbar');
            $this->load->view('vendors_view', $data);
            $this->load->view('footer');
        }
        
        
        public function notifications()
        {
            $user = $_SESSION['username'];          
            $data['reminders'] = $this->tpe_model->get_user_reminders($user);
            $data['notifications'] = $this->tpe_model->get_notifications($user);           
            $this->load->view('notifications',$data);
        }
        
        
        function search_vendors()
        {   
            $name = $this->input->post('name');         
            $output = '<ul class="collection"><li class="collection-item">0 matches found</li></ul>';
            if($name != ''){
                $result = $this->tpe_model->search_vendors($name);
                $output = '<ul class="collection"><li class="collection-item">'.count($result).' matches found</li></ul>';
                $output = $output.'<ul class="collection">';
                foreach($result as $row){                
                    $output = $output.'<li class="collection-item avatar">';
                    $output = $output.'<img src="'.base_url().$row['pic'].'" alt="" class="circle">';
                    $output = $output.'<span class="title"><b>'.$row['name'].'</b></span>';
                    $output = $output.'<p>Type - <b>'.$row['category'].'</b><br>Address - <b>'.$row['address'].'</b></p>';
                    $output = $output.'<a href="'.base_url().'index.php/vendors/view/'.($row['id']*23).'" class="secondary-content btn green waves-effect waves-light">View</a>';               
                    $output = $output.'</li>';               
                }
                $output = $output.'</ul>';
            }
            echo $output;    
        }
        
        function delete_business($id)
        {
            $this->tpe_model->delete_business($id/23,$_SESSION['username']);
            header("location:".base_url()."index.php/vendors");
        }
    
    
    
    }
?>