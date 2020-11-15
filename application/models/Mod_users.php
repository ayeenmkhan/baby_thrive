<?php

class Mod_users extends CI_Model {

	

	function __construct(){

		

        parent::__construct();



    }



	public function get_users($limit,$id){

		

				

		$this->db->dbprefix('users');

		$this->db->select('*');

	  

		$this->db->limit($limit,$id);

		

		$get_all_users = $this->db->get('users');

		

		

		return $get_all_users->result_array();

		

	}

	

	

	

	public function update_password(){

		

	$id=$this->session->userdata('user_id');

		extract($this->input->post());

		

		  $oldpassword=md5($old_password);

		 $newpassword=md5($new_password);

 	   



		$query="select * from crm_users where password='".$oldpassword."'";

		$get_all_users=$this->db->query($query);

		

		 

	  $get_all_users=$get_all_users->result_array();

	/*  echo "<pre>";print_r($get_all_users);

	exit;*/

	  if(!empty($get_all_users)){

	 //echo "<pre>";print_r($get_all_users);

	  $query="update crm_users set password='".$newpassword."' where id='".$id."'";

	  $get_all_users=$this->db->query($query);

	  return true;

	  }

	  else{

	   return false;

	  }

		

		

	}

	

	

	

	

	public function get_all_users(){

		

		

		$this->db->dbprefix('users');

		

		$this->db->select('users.*, user_roles.name as user_type');



		$this->db->order_by('user_roles.id');		



		$this->db->join('user_roles', 'users.type = user_roles.id');



		$get_all_users = $this->db->get('users');



		// echo "<pre>";



		// print_r($get_all_users->result_array());



		// exit;

		

		return $get_all_users->result_array();

		

	}	

	

	

	

	public function num_users(){

		$this->db->dbprefix('users');

		$this->db->select('id');

		

		

		$query = $this->db->get('users');

		

		return $query->num_rows();

		

	}

	

	

	

	

		public function sub_users(){

		$this->db->dbprefix('user_roles');

		$this->db->select('*');

		

		

		$query = $this->db->get('user_roles');

		

		return $query->result_array();

		

	}

	

		

    public function get_roles($user_id){

	

        $query = $this->db->query("SELECT p.* FROM `im_user_roles` ur, im_role_permission rp,im_permissions p"

                . " WHERE ur.`user_id`=rp.`user_id` AND rp.permission_id=p.permission_id"

                . " AND ur.`user_id`='".$user_id."'");

       // $this->db->last_query($query);exit;

        return $query->result();

	

	}

    public function get_user_roles($user_id){

	

        $query = $this->db->query("SELECT * FROM `im_user_roles` WHERE `user_id`='".$user_id."'");

       // $this->db->last_query($query);exit;

        return $query->row_array();

	

	}

	

	//user login function

	public function userCheck(){

		//echo "asdS";exit;

		// print_r($this->input->post());exit;

		extract($this->input->post());

		$password = md5($password);



		$this->db->dbprefix('users');

		$this->db->where('username',$username);

		$this->db->where('password',$password);		

		$get_user = $this->db->get('users');

		// var_dump($this->db->last_query());exit;

	

		if(count($get_user->row_array()) > 0)
		{

                $user = $get_user->row_array();
                $time=time();
                $newdata = array(

                   'user_id'  	=> $user['id'],
                   'user_type'  	=> $user['user_type'],
                   'employee_id'  	=> $user['employee_id'],
                   'cc_id'  	=> $user['cc_id'],
                   'login_time'  	=> $time,
      
               );     
			$this->session->set_userdata($newdata);       
			return $get_user->row_array();	


		}	

		else

		{

			//$extra='';

			//return $extra;

			return false;



		}	

		

	}//user login function ends here 

	



	

	//add user function starts here

