<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
   
	public function index()
	{
        if(isset($_SESSION['username']))
        {
            header("location:".base_url()."index.php/home/homepage");   
        }
		$this->load->view('landing');
        
	}
    
   
    
    public function register()
	{
        if(isset($_SESSION['username']))
        {
            header("location:".base_url()."index.php/home/homepage");   
        }
        
        $this->load->view('register');
        $this->load->view('footer');

        if ( $this->input->post('reg') )
        {
            $user = $this->input->post('user');
            $pass = $this->input->post('pass1');
            $email = $this->input->post('email');
            $validate_code = rand(100000,999999);
            $result = $this->tpe_model->check_user($user, $email);
            
            if (!$result)
            {
                $add = $this->tpe_model->register($user, md5($pass), $email, $validate_code);
                
                //Send verification email
                $data['validate_code'] = $validate_code;
                $msg = $this->load->view('email_validate', $data, true);
                $this->email->from('thousandplusevents@gmail.com');
                $this->email->to($email);   
                $this->email->subject('Verify your Email - Thousand Plus Events');
                $this->email->message($msg);
                $this->email->send(); 
                
                
                header("location:".base_url()."index.php/home/login");             
            }
            else
            {
                echo "<script> alert('Username or email already registered');</script>";
            }
            
        } 
	}
    
    public function login()
	{
        if(isset($_SESSION['username']))
        {
            header("location:".base_url()."index.php/home/homepage");   
        }
        
		$this->load->view('login');
        $this->load->view('footer');    
        
        if ( $this->input->post('btn_submit') )
        {
            $user = $this->input->post('user');
            $pass = $this->input->post('pass');        
            
            $result = $this->tpe_model->login($user, md5($pass));

            if($result) {
                if($result['type'] == 0){
                    $this->session->set_userdata('type', $result['type']);                     
                    $this->session->set_userdata('pic', 'images/propic/default.png');  
                    $this->session->set_userdata('name', "Administrator");
                    header("location:".base_url()."index.php/admin");            
                    
                }
                else if ($result['type'] == 1){                    
                    
                    $got_user = $result['username'];           
                    $details = $this->tpe_model->get_name($got_user);
                    $f_name = $details['fname'];
                    
                    if ($details['fname'] == null)
                    {
                        $f_name = 'Welcome User!';
                    }
                    
                    $this->session->set_userdata('name', $f_name);
                    $this->session->set_userdata('pic', $details['pic']);
                    $this->session->set_userdata('type', $result['type']);
                    $this->session->set_userdata('reminder_toggle', $details['reminders']);
                    $this->session->set_userdata('reminders', $details['reminders']);       
                    
                    
                    if($details['validated'] == 0)
                    {
                        $this->session->set_userdata('validated', 0);                       
                        header("location:".base_url()."index.php/home/verify/".$result['username']);  
                    }
                    else if ($details['validated'] == 1)
                    {
                        $this->session->set_userdata('username', $got_user);                       
                        header("location:".base_url()."index.php/home/homepage");   
                    }
                }
            }
            else
            {
                echo "<script>alert('Username and/or password is incorrect');</script>";
            }
        }       
    }

    public function create() //create event
    {
        if (isset($_SESSION['username']))
        {   
            $this->notifications();
            $this->load->view('navbar');
            $this->load->view('create_event');
            $this->load->view('footer');    

            if ( $this->input->post('btn_save') )
            {
                if (!empty($_FILES['fileToUpload']['name'])) 
                {
                    $config['upload_path']          = './images/events';
                    $config['allowed_types']        = 'jpg|png|jpeg';
                    $config['max_size']             = 5000;
                    $config['max_width']            = 3000;
                    $config['max_height']           = 3000;
                    $config['overwrite']            = TRUE;

                    $file_name = basename($_FILES["fileToUpload"]["name"]);
                    $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));         
                    $config['file_name'] = $this->input->post('name');

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('fileToUpload'))
                    {
                        echo $this->upload->display_errors();
                    }
                    else 
                    {
                        $path = "images/events/".$this->upload->data('file_name');
                    }
                }
               
                else
                {                 
                    $path =  "images/events/default.jpg";
                }
                    
                $data = array(
                    'name' => $this->input->post('name'),
                    'type' => $this->input->post('type'),
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time'),
                    'description' => $this->input->post('desc'),
                    'pic' => $path,
                    'owner' => $_SESSION['username']
                );

                $this->tpe_model->create($data); 
                header("location:".base_url()."index.php/home/manage");
            }
        }     
        
        else
        {
           header("location:".base_url()."index.php/home/login");
        }
    }

