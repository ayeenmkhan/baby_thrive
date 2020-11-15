<?php
class mod_common extends CI_Model {
        
    var $config;
	function __construct(){
		
        parent::__construct();
           

    }
    public function get_alerts(){
        //var_dump($this->session->all_userdata());exit;
        $this->db->dbprefix('notification');
		$this->db->select('*');
	  	$this->db->where('status','0');
	  	$this->db->where('to_id',$this->session->userdata('user_role')['role_id']);
	  	//$this->db->or_where('user_id',$this->session->userdata('user_id'));
		$this->db->order_by("id", "DESC");
		//$this->db->limit($limit,$id);
		
		//$this->db->limit($limit,$id);
		
		$get_all_log = $this->db->get('notification');
		//var_dump($this->db->last_query());exit;
		
		return $get_all_log->result_array();
    }
    public function get_notification(){
        //var_dump($this->session->all_userdata());exit;
        $this->db->dbprefix('interview_notification');
		$this->db->select('*');
	  	$this->db->where('status','0');
	  	//$this->db->where('to_id',$this->session->userdata('user_role')['role_id']);
	  	$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->order_by("id", "DESC");
		//$this->db->limit($limit,$id);
		
		//$this->db->limit($limit,$id);
		
		$get_all_log = $this->db->get('interview_notification');
		//var_dump($this->db->last_query());exit;
		
		return $get_all_log->result_array();
    }
        public function update_assessment($data){
        extract($data);
        //var_dump($_POST);exit;
                $created_date = date('Y-m-d G:i:s');
		$ip_address = $this->input->ip_address();
		$created_by = $this->session->userdata('user_id');
                //$sta=$this->input->post('status');
           $this->db->trans_start();    
           

            //Check whether user upload picture
            if (!empty($_FILES['assessment_file']['name'])) {

                $config['upload_path'] = './uploads/documents/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
                $config['file_name'] = $_FILES['assessment_file']['name'];
                // var_dump($config['upload_path']);exit;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // var_dump($this->upload->initialize($config));exit;

                if (!$this->upload->do_upload('assessment_file')) {
                    $error = $this->upload->display_errors();

                    echo $error;
                } else {
                    $uploadData = $this->upload->data();
                    $rep = $uploadData['file_name'];
                }
            } else {
                $rep = '';
            }
              if (!empty($_FILES['approval_file']['name'])) {

                $config['upload_path'] = './uploads/documents/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['approval_file']['name'];
                // var_dump($config['upload_path']);exit;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // var_dump($this->upload->initialize($config));exit;

                if (!$this->upload->do_upload('approval_file')) {
                    $error = $this->upload->display_errors();

                    echo $error;
                } else {
                    $uploadData = $this->upload->data();
                    $report = $uploadData['file_name'];
                }
            } else {
                $report = '';
            }
            //var_dump($cv);exit;
            //Prepare array of user dat
                
         $ins_data = array(
		   'title' => $this->db->escape_str(trim($title)),
		   'ceo_comments' => $this->db->escape_str(trim($comments)),
		   'assessment_report' => $this->db->escape_str(trim($rep)),
		   'approval_report' => $this->db->escape_str(trim($report)),
		   'assessment_path' => SURL . "uploads/documents/",
		   'status' => $this->db->escape_str(trim($ceo_feed)),
                   'modified_date' => $this->db->escape_str(trim($created_date)),
		   'modified_by' => $this->db->escape_str(trim($created_by)),
		   'approved_by' => $this->db->escape_str(trim($created_by)),
		
		);
              //var_dump($ins_data);exit;
                 $this->db->dbprefix('interview_assessment');
		$this->db->where('applicant_id',$this->db->escape_str(trim($appli_id)));
                 $ins_into_db = $this->db->update('interview_assessment', $ins_data);
	
		//var_dump($this->db->last_query());exit;
                 $insert_data = array(
		   'status' =>5,
		  // 'job_title' => $this->db->escape_str(trim($job_name)),
		);
		//echo '<pre>';print_r($insert_data);exit;
      
		//Insert the record into the database.
		$this->db->dbprefix('careers');
                $this->db->where('id',$appli_id);
		$ins_into_db = $this->db->update('careers', $insert_data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
    # Something went wrong.
                 $this->db->trans_rollback();
                 return FALSE;
} else{
		
	 return true;

	}
		//if($ins_into_db) return true;
        
    

   	
    }
    public function add_qualification(){
        //var_dump($_POST);exit;
        $title=$this->input->post('title');
         $ins_data = array(
		   'qualification_name' => $this->db->escape_str(trim($title)),
		
		);
              //var_dump($ins_data);exit;
                 $this->db->dbprefix('qualification');
                 $ins_into_db = $this->db->insert('qualification', $ins_data);
                 if($ins_into_db){
                     return TRUE;
                 }else{
                     return FALSE;
                 }
    } 
    public function edit_qualification($id){
              $this->db->dbprefix('qualification');
		$this->db->select('*');
		$this->db->where("id", $id);
		//$this->db->limit($limit,$id);
		
		//$this->db->limit($limit,$id);
		
		$get_all_qua = $this->db->get('qualification');
		
		
		return $get_all_qua->row_array();
        
    }
    public function edit_qualification_process(){
         $title=$this->input->post('title');
         $id=$this->input->post('id');
         $ins_data = array(
		   'qualification_name' => $this->db->escape_str(trim($title)),
		
		);
              //var_dump($ins_data);exit;
                 $this->db->dbprefix('qualification');
                 $this->db->where('id',$id);
                 $ins_into_db = $this->db->update('qualification', $ins_data);
                 if($ins_into_db){
                     return TRUE;
                 }else{
                     return FALSE;
                 }
        
    }
    public function del_qualification_record($id){
       
        $this->db->trans_start();
        $this->db->query("DELETE FROM im_qualification WHERE id='$id';");
        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
            return FALSE;
       }else{
           return TRUE;
       }
    }
    

    public function get_qualification(){
            $this->db->dbprefix('qualification');
		$this->db->select('*');
		//$this->db->order_by("id", "DESC");
		//$this->db->limit($limit,$id);
		
		//$this->db->limit($limit,$id);
		
		$get_all_qua = $this->db->get('qualification');
		
		
		return $get_all_qua->result_array();
    }

    public function get_approval_form($id){
            $this->db->dbprefix('hiring_approval');
		$this->db->select('*');
		$this->db->where("applicant_id",$id);
		//$this->db->limit($limit,$id);
		
		//$this->db->limit($limit,$id);
		
		$get_all_qua = $this->db->get('hiring_approval');
		
		
		return $get_all_qua->row_array();
    }
    public function getApprover(){
            $this->db->dbprefix('user_basic_detail');
		$this->db->select('*');
		
		$get_all_qua = $this->db->get('user_basic_detail');
		
		
		return $get_all_qua->result_array();
    }
    public function getDepartment(){
            $this->db->dbprefix('department');
		$this->db->select('*');
                $get_all_qua = $this->db->get('department');
		
		
		return $get_all_qua->result_array();
    }
    public function getProjects(){
            $this->db->dbprefix('projects');
		$this->db->select('*');
		
		$get_all_qua = $this->db->get('projects');
		
		
		return $get_all_qua->result_array();
    }
    
}
?>