	public function add_user($data){

		

		extract($data);

		

		// echo "<pre>";



		// print_r($_POST);



		// echo $_FILES['profile_image']['name'];



		// exit;

		

		$created_date = date('Y-m-d G:i:s');

		$ip_address = $this->input->ip_address();

		$created_by = 0;//$this->session->userdata('admin_id');



		if($_FILES['profile_image']['name'] != ''){



			//Create User Directory if not exist

			$folder_path = './assets/profile_images/';

	

			$file_ext = ltrim(strtolower(strrchr($_FILES['profile_image']['name'],'.')),'.'); 			

			$file_name = 'profileImage-'.date('YmdGis').'.jpg';



			$config['upload_path'] = $folder_path;

			$config['allowed_types'] = 'jpg|jpeg|gif|tiff|png';

			$config['max_size']	= '6000';

			$config['overwrite'] = true;

			$config['file_name'] = $file_name;

			$config['quality'] = '100%';

		

			$this->load->library('upload', $config);



			if(!$this->upload->do_upload('profile_image')){



				$error_file_arr = array('error' => $this->upload->display_errors());

				

			}else{



				$data_image_upload = array('upload_image_data' => $this->upload->data());

				

				//Resize the Uploaded Image 800 * 600

				$config_profile['image_library'] = 'gd2';

				$config_profile['source_image'] = $folder_path.'/'.$file_name;

				$config_profile['create_thumb'] = TRUE;

				$config_profile['thumb_marker'] = '';

				

				$config_profile['maintain_ratio'] = TRUE;

				$config_profile['width'] = 1000;

				$config_profile['height'] = 1000;

				$config_profile['quality'] = '100%';

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($config_profile);

				$this->image_lib->resize();

				$this->image_lib->clear();



				//Creating Thumbmail 28 * 28

				//Uploading is successful now resizing the uploaded image 

				$config_profile['image_library'] = 'gd2';

				$config_profile['source_image'] = $folder_path.'/'.$file_name;

				$config_profile['new_image'] = $folder_path.'/thumb/'.$file_name;

				$config_profile['create_thumb'] = TRUE;

				$config_profile['thumb_marker'] = '';

				

				$config_profile['maintain_ratio'] = TRUE;

				$config_profile['width'] = 69;

				$config_profile['height'] = 69;

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($config_profile);

				$this->image_lib->resize();

				$this->image_lib->clear();

				

			}//end if(!$this->upload->do_upload('prof_image'))





		}//end if($_FILES['image']['name'] != '')



		$password = md5($password);



		$ins_data = array(

		   'first_name' => $this->db->escape_str(trim($first_name)),

		   'last_name' => $this->db->escape_str(trim($last_name)),

		   'email' => $this->db->escape_str(trim(nl2br($email))),

		   'password' => $this->db->escape_str(trim($password)),

		   'address' => $this->db->escape_str(trim($address)),

		   'phone_no' => $this->db->escape_str(trim($phone_no)),

		   'mobile_no' => $this->db->escape_str(trim($mobile_no)),

		   'image' => $this->db->escape_str(trim($file_name)),		   

		   'created_by' => $this->db->escape_str(trim($created_by)),

		   'ip_address' => $this->db->escape_str(trim($ip_address)),

		   'created_date' => $this->db->escape_str(trim($created_date)),

		   'type' => $this->db->escape_str(trim($type)),

		   'status' => 1,		   		   

		);

      

		//Insert the record into the database.

		$this->db->dbprefix('users');

		$ins_into_db = $this->db->insert('users', $ins_data);

	

		echo $this->db->last_query();



		if($ins_into_db) return true;



	}//end add_new_user()

	

	

	

	//Get user Record by ID