//    public function edit()
//    {
//        if (isset($_SESSION['username']))
//        {
//            $this->load->view('navbar');
//            $this->load->view('view_events');
//            $this->load->view('footer');    
//
//            if ( $this->input->post('btn_save') )
//            {
//                $data = array(
//                    'name' => $this->input->post('name'),
//                    'type' => $this->input->post('type'),
//                    'date' => $this->input->post('date'),
//                    'time' => $this->input->post('time'),
//                    'pic' => "ghf",
//                    'owner' => $this->input->post('owner')
//                );
//
//                $this->tpe_model->create($data);            
//            }
//        }
//        else
//        {
//           header("location:".base_url()."index.php/home/login");
//        }
//
//    }
    
    public function profile()
    {
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];   
            $details = $this->tpe_model->get_name($username);    
            
            $this->notifications();
            $this->load->view('navbar');
            $this->load->view('profile', $details);

            $this->load->view('footer');  



            if ( $this->input->post('btn_save') )
            {

                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $gender = $this->input->post('gender');
                $nic = $this->input->post('nic');
                $tele = $this->input->post('tele');   

                $result = $this->tpe_model->profile($fname, $lname, $gender, $nic, $tele, $username); 
                if ($result == 0)
                {
                    $this->session->set_userdata('name', $fname);
                    echo "<script>alert('successfully updated')</script>";
                    header("location:".base_url()."index.php/home/profile");

                }
            } 
        }
        else
        {
           header("location:".base_url()."index.php/home/login");
        }

    }
    
    public function logout()
    {
        session_destroy();
        header("location:".base_url()."index.php/home/");
    }

    
    public function homepage()
    {
        if (isset($_SESSION['username']))
        {
            $user = $_SESSION['username'];           
            $this->notifications();
            
            $this->load->view('navbar');
            $this->load->view('homepage');
            $this->load->view('footer');
        }
        else 
        {
            header("location:".base_url()."index.php/home/login");
        }
    }
    
    public function manage() //manage events
    {
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username']; 
            $data['events'] = $this->tpe_model->view_events($username);
            $this->notifications();
            $this->load->view('navbar'); 
            $this->load->view('manage', $data);            
            $this->load->view('footer'); 
        }
        else 
        {
            header("location:".base_url()."index.php/home/login");
        }
        
    }
    
    public function event($id_pass) //display specific event
    {
        
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
            $id = $id_pass/23;
            $_SESSION['id'] = $id_pass;
            $data['events'] = $this->tpe_model->get_event($username, $id);
                        
            if ($data['events'] == null) {
                header("location:".base_url()."index.php/home/manage");
            }
            else {
                
                
                $data['departments'] = $this->tpe_model->get_departments($id);
                $data['reminders'] = $this->tpe_model->fetch_reminder_event($username, $id);
                $data['departments_progress'] = $this->tpe_model->get_department_progress($id);
                $data['id_passed'] = $id_pass;
                
                $this->notifications();
                $this->load->view('navbar');
                $this->load->view('event', $data);                
                $this->load->view('footer');
            }
            
            if ($this->input->post('save_details')) 
            {
                $data = array(
                    'id' => $id,
                    'name' =>  $this->input->post('e_name'),
                    'date' => $this->input->post('e_date'),
                    'time' => $this->input->post('e_time'),
                    'description' => $this->input->post('e_description')                  
                );
                $this->tpe_model->update_event_details($data);
                header("location:".base_url()."index.php/home/event/".$id_pass);
            }
            
            if ($this->input->post('add_reminder')) 
            {
                $data = array(
                    'event_id' => $id,
                    'reminder' =>  $this->input->post('reminder'),
                    'username' => $username                                
                );
                $this->tpe_model->add_reminder_event($data);
                header("location:".base_url()."index.php/home/event/".$id_pass);
            }
        }
        else 
        {
            header("location:".base_url()."index.php/home/login");
        }
    }
    
    public function delete_reminder($reminder_id, $id_pass)
    {
        $username = $_SESSION['username'];  
        $this->tpe_model->delete_reminder($reminder_id/23, $username);
        header("location:".base_url()."index.php/home/event/".$id_pass);
    }
    
    public function toggle_reminder() //set reminder on/off in profile
    {
        $data = $this->input->post();
        $user = $_SESSION['username'];
        $this->tpe_model->toggle_reminder($data['value'], $user);
        $_SESSION['reminder_toggle'] = $data['value'];
    }

    public function do_upload() //upload profile pic
    {
        $user = $_SESSION['username'];
        $config['upload_path']          = './images/propic';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['max_width']            = 1500;
        $config['max_height']           = 1500;

        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));         
        $config['file_name'] = $user;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('fileToUpload'))
        {
            echo $this->upload->display_errors();
        }
        else
        {
            $path = "images/propic/".$this->upload->data('file_name');
            $_SESSION['pic'] = $path;
            $this->tpe_model->update_pro_pic($path,$user);
            header("location:".base_url()."index.php/home/profile");

        }
    }
    
    
    public function do_pic_upload($id) // upload event picture
    {
        $pass_id = $id/23;        
        $config['upload_path']          = './images/events';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 500;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;
        $config['overwrite']            = TRUE;

        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));         
        $config['file_name'] = $pass_id;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('fileToUpload'))
        {
            echo $this->upload->display_errors();
        }
        else
        {
            $path = "images/events/".$this->upload->data('file_name');
            $this->tpe_model->update_event_pic($path, $pass_id);                    
            header("location:".base_url()."index.php/home/event/$id");


        }
    }
    
        public function delete_event($id)
        {
            $user = $_SESSION['username'];
            if ( $this->tpe_model->delete_event($id, $user) ){
                header("location:".base_url()."index.php/home/manage");
            }
        }
    
        public function departments($event_id) // det departments on or off
            {
                $real_id = $event_id/23;
                $data = array(
                    'event' => $real_id,
                    'finance' => $this->input->post('finance_toggle'),
                    'logistics' => $this->input->post('logistics_toggle'),
                    'decoration' => $this->input->post('decorations_toggle'),
                    'marketing' => $this->input->post('marketing_toggle'),
                    'registration' => $this->input->post('registration_toggle'),
                    'sales' => $this->input->post('sales_toggle')
                );
                $this->tpe_model->toggle_depts($data);
                header("location:".base_url()."index.php/home/event/$event_id");

        }
    
    //Finance Dept

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
            
            $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
            
                $exist = $this->tpe_model->get_departments($id);

                if ($exist['finance'] == null) {
                    header("location:".base_url()."index.php/home/event/$id_passed");                
                }


                $data['crew'] = $this->tpe_model->show_crew_finance($id);
                $data['tasks'] = $this->tpe_model->fetch_tasks_finance($id);
                $data['companies'] = $this->tpe_model->fetch_companies_finance($id);
                $data['income'] = $this->tpe_model->get_income_finance($id);
                $data['expenses'] = $this->tpe_model->get_expenses_finance($id);

                $data['id_passed'] = $id_passed;
                
                $this->notifications();
                $this->load->view('navbar');
                $this->load->view('finance', $data);                   
                $this->load->view('footer');   

                if ( $this->input->post('add_crew') )
                {
                    $crew_user = $this->input->post('user_crew');
                    $result = $this->tpe_model->add_crew_finance($id, $crew_user);
                    if ($result == "success"){
                        header("location:".base_url()."index.php/home/finance/$id_passed");                    
                    }
                    else {                   
                        echo "<script> alert('$result')</script>";
                    }

                }

                if ( $this->input->post('add_task') )
                {
                    $task = $this->input->post('tasks');
                    $this->tpe_model->add_task_finance($id, $task);
                    header("location:".base_url()."index.php/home/finance/$id_passed");
                }


                if ( $this->input->post('add_company') )
                {
                    $c_name = $this->input->post('c_name');
                    $c_address = $this->input->post('c_address');
                    $c_telephone = $this->input->post('c_telephone');
                    $c_email = $this->input->post('c_email');
                    $c_website = $this->input->post('c_website');
                    $this->tpe_model->add_company_finance($id, $c_name, $c_address, $c_telephone, $c_email, $c_website);
                    header("location:".base_url()."index.php/home/finance/$id_passed");
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
                    header("location:".base_url()."index.php/home/finance/$id_passed");
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
                    header("location:".base_url()."index.php/home/finance/$id_passed");
                }
            }
            else {header("location:".base_url()."index.php/home/manage"); }
            
        }
    
        public function check_finance() //check tasks of finance dept
        {
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $name = $_SESSION['username'];        
            $this->tpe_model->check_task_finance($id, $value, $name);
        }

          
        public function delete_task_finance($e, $t, $d)
        {
            $event = $e/23;
            $owner = $_SESSION['username'];
            $r = $this->tpe_model->delete_task_finance($event, $t, $d, $owner);
            if ($r == true) 
            {
                header("location:".base_url()."index.php/home/finance/$e");
            }
            else 
            {
                header("location:".base_url()."index.php/home/manage");
            }
            
        }
    
    
        public function delete_user_finance($e, $u)
            {
                $event = $e/23;
                $owner = $_SESSION['username'];
                $r = $this->tpe_model->delete_user_finance($event, $u, $owner);
                if ($r == true) 
                {
                    header("location:".base_url()."index.php/home/finance/$e");
                }
                else 
                {
                    header("location:".base_url()."index.php/home/manage");
                }

        }

        public function assigned_to_finance() //task assigning
        {
            $postData = $this->input->post();
            $split = explode("&",$postData['value']);            
            $task_id = ((int)$split[1])/23;   
            $user = $split[0];    
            $this->tpe_model->assigned_to_finance($task_id, $user);  
            
        }
    
        public function delete_company_finance($e, $c)
        {
            $event_id = $e/23;
            $company_id = $c/23;
            $this->tpe_model->delete_company_finance($event_id, $company_id);
            header("location:".base_url()."index.php/home/finance/$e"); 
            
        }
    
        public function delete_transaction_finance($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_finance($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/home/finance/$e"); 
            
        }
    
        
    
    
    
    //Logistics Dept
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
            
            $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
            
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['logistics'] == null) {
                header("location:".base_url()."index.php/home/event/$id_passed");                
            }
            
               
            $data['crew'] = $this->tpe_model->show_crew_logistics($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_logistics($id);
            $data['income'] = $this->tpe_model->get_income_logistics($id);
            $data['expenses'] = $this->tpe_model->get_expenses_logistics($id);
            $data['id_passed'] = $id_passed;
            
            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('logistics', $data);             
            $this->load->view('footer');   

            if ( $this->input->post('add_crew') )
            {
                $crew_user = $this->input->post('user_crew');
                $result = $this->tpe_model->add_crew_logistics($id, $crew_user);
                if ($result == "success"){
                    header("location:".base_url()."index.php/home/logistics/$id_passed");                    
                }
                else {                   
                    echo "<script> alert('$result')</script>";
                }
            }

            if ( $this->input->post('add_task') )
            {
                $task = $this->input->post('tasks');
                $this->tpe_model->add_task_logistics($id, $task);
                header("location:".base_url()."index.php/home/logistics/$id_passed");
            }
            
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
                header("location:".base_url()."index.php/home/logistics/$id_passed");
            }
            }
            else
            {
                header("location:".base_url()."index.php/home/manage");
            }
        }
    
        public function check_logistics() //check tasks of logistics
        {
            
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $name = $_SESSION['username'];        
            $this->tpe_model->check_task_logistics($id, $value, $name);
        }
    
        
    
        public function delete_task_logistics($e, $t, $d)
        {
            $event = $e/23;
            $owner = $_SESSION['username'];
            $r = $this->tpe_model->delete_task_logistics($event, $t, $d, $owner);
            if ($r == true) 
            {
                header("location:".base_url()."index.php/home/logistics/$e");
            }
            else 
            {
                header("location:".base_url()."index.php/home/manage");
            }
            
        }
    
    
        public function delete_user_logistics($e, $u)
            {
                $event = $e/23;
                $owner = $_SESSION['username'];
                $r = $this->tpe_model->delete_user_logistics($event, $u, $owner);
                if ($r == true) 
                {
                    header("location:".base_url()."index.php/home/logistics/$e");
                }
                else 
                {
                    header("location:".base_url()."index.php/home/manage");
                }

        }

        public function assigned_to_logistics() //task assigning in logistics
        {
            $postData = $this->input->post();
            $split = explode("&",$postData['value']);            
            $task_id = ((int)$split[1])/23;   
            $user = $split[0];    
            $this->tpe_model->assigned_to_logistics($task_id, $user); 
            
        }
    
        public function delete_transaction_logistics($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_logistics($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/home/logistics/$e"); 
            
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
            
            $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['decoration'] == null) {
                header("location:".base_url()."index.php/home/event/$id_passed");                
            }
            
            
            $data['crew'] = $this->tpe_model->show_crew_decorations($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_decorations($id);
            $data['income'] = $this->tpe_model->get_income_decorations($id);
            $data['expenses'] = $this->tpe_model->get_expenses_decorations($id);
            
            $data['id_passed'] = $id_passed;
            
            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('decorations', $data);             
            $this->load->view('footer');   

            if ( $this->input->post('add_crew') )
            {
                $crew_user = $this->input->post('user_crew');
                $result = $this->tpe_model->add_crew_decorations($id, $crew_user);
                if ($result == "success"){
                    header("location:".base_url()."index.php/home/decorations/$id_passed");                    
                }
                else {                   
                    echo "<script> alert('$result')</script>";
                }
            }

            if ( $this->input->post('add_task') )
            {
                $task = $this->input->post('tasks');
                $this->tpe_model->add_task_decorations($id, $task);
                header("location:".base_url()."index.php/home/decorations/$id_passed");
            }
            
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
                header("location:".base_url()."index.php/home/decorations/$id_passed");
            }
            }
            else {header("location:".base_url()."index.php/home/manage"); }
            
        }
    
        public function check_decorations() // check completion of tasks in decorations
        {
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $name = $_SESSION['username'];            
            $this->tpe_model->check_task_decorations($id, $value, $name);
        }
    
        
    
        public function delete_task_decorations($e, $t, $d)
        {
            $event = $e/23;
            $owner = $_SESSION['username'];
            $r = $this->tpe_model->delete_task_decorations($event, $t, $d, $owner);
            if ($r == true) 
            {
                header("location:".base_url()."index.php/home/decorations/$e");
            }
            else 
            {
                header("location:".base_url()."index.php/home/manage");
            }
            
        }
    
    
        public function delete_user_decorations($e, $u)
            {
                $event = $e/23;
                $owner = $_SESSION['username'];
                $r = $this->tpe_model->delete_user_decorations($event, $u, $owner);
                if ($r == true) 
                {
                    header("location:".base_url()."index.php/home/decorations/$e");
                }
                else 
                {
                    header("location:".base_url()."index.php/home/manage");
                }

        }

        public function assigned_to_decorations() // assigning tasks to user in deco dept
        {
            $postData = $this->input->post();
            $split = explode("&",$postData['value']);            
            $task_id = ((int)$split[1])/23;   
            $user = $split[0];    
            $this->tpe_model->assigned_to_decorations($task_id, $user);  
            
        }
    
        public function delete_transaction_decorations($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_decorations($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/home/decorations/$e"); 
            
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
            
            $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['marketing'] == null) {
                header("location:".base_url()."index.php/home/event/$id_passed");                  
            }
            
                
            $data['crew'] = $this->tpe_model->show_crew_marketing($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_marketing($id);
            $data['income'] = $this->tpe_model->get_income_marketing($id);
            $data['expenses'] = $this->tpe_model->get_expenses_marketing($id);
            $data['id_passed'] = $id_passed;
        
            $this->notifications();
            $this->load->view('navbar');
            $this->load->view('marketing', $data);              
            $this->load->view('footer');   

            if ( $this->input->post('add_crew') )
            {
                $crew_user = $this->input->post('user_crew');
                $result = $this->tpe_model->add_crew_marketing($id, $crew_user);
                if ($result == "success"){
                    header("location:".base_url()."index.php/home/marketing/$id_passed");                    
                }
                else {                   
                    echo "<script> alert('$result')</script>";
                }
            }

            if ( $this->input->post('add_task') )
            {
                $task = $this->input->post('tasks');
                $this->tpe_model->add_task_marketing($id, $task);
                header("location:".base_url()."index.php/home/marketing/$id_passed");
            }
        
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
                    header("location:".base_url()."index.php/home/marketing/$id_passed");
                }
                 }
            else {header("location:".base_url()."index.php/home/manage"); }
        }
    
        public function check_marketing() //check completion 
        {
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $name = $_SESSION['username'];        
            $this->tpe_model->check_task_marketing($id, $value, $name);
        }
    
        
    
        public function delete_task_marketing($e, $t, $d)
        {
            $event = $e/23;
            $owner = $_SESSION['username'];
            $r = $this->tpe_model->delete_task_marketing($event, $t, $d, $owner);
            if ($r == true) 
            {
                header("location:".base_url()."index.php/home/marketing/$e");
            }
            else 
            {
                header("location:".base_url()."index.php/home/manage");
            }
            
        }
    
    
        public function delete_user_marketing($e, $u)
            {
                $event = $e/23;
                $owner = $_SESSION['username'];
                $r = $this->tpe_model->delete_user_marketing($event, $u, $owner);
                if ($r == true) 
                {
                    header("location:".base_url()."index.php/home/marketing/$e");
                }
                else 
                {
                    header("location:".base_url()."index.php/home/manage");
                }

        }

        public function assigned_to_marketing() //assign people
        {
            $postData = $this->input->post();
            $split = explode("&",$postData['value']);            
            $task_id = ((int)$split[1])/23;   
            $user = $split[0];    
            $this->tpe_model->assigned_to_marketing($task_id, $user);  
            
        }
    
        public function delete_transaction_marketing($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_marketing($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/home/marketing/$e"); 
            
        }
    
    
    //Sales department
    
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
            
            $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['sales'] == null) {
                header("location:".base_url()."index.php/home/event/$id_passed");                
            }
            
               
            $data['crew'] = $this->tpe_model->show_crew_sales($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_sales($id);
            $data['income'] = $this->tpe_model->get_income_sales($id);
            $data['expenses'] = $this->tpe_model->get_expenses_sales($id);
            $data['id_passed'] = $id_passed;
            
            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('sales', $data);             
            $this->load->view('footer');   

            if ( $this->input->post('add_crew') )
            {
                $crew_user = $this->input->post('user_crew');
                $result = $this->tpe_model->add_crew_sales($id, $crew_user);
                if ($result == "success"){
                    header("location:".base_url()."index.php/home/sales/$id_passed");                    
                }
                else {                   
                    echo "<script> alert('$result')</script>";
                }
            }

            if ( $this->input->post('add_task') )
            {
                $task = $this->input->post('tasks');
                $this->tpe_model->add_task_sales($id, $task);
                header("location:".base_url()."index.php/home/sales/$id_passed");
            }
            
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
                header("location:".base_url()."index.php/home/sales/$id_passed");
            }
                }
            else {header("location:".base_url()."index.php/home/manage"); }
        }
    
    
        public function check_sales() //
        {
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $name = $_SESSION['username'];        
            $this->tpe_model->check_task_sales($id, $value, $name);
        }
    
        
    
        public function delete_task_sales($e, $t, $d)
        {
            $event = $e/23;
            $owner = $_SESSION['username'];
            $r = $this->tpe_model->delete_task_sales($event, $t, $d, $owner);
            if ($r == true) 
            {
                header("location:".base_url()."index.php/home/sales/$e");
            }
            else 
            {
                header("location:".base_url()."index.php/home/manage");
            }
            
        }
    
    
        public function delete_user_sales($e, $u)
            {
                $event = $e/23;
                $owner = $_SESSION['username'];
                $r = $this->tpe_model->delete_user_sales($event, $u, $owner);
                if ($r == true) 
                {
                    header("location:".base_url()."index.php/home/sales/$e");
                }
                else 
                {
                    header("location:".base_url()."index.php/home/manage");
                }

        }

        public function assigned_to_sales()
        {
            $postData = $this->input->post();
            $split = explode("&",$postData['value']);            
            $task_id = ((int)$split[1])/23;   
            $user = $split[0];    
            $this->tpe_model->assigned_to_sales($task_id, $user);  
            
        }
    
        public function delete_transaction_sales($e, $t, $type)
        {
            $event_id = $e/23;
            $transaction_id = $t/23;
            $this->tpe_model->delete_transaction_sales($event_id, $transaction_id, $type);
            header("location:".base_url()."index.php/home/sales/$e"); 
            
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
         
            $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
            
            $exist = $this->tpe_model->get_departments($id);
            
            if ($exist['registration'] == null) {
                header("location:".base_url()."index.php/home/event/$id_passed");                
            }
            
                  
            $info = $this->tpe_model->get_confirmed_registrations($id);
            $data['total'] = $info['total'];
            $data['confirmed'] = $info['confirmed'];            
            $data['crew'] = $this->tpe_model->show_crew_registrations($id);
            $data['tasks'] = $this->tpe_model->fetch_tasks_registrations($id);
            $data['id_passed'] = $id_passed;
         
            $this->notifications();
            $this->load->view('navbar'); 
            $this->load->view('registrations', $data);              
            $this->load->view('footer');   

            if ( $this->input->post('add_crew') )
            {
                $crew_user = $this->input->post('user_crew');
                $result = $this->tpe_model->add_crew_registrations($id, $crew_user);
                if ($result == "success"){
                    header("location:".base_url()."index.php/home/registrations/$id_passed");                    
                }
                else {                   
                    echo "<script> alert('$result')</script>";
                }
            }

            if ( $this->input->post('add_task') )
            {
                $task = $this->input->post('tasks');
                $this->tpe_model->add_task_registrations($id, $task);
                header("location:".base_url()."index.php/home/registrations/$id_passed");
            }
            }
            else {header("location:".base_url()."index.php/home/manage"); }
        }
    
        public function check_registrations()
        {
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $name = $_SESSION['username'];        
            $this->tpe_model->check_task_registrations($id, $value, $name);
        }       
    
        public function delete_task_registrations($e, $t, $d)
        {
            $event = $e/23;
            $owner = $_SESSION['username'];
            $r = $this->tpe_model->delete_task_registrations($event, $t, $d, $owner);
            if ($r == true) 
            {
                header("location:".base_url()."index.php/home/registrations/$e");
            }
            else 
            {
                header("location:".base_url()."index.php/home/manage");
            }
            
        }    
    
        public function delete_user_registrations($e, $u)
            {
                $event = $e/23;
                $owner = $_SESSION['username'];
                $r = $this->tpe_model->delete_user_registrations($event, $u, $owner);
                
                if ($r == true) 
                {
                    header("location:".base_url()."index.php/home/registrations/$e");
                }
                else 
                {
                    header("location:".base_url()."index.php/home/manage");
                }

        }
        public function assigned_to_registrations()
        {
            $postData = $this->input->post();
            $split = explode("&",$postData['value']);            
            $task_id = ((int)$split[1])/23;   
            $user = $split[0];    
            $this->tpe_model->assigned_to_registrations($task_id, $user);  
            
        }
    
        public function check_attendance_registrations()
        {
            $postData = $this->input->post();
            $id = $postData['id'];        
            $value = $postData['value'];        
            $this->tpe_model->check_attendance_registrations($id, $value);

        }
    
    
    ////////////////// RSVP //////////////////
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
        $data['events'] = $this->tpe_model->get_event($username, $id);
            if (!empty($data['events'])){
                
            $exist = $this->tpe_model->get_departments($id);
            if ($exist['registration'] == null) {
                header("location:".base_url()."index.php/home/event/$e");                
            }
            $info = $this->tpe_model->get_responses($id);
            $data['responses'] = $info['responses'];
            $data['current'] = $info['current'];
            $data['target'] = $this->tpe_model->get_target_rsvp($id);       
                 
            $data['id_passed'] = $e;         

            $this->notifications();
            $this->load->view('navbar');  
            $this->load->view('rsvp', $data);             
            $this->load->view('footer');    
            }
            else {header("location:".base_url()."index.php/home/manage"); }
     } 
    
    public function send_emails_rsvp() 
    {
        $emails = ($this->input->post())['emails'];                
        $array = explode("\n", trim($emails));
        $to = implode(", ", $array); 
        
        $id_passed = ($this->input->post())['id_passed'];
        $id = $id_passed/23;
        $event = $this->tpe_model->summary($id);
        $event['id_passed'] = $id_passed;
        $msg = $this->load->view('email_invite', $event, true);
        
        $this->email->from('thousandplusevents@gmail.com');
        $this->email->to($to);
        $this->email->subject('You Are Invited!');
        $this->email->message($msg);
        $this->email->send(); 
         
        return true;
        
    }
    
    public function send_confirm_emails_rsvp() 
    {
        $postData = $this->input->post();            
        $event_id = $postData['event_id']/23;          
        $emails = $this->tpe_model->get_confirm_emails($event_id); 
        $to = '';
        
        foreach($emails as $e)
        {
            $to = $to.$e['email'].",";
        }    
        
        $id_passed = ($this->input->post())['id_passed'];
        $id = $id_passed/23;
        $event = $this->tpe_model->summary($id);
        $event['id_passed'] = $id_passed;
        $msg = $this->load->view('email_confirm', $event, true);        
       
        $this->email->from('thousandplusevents@gmail.com');
        $this->email->to($to);   
        $this->email->subject('Your Registration is Confirmed!');
        $this->email->message($msg);
        $this->email->send(); 
         
        return true;
        
    }
    
    public function send_thankyou_emails_rsvp() 
    {
        $postData = $this->input->post();            
        $event_id = $postData['event_id']/23;          
        $emails = $this->tpe_model->get_thankyou_emails($event_id); 
        $to = '';
        
        foreach($emails as $e)
        {
            $to = $to.$e['email'].",";
        }      
        
        $event = $this->tpe_model->summary($event_id);
        $event['id_passed'] = $id_passed;
        $msg = $this->load->view('email_thankyou', $event, true);        

        $this->email->from('thousandplusevents@gmail.com');
        $this->email->to($to);   
        $this->email->subject('Thank You for Your Participation');
        $this->email->message($msg);
        $this->email->send(); 
         
        return true;
        
    }
    
    
    public function set_target_rsvp()
    {
        $target = ($this->input->post())['target'];
        $event_id = (($this->input->post())['event_id'])/23;
        $this->tpe_model->set_target_rsvp($target, $event_id);
        $this->tpe_model->test($event_id);
        return true;
        
    }
    
    public function check_confirmation_rsvp()
    {
        $postData = $this->input->post();
        $id = $postData['id'];        
        $value = $postData['value'];        
        $this->tpe_model->check_confirmation_rsvp($id, $value);
        
    }
    
    public function check_all_confirmation_rsvp()
    {
        $postData = $this->input->post();
        $id = $postData['event_id']/23;        
        $this->tpe_model->check_all_confirmation_rsvp($id);
        return true;
        
    }
    
    public function toggle_notifications()
    {
        $postData = $this->input->post();
        $value = $postData['value'];        
        if ($value == 1)
        {
            $_SESSION['reminder_toggle'] = 0;
        }
        else 
        {
            $_SESSION['reminder_toggle'] = 1;
        }
        return true;
    }
    
     public function mark_read()
    {
        $postData = $this->input->post();
        $value = $postData['value'];  
        
        if ($value == 1)
        {
            $username = $_SESSION['username'];
           
            $this->tpe_model->mark_read($username);
              
        }       
        return true;
    }
    
    public function notifications()
    {
        $user = $_SESSION['username'];          
        $data['reminders'] = $this->tpe_model->get_user_reminders($user);
        $data['notifications'] = $this->tpe_model->get_notifications($user);  
        $this->load->view('notifications',$data);       
    }
    
    function search_users()
    {   
        $name = $this->input->post('name');         
        $output = '<ul class="collection"><li class="collection-item">0 matches found</li></ul>';
        if($name != ''){
            $result = $this->tpe_model->search_users($name);
            $output = '<ul class="collection"><li class="collection-item">'.count($result).' matches found</li></ul>';
            $output = $output.'<ul class="collection">';
            foreach($result as $row){                
                $output = $output.'<li class="collection-item avatar">';
                $output = $output.'<img src="'.base_url().$row['pic'].'" alt="" class="circle">';
                $output = $output.'<span class="title"><b>'.$row['fname']." ".$row['lname'].'</b></span><br>';            
                $output = $output.'<span>'.$row['email'].'</span>';            
                $output = $output.'<hr><div class="right-align"><a href="'.base_url().'index.php/home/invite_user/'.($row['email']).'" class="btn blue waves-effect waves-light">Invite</a></div>';               
                $output = $output.'</li>';               
            }
            $output = $output.'</ul>';
            
           
        }
        echo $output;    
    }
    
    
    function check_username_exists()
    {   
        $name = $this->input->post('username');   
        $validate = $this->tpe_model->check_username_exists($name);
        if($validate == 0){
            echo 0;    
        }
        else 
        {
            echo 1;
        }
        
    }
    
    function check_email_exists()
    {   
        $email = $this->input->post('email');   
        $validate = $this->tpe_model->check_email_exists($email);
        if($validate == 0){
            echo 0;    
        }
        else 
        {
            echo 1;
        }
        
    }
    
    public function verify($user)
    {
        if($_SESSION['validated'] != 0)
        {
            header("location:".base_url()."index.php/home/logout");   
        }
        $data["username"] = $user;
        $this->load->view('verify', $data);
    }
    
    public function resend_verification_email()
    {
        $user = $this->input->post('username');   
        $validate_code = rand(100000,999999);
        $email = $this->tpe_model->resend_verification_email($user, $validate_code);
        
        //Resend verification email
        $data['validate_code'] = $validate_code;
        $msg = $this->load->view('email_validate', $data, true);
        $this->email->from('thousandplusevents@gmail.com');
        $this->email->to($email);   
        $this->email->subject('Verify your Email - Thousand Plus Events');
        $this->email->message($msg);
        $this->email->send(); 
    }
    
    public function verify_email()
    {
        $user = $this->input->post('username');   
        $code = $this->input->post('code'); 
        $result = $this->tpe_model->verify_email($user, $code);      
        
        echo $result;
    }
    
    public function verification_success($user, $code)
    {
        $details = $this->tpe_model->get_name($user); 
        if ($details['validate_code'] == $code && $details['validated'] == 1)
        {
            $_SESSION['username'] = $user;
            header("location:".base_url()."index.php/home/login");   
        }
        else
        {
            header("location:".base_url()."index.php/home/logout");   
        }
        
    }
    
    public function login_check()
    {
        $user = $this->input->post('user');   
        $pass = $this->input->post('pass'); 
        
        $result = $this->tpe_model->login_check($user, md5($pass));        
        if($result == 1)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    
    public function i($id_passed)
    {
        $id = $id_passed/23;
        $event = $this->tpe_model->summary($id);
        $event['id_passed'] = $id_passed;
        $this->load->view('email_validate', $event);
    }
    
    function messages()
    {
        if (isset($_SESSION['username']))
        {
            $user = $_SESSION['username'];
            $data['chat_list'] = $this->tpe_model->get_chat_list($user);

            $this->notifications();
            $this->load->view('navbar');        
            $this->load->view('messages', $data);   
        }
        else            
        {
            header("location:".base_url()."index.php/home/login");   
        }
        
    }
    
    function get_chat_history()
    {
        $other_user = $this->input->post()['username'];   
        $user = $_SESSION['username'];
        $history = $this->tpe_model->get_chat_history($user, $other_user);
        
        $output = '';
        foreach($history as $h)
        {
            if($h['user_from'] == $user)
            {
                $output = $output.'<div class="outgoing_msg">';
                $output = $output.'<div class="sent_msg">';
                $output = $output.'<p>'.$h['message'].'</p>';
                $output = $output.'<span class="time_date">'. date('h:i A', strtotime($h['time'] )) .' | '.date('d M Y', strtotime($h['date'] )).'</span></div></div>';    
            }
            else
            {
                $output = $output.'<div class="incoming_msg">';              
                $output = $output.'<div class="received_msg">';
                $output = $output.'<div class="received_withd_msg">';
                $output = $output.'<p>'.$h['message'].'</p>';
                $output = $output.'<span class="time_date">'. date('h:i A', strtotime($h['time'] )) .' | '.date('d M Y', strtotime($h['date'] )).'</span></div></div></div>';
            }
        }
        echo $output;
        
        
    }
    
    
    function insert_chat()
    {
        date_default_timezone_set("Asia/Colombo");
        $to = $this->input->post()['to']; 
        $msg = $this->input->post()['msg'];       
        $data = array(
            'user_from' => $_SESSION['username'],
            'user_to' => $to,
            'message' => $msg,
            'date' => date("Y-m-d"),
            'time' => date("H:i:s"),
            'msg_read' => 0,
            'seen' => 0,
        );
        $this->tpe_model->insert_chat($data);
        
        $output = '';
        $output = $output.'<div class="outgoing_msg">';
        $output = $output.'<div class="sent_msg">';
        $output = $output.'<p>'.$data['message'].'</p>';
        $output = $output.'<span class="time_date">'. date('h:i A', strtotime($data['time'] )) .' | '.date('d M Y', strtotime($data['date'] )).'</span></div></div>';  
        echo $output;
    }
    
    
    function update_chat_people()
    {
        $user = $_SESSION['username'];
        $chat_list = $this->tpe_model->get_chat_list($user);
        $output = '';
        foreach($chat_list as $list) { 
            $output = $output.'<a href="#!" name="'.$list['username'].'" class="people">'; 
            $output = $output.'<div class="chat_list" id="'.$list['username'].'">';
            $output = $output.'<div class="chat_people">';
            $output = $output.'<div class="chat_img"><img src="'.base_url().$list['pic'].'" alt="pic" class="circle"></div>
                    <div class="chat_ib">              
                      <h5 >'.$list['fname'].' '.$list['lname'].'<span class="chat_date">'.date('h:i A', strtotime($list['time'] )).' | '. date('d M Y', strtotime($list['date'] )).'</span></h5>';
           $output = $output.'<p style="font-weight:bold;">'.$list['message'].'</p>
                    </div>
                  </div>
                </div>
            </a>';
        }
        echo $output;
    }
    
    

   
    
    
    
    
    
    
   
}

?>
