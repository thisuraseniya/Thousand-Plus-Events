<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collaborate extends CI_Controller {   
    
	public function index()
	{
        $user = $_SESSION['username'];
        $data['collab_depts'] = $this->tpe_model->get_collab_depts($user);
        $data['collaborations'] = $this->tpe_model->get_notifications_all($user);
        
        $this->notifications();
		$this->load->view('navbar');
		$this->load->view('collaborate',$data);
        $this->load->view('footer');
	}
    
     public function notifications()
    {
        $user = $_SESSION['username'];          
        $data['reminders'] = $this->tpe_model->get_user_reminders($user);
        $data['notifications'] = $this->tpe_model->get_notifications($user);           
        $this->load->view('notifications',$data);
    }
    
    public function finance($id_passed)
        {
            $id = $id_passed/23;
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
            }
            else 
            {
                 header("location:".base_url()."index.php/home/login");   
            }
        
            $data['events'] = $this->tpe_model->get_collab($username, $id, 'finance');
            if (!empty($data['events'])){
            
                $exist = $this->tpe_model->get_departments($id);

                if ($exist['finance'] == null) {
                    header("location:".base_url()."index.php/collaborate");                
                }


                $data['crew'] = $this->tpe_model->show_crew_finance($id);
                $data['tasks'] = $this->tpe_model->fetch_tasks_finance($id);
                $data['companies'] = $this->tpe_model->fetch_companies_finance($id);
                $data['income'] = $this->tpe_model->get_income_finance($id);
                $data['expenses'] = $this->tpe_model->get_expenses_finance($id);

                $data['id_passed'] = $id_passed;
                
                $this->notifications();
                $this->load->view('navbar');
                $this->load->view('collaborate_finance', $data);                   
                $this->load->view('footer');   
               
                if ( $this->input->post('add_company') )
                {
                    $c_name = $this->input->post('c_name');
                    $c_address = $this->input->post('c_address');
                    $c_telephone = $this->input->post('c_telephone');
                    $c_email = $this->input->post('c_email');
                    $c_website = $this->input->post('c_website');
                    $this->tpe_model->add_company_finance($id, $c_name, $c_address, $c_telephone, $c_email, $c_website);
                    header("location:".base_url()."index.php/collaborate/finance/$id_passed");
                }

                if ( $this->input->post('edit_company') )
                {
                    $c_name = $this->input->post('c_name');
                    $c_address = $this->input->post('c_address');
                    $c_telephone = $this->input->post('c_telephone');
                    $c_email = $this->input->post('c_email');
                    $c_website = $this->input->post('c_website');
                    $c_id = $this->input->post('c_id')/23;
                    $this->tpe_model->edit_company_finance($id, $c_id, $c_name, $c_address, $c_telephone, $c_email, $c_website);
                    header("location:".base_url()."index.php/collaborate/finance/$id_passed");
                }

                if ( $this->input->post('add_transaction') )
                {
                    $transaction = array(
                        'dept_id' => $this->tpe_model->get_finance_dept_id($id),
                        'amount' => $this->input->post('amount'),
                        'type' => $this->input->post('type'),
                        'added_by' => $_SESSION['username'],
                        'description' => $this->input->post('description'),
                        'date' => $this->input->post('date')   
                    );

                    $this->tpe_model->add_transaction_finance($transaction);
                    header("location:".base_url()."index.php/collaborate/finance/$id_passed");
                }
            }
            else {header("location:".base_url()."index.php/collaborate/manage"); }
            
        }
    
        public function delete_transaction_finance($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_finance($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/collaborate/finance/$e"); 
            
        }
    
        public function logistics($id_passed)
        {
            $id = $id_passed/23;
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
            }
            else 
            {
                 header("location:".base_url()."index.php/home/login");   
            }
            
            $data['events'] = $this->tpe_model->get_collab($username, $id, 'logistics');
            if (!empty($data['events'])){
            
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['logistics'] == null) {
                header("location:".base_url()."index.php/collaborate");                
            }
            
                  
            $data['crew'] = $this->tpe_model->show_crew_logistics($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_logistics($id);
            $data['income'] = $this->tpe_model->get_income_logistics($id);
            $data['expenses'] = $this->tpe_model->get_expenses_logistics($id);
            $data['id_passed'] = $id_passed;
            
            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('collaborate_logistics', $data);             
            $this->load->view('footer');   

                      
            
             if ( $this->input->post('add_transaction') )
            {
                $transaction = array(
                    'dept_id' => $this->tpe_model->get_logistics_dept_id($id),
                    'amount' => $this->input->post('amount'),
                    'type' => $this->input->post('type'),
                    'added_by' => $_SESSION['username'],
                    'description' => $this->input->post('description'),
                    'date' => $this->input->post('date')   
                );

                $this->tpe_model->add_transaction_logistics($transaction);
                header("location:".base_url()."index.php/collaborate/logistics/$id_passed");
            }
            }
            else
            {
                header("location:".base_url()."index.php/collaborate");
            }
        }
    
        public function delete_transaction_logistics($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_logistics($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/collaborate/logistics/$e"); 
            
        }
    
    /////////// Sales
    
    public function sales($id_passed)
        {
            $id = $id_passed/23;
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
            }
            else 
            {
                 header("location:".base_url()."index.php/home/login");   
            }
            
            $data['events'] = $this->tpe_model->get_collab($username, $id, 'sales');
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['sales'] == null) {
                header("location:".base_url()."index.php/collaborate");                
            }
            
            
            $data['crew'] = $this->tpe_model->show_crew_sales($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_sales($id);
            $data['income'] = $this->tpe_model->get_income_sales($id);
            $data['expenses'] = $this->tpe_model->get_expenses_sales($id);
            $data['id_passed'] = $id_passed;
            
            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('collaborate_sales', $data);             
            $this->load->view('footer');      
            
            if ( $this->input->post('add_transaction') )
            {
                $transaction = array(
                    'dept_id' => $this->tpe_model->get_sales_dept_id($id),
                    'amount' => $this->input->post('amount'),
                    'type' => $this->input->post('type'),
                    'added_by' => $_SESSION['username'],
                    'description' => $this->input->post('description'),
                    'date' => $this->input->post('date')   
                );

                $this->tpe_model->add_transaction_sales($transaction);
                header("location:".base_url()."index.php/collaborate/sales/$id_passed");
            }
                }
            else {header("location:".base_url()."index.php/collaborate/"); }
        }
    
        public function delete_transaction_sales($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_sales($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/collaborate/sales/$e"); 
            
        }
    
    
     //Registrations
    
     public function registrations($id_passed)
        {
            $id = $id_passed/23;
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
            }
            else 
            {
                 header("location:".base_url()."index.php/home/login");   
            }
         
            $data['events'] = $this->tpe_model->get_collab($username, $id, 'registrations');
            if (!empty($data['events'])){
            
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['registration'] == null) {
                header("location:".base_url()."index.php/collaborate");                
            }
            
               
            $info = $this->tpe_model->get_confirmed_registrations($id);
            $data['total'] = $info['total'];
            $data['confirmed'] = $info['confirmed'];            
            $data['crew'] = $this->tpe_model->show_crew_registrations($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_registrations($id);
            $data['id_passed'] = $id_passed;
         
            $this->notifications();
            $this->load->view('navbar'); 
            $this->load->view('collaborate_registrations', $data);              
            $this->load->view('footer');   

            
           
            }
            else {header("location:".base_url()."index.php/home/manage"); }
        }
    
    /////////////////////RSVP
   public function rsvp($e) 
    {
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
        }
        else 
        {
            header("location:".base_url()."index.php/home/login");   
        }
        
        $id = $e/23;  
        $data['events'] = $this->tpe_model->get_collab($username, $id, 'registrations');
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            if ($exist['registration'] == null) {
                header("location:".base_url()."index.php/collaborate");                
            }
            $info = $this->tpe_model->get_responses($id);
            $data['responses'] = $info['responses'];
            $data['current'] = $info['current'];
            $data['target'] = $this->tpe_model->get_target_rsvp($id);       
                 
            $data['id_passed'] = $e;         

            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('collaborate_rsvp', $data);             
            $this->load->view('footer');    
            }
            else {header("location:".base_url()."index.php/collaborate"); }
     } 
    
    
     //Decorations Dept
        public function decorations($id_passed)
        {
            $id = $id_passed/23;
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
            }
            else 
            {
                 header("location:".base_url()."index.php/home/login");   
            }
            
            $data['events'] = $this->tpe_model->get_collab($username, $id, 'decorations');
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['decoration'] == null) {
                header("location:".base_url()."index.php/collaborate");                
            }
            
            
            $data['crew'] = $this->tpe_model->show_crew_decorations($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_decorations($id);
            $data['income'] = $this->tpe_model->get_income_decorations($id);
            $data['expenses'] = $this->tpe_model->get_expenses_decorations($id);
            
            $data['id_passed'] = $id_passed;
            
            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('collaborate_decorations', $data);             
            $this->load->view('footer');   

                      
            
            if ( $this->input->post('add_transaction') )
            {
                $transaction = array(
                    'dept_id' => $this->tpe_model->get_decorations_dept_id($id),
                    'amount' => $this->input->post('amount'),
                    'type' => $this->input->post('type'),
                    'added_by' => $_SESSION['username'],
                    'description' => $this->input->post('description'),
                    'date' => $this->input->post('date')   
                );

                $this->tpe_model->add_transaction_decorations($transaction);
                header("location:".base_url()."index.php/collaborate/decorations/$id_passed");
            }
            }
            else {header("location:".base_url()."index.php/collaborate"); }
            
        }
    
         public function delete_transaction_decorations($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_decorations($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/collaborate/decorations/$e"); 
            
        }
    
    
    
    //Marketing Dept
        public function marketing($id_passed)
        {
            $id = $id_passed/23;
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
            }
            else 
            {
                 header("location:".base_url()."index.php/home/login");   
            }
            
            $data['events'] = $this->tpe_model->get_collab($username, $id, 'marketing');
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['marketing'] == null) {
                header("location:".base_url()."index.php/collaborate");                  
            }            
                
            $data['crew'] = $this->tpe_model->show_crew_marketing($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_marketing($id);
            $data['income'] = $this->tpe_model->get_income_marketing($id);
            $data['expenses'] = $this->tpe_model->get_expenses_marketing($id);
            $data['id_passed'] = $id_passed;
        
            $this->notifications();
            $this->load->view('navbar');
            $this->load->view('collaborate_marketing', $data);              
            $this->load->view('footer');         
        
            if ( $this->input->post('add_transaction') )
                {
                    $transaction = array(
                        'dept_id' => $this->tpe_model->get_marketing_dept_id($id),
                        'amount' => $this->input->post('amount'),
                        'type' => $this->input->post('type'),
                        'added_by' => $_SESSION['username'],
                        'description' => $this->input->post('description'),
                        'date' => $this->input->post('date')   
                    );
                    $this->tpe_model->add_transaction_marketing($transaction);
                    header("location:".base_url()."index.php/collaborate/marketing/$id_passed");
                }
            }
            else {
                header("location:".base_url()."index.php/collaborate"); 
            }
        }
    
        public function delete_transaction_marketing($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_marketing($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/collaborate/marketing/$e"); 
            
        }
    
    
    /////////////////////////// SEARCH
    
    public function search()
    {
        $this->load->view('search');
    }
    
    function search_events()
    {   
        $name = $this->input->post('name');         
        $output = '<ul class="collection"><li class="collection-item">0 matches found</li></ul>';
        if($name != ''){
            $dis = "$(this).attr('disabled', 'disabled')";
            $result = $this->tpe_model->search_events($name);
            $output = '<ul class="collection"><li class="collection-item">'.count($result).' matches found</li></ul>';
            $output = $output.'<ul class="collection">';
            foreach($result as $row){                
                $output = $output.'<li class="collection-item avatar">';
                $output = $output.'<img src="'.base_url().$row['pic'].'" alt="" class="circle">';
                $output = $output.'<span class="title"><b>'.$row['name'].'</b></span>';
                $output = $output.'<p>Date - <b>'.$row['date'].'</b><br>Owner - <b>'.$row['fname'].' '.$row['lname'].'</b></p>';
                $output = $output.'<a href="'.base_url().'index.php/collaborate/collab/'.($row['id']*23).'" class="secondary-content btn green waves-effect waves-light" onClick="'.$dis.'">Collaborate</a>';               
                $output = $output.'</li>';               
            }
            $output = $output.'</ul>';
            
           
        }
        echo $output;    
    }
    
    public function collab($event_id)
    {
        $user = $_SESSION['username'];
        $event = $event_id/23;
        $info = $this->tpe_model->send_collab_email($event, $user);
        $to = $info['email']['email'];
        $e = $info['email']['name'];
        $details = $info['details'];
        
        $data['event_name'] = $e;
        $data['fname'] = $details['fname'];
        $data['lname'] = $details['lname'];
        $data['username'] = $details['username'];
        $data['email'] = $details['email'];
        $data['pic'] = $details['pic'];
        $data['telephone'] = $details['telephone'];
        $data['event_id'] = $event_id;
        $msg = $this->load->view('email_collab', $data, true);  
        
        $this->email->from('thousandplusevents@gmail.com');
        $this->email->to($to);
        $this->email->subject('Request For Collaboration - '.$e);
        $this->email->message($msg);
        $this->email->send(); 
        header("location:".base_url()."index.php/collaborate"); 
    }
    
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>