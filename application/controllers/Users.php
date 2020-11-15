<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller {

	function __construct(){
		// Call the Model constructor
		parent::__construct();
		
		$this->load->library('session');
		
		$this->load->model('mod_users');

	
		
	    $this->load->library('pagination');

				if($this->session->userdata('user_id') != TRUE){

		 		redirect(SURL);
		
		 }
	}
       //manage user function starts here 
	public function manage_users($variant=0){
	//echo "asd";exit;
		$users = $this->mod_users->num_users();
		//print_r($users);
		$config["base_url"] = base_url() . "users/manage_users/";
		$config['total_rows'] = $users;
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
			
		
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		
		$this->pagination->initialize($config);
	
		$data['users'] = $this->mod_users->get_users($config['per_page'], $variant);
		

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);

		$data['sidebar'] = $this->load->view('common/sidebar', '', TRUE);
		


		$this->load->view('users/manage_users', $data);

	}// mange user function ends  here 
	

	public function add_user(){

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);

		$data['sidebar'] = $this->load->view('common/sidebar', '', TRUE);


		
		$data['sub_users'] = $this->mod_users->sub_users();
        
		$this->load->view('users/add_user', $data);


	}
	
	public function change_password(){

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);

		$data['sidebar'] = $this->load->view('common/sidebar', '', TRUE);

		$this->load->view('users/change_password', $data);


	}
	
	public function update_password(){
/*print_r($this->input->post());
exit;*/
		$upd_data=$this->mod_users->update_password();
	if($upd_data){
				
				$this->session->set_flashdata('ok_message', '- Password  Updated successfully.');
				redirect(base_url().'users/change_password');
				
				}else{
				$this->session->set_flashdata('err_message', '- Password not Updated. Something went wrong, please try again.');
					redirect(base_url().'users/change_password');
				
				}//end if($add_cms_page)




	}
	
//add user process
	public function add_user_process(){

		$this->mod_users->add_user($this->input->post());

		redirect(SURL.'users/manage_users');

	}//add user process function ends here
	
	
		// edit user function
			public function edit_user($id){


			$data['user'] = $this->mod_users->edit_user($id);
	//print_r($data['user']);
			$data['header'] = $this->load->view('common/header', '', TRUE);
	
			$data['footer'] = $this->load->view('common/footer', '', TRUE);
	
			$data['sidebar'] = $this->load->view('common/sidebar', '', TRUE);
	
			$this->load->view('users/editUser', $data);

	}//edit user function ends here..
	
	//update user
		public function update_user_process(){
	

		$this->mod_users->update_user($this->input->post());

		redirect(SURL.'users/manage_users');

	}//user update ends here
	
		
	//function is for dellete user 
	public function delete_user($id,$image)
	{

		$this->mod_users->delete_user($id,$image);

		redirect(SURL.'users/manage_users');

	}
	


	public function logout_user(){

		$this->session->sess_destroy();

		redirect(SURL);
	}	

}