	public function edit_user($id){

	

		$this->db->dbprefix('bir');

		$this->db->where('id',$id);

		$get_user = $this->db->get('users');

	    //echo $this->db->last_query(); exit;

		return $get_user->row_array();

		

	}//end get_stages

	

	

	



//user update fumction is here 

public function update_user($data){

		

		extract($data);

		

	    // echo "<pre>";



		//print_r($_POST); exit;



		// echo $_FILES['profile_image']['name'];



		// exit;



		if($_FILES['profile_image']['name'] != ''){



			//Create User Directory if not exist

			$folder_path = './assets/profile_images/';

	

			$file_ext = ltrim(strtolower(strrchr($_FILES['profile_image']['name'],'.')),'.'); 			

			$file_name = 'profileImage-'.date('YmdGis').'.jpg';



			$config['upload_path'] = $folder_path;

			$config['allowed_types'] = 'jpg|jpeg|gif|tiff|png';

			$config['max_size']	= '6000';

			$config['overwrite'] = true;

			$config['file_name'] = $file_name;

			$config['quality'] = '100%';

		

			$this->load->library('upload', $config);



			if(!$this->upload->do_upload('profile_image')){



				$error_file_arr = array('error' => $this->upload->display_errors());

				

			}else{



				$data_image_upload = array('upload_image_data' => $this->upload->data());

				

				//Resize the Uploaded Image 800 * 600

				$config_profile['image_library'] = 'gd2';

				$config_profile['source_image'] = $folder_path.'/'.$file_name;

				$config_profile['create_thumb'] = TRUE;

				$config_profile['thumb_marker'] = '';

				

				$config_profile['maintain_ratio'] = TRUE;

				$config_profile['width'] = 1000;

				$config_profile['height'] = 1000;

				$config_profile['quality'] = '100%';

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($config_profile);

				$this->image_lib->resize();

				$this->image_lib->clear();



				//Creating Thumbmail 28 * 28

				//Uploading is successful now resizing the uploaded image 

				$config_profile['image_library'] = 'gd2';

				$config_profile['source_image'] = $folder_path.'/'.$file_name;

				$config_profile['new_image'] = $folder_path.'/thumb/'.$file_name;

				$config_profile['create_thumb'] = TRUE;

				$config_profile['thumb_marker'] = '';

				

				$config_profile['maintain_ratio'] = TRUE;

				$config_profile['width'] = 230;

				$config_profile['height'] = 150;

				

				$this->load->library('image_lib');

				$this->image_lib->initialize($config_profile);

				$this->image_lib->resize();

				$this->image_lib->clear();

				

			}//end if(!$this->upload->do_upload('prof_image'))





		}//end if($_FILES['image']['name'] != '')



		

 		if(!$file_name==''){

			

		$this->db->select('image');

		$this->db->where('id',$id);

		$get_user = $this->db->get('users');

	    //echo $this->db->last_query(); exit;

		 $user_old_image=$get_user->row_array();

		 

		// echo "<pre>";print_r($get_user); exit;

		 

		$user_folder_path='./assets/profile_images/thumb/';

		

	

	

			//Delete Existing Image

			if(file_exists($user_folder_path.$user_old_image['image'])){

	           

			  // 	echo $user_folder_path.'/'.$user_old_image['image']; exit;

			   			

				unlink($folder_path.$user_old_image['image']);

				unlink($user_folder_path.$user_old_image['image']);

			}	

			

			

			

				

		$update_data = array(

		   'first_name' => $this->db->escape_str(trim($first_name)),

		   'last_name' => $this->db->escape_str(trim($last_name)),

		   'email' => $this->db->escape_str(trim(nl2br($email))),

		   'address' => $this->db->escape_str(trim($address)),

		   'phone_no' => $this->db->escape_str(trim($phone_no)),

		   'mobile_no' => $this->db->escape_str(trim($mobile_no)),

		   'image' => $this->db->escape_str(trim($file_name)),		   

		   'type' => $this->db->escape_str(trim($type)),

		   'status' => 1,		   		   

		);

		}

		else{

			

			$update_data = array(

		   'first_name' => $this->db->escape_str(trim($first_name)),

		   'last_name' => $this->db->escape_str(trim($last_name)),

		   'email' => $this->db->escape_str(trim(nl2br($email))),

		   'address' => $this->db->escape_str(trim($address)),

		   'phone_no' => $this->db->escape_str(trim($phone_no)),

		   'mobile_no' => $this->db->escape_str(trim($mobile_no)),		   

		   'type' => $this->db->escape_str(trim($type)),

		   'status' => 1,		   		   

		);

			

			

			}

		

		

		//update the record into the database.

		$this->db->dbprefix('users');

		$this->db->where('id',$id);

		$upd_into_db = $this->db->update('users', $update_data);

		//echo $this->db->last_query(); exit;

         if($upd_into_db) return true;

		



	}//end update finction

	

	public function add_note($data,$id,$table_name){

	$this->db->dbprefix($table_name);

		$this->db->where('id',$id);

		$upd_into_db = $this->db->update($table_name, $data);

		//echo $this->db->last_query(); exit;

         if($upd_into_db) return true;

	}

	

	

	





	//Delete user

	public function delete_user($id,$image){

$folder_path ='./assets/profile_images';

 $user_folder_path='./assets/profile_images/thumb/';

		

	

	

			//Delete Existing Image

		

	           

			  // 	echo $user_folder_path.'/'.$user_old_image['image']; exit;

			   		echo $user_folder_path.$image;	

				unlink($folder_path.'/'.$image);

				unlink($user_folder_path.$image);

		

		$this->db->dbprefix('users');

		$this->db->where('id',$id);

		$del_into_db = $this->db->delete('users');

		//$this->db->last_query();

	

		if($del_into_db) return true;



	}//public function delete_user


	

	

}

?>