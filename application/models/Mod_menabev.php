<?php
class mod_menabev extends CI_Model {
	
	function __construct(){
		
        parent::__construct();

    }
  
 function add_user($data){
  extract($data);
      if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/profile_pic/';
            $config['allowed_types'] = '*';
            $new_name = time();
            $config['file_name'] = $new_name;
            // var_dump($config['upload_path']);exit;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->initialize($config));exit;

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                echo $error;
                exit;
            } else {
                $uploadData = $this->upload->data();
                $file = $uploadData['file_name'];
            }
        }else{
            $file=$old_image;
        } 
    $ins_data = array(
       'name' => $this->db->escape_str(trim($name)),
       'phone_no' => $this->db->escape_str(trim($phone_no)),
       'email' => $this->db->escape_str(trim($email)),
       'address' => $this->db->escape_str(trim($address)),
       'username' => $this->db->escape_str(trim($username)),
       'password' => $this->db->escape_str(trim(md5($password))),
       'image_url' => $this->db->escape_str(trim(SURL."uploads/profile_pic/".$file)),
       'image_name' => $this->db->escape_str(trim($file)), 
    );
                            //var_dump($insert_data);
        $this->db->dbprefix('users');
        $ins_into_db = $this->db->insert('users', $ins_data);
        if($ins_into_db){
          return TRUE;
        }else{
          return FALSE;
        }

 } function edit_user($data){
  extract($data);
      if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/profile_pic/';
            $config['allowed_types'] = '*';
           $new_name = time();
            $config['file_name'] = $new_name;
            // var_dump($config['upload_path']);exit;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->initialize($config));exit;

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                echo $error;
                exit;
            } else {
                $uploadData = $this->upload->data();
                $file = $uploadData['file_name'];
            }
        }else{
            $file=$old_image;
        } 
    $ins_data = array(
      'name' => $this->db->escape_str(trim($name)),
       'phone_no' => $this->db->escape_str(trim($phone_no)),
       'email' => $this->db->escape_str(trim($email)),
       'address' => $this->db->escape_str(trim($address)),
       'username' => $this->db->escape_str(trim($username)),
       'password' => $this->db->escape_str(trim(md5($password))),
       'image_url' => $this->db->escape_str(trim(SURL."uploads/profile_pic/".$file)),
       'image_name' => $this->db->escape_str(trim($file)), 
    );
                            // var_dump($ins_data);exit;
        $this->db->dbprefix('users');
        $this->db->where('id',$id);
        $ins_into_db = $this->db->update('users', $ins_data);
        if($ins_into_db){
          return TRUE;
        }else{
          return FALSE;
        }

 }
   function delete_user($id){

         $this->db->trans_start();
        $this->db->query("DELETE FROM users WHERE id='$id';");
        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
            return FALSE;
       }else{
           return TRUE;
       }
  }   function delete_consignment($id){

         $this->db->trans_start();
        $this->db->query("DELETE FROM consignments WHERE id='$id';");
        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
            return FALSE;
       }else{
           return TRUE;
       }
  }
 


  

}