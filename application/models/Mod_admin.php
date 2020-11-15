<?php
class mod_admin extends CI_Model {
	
	function __construct(){
		
        parent::__construct();

    }

public function import_employees(){
  
        if (!empty($_FILES['import_file']['name'])) {
            $config['upload_path'] = './uploads/users/';
            $config['allowed_types'] = '*';
            $config['file_name'] = "csv_import_" . $_FILES['import_file']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->initialize($config));exit;

            if (!$this->upload->do_upload('import_file')) {
                $error = $this->upload->display_errors();

                echo $error;
                exit;
            } else {
                $uploadData = $this->upload->data();
                $file = $uploadData['file_name'];
                $file_path = './uploads/users/' . $file;
                //var_dump($file_path);exit;
                if ($this->csvimport->get_array($file_path)) {
                    //var_dump($this->csvimport->get_array($file_path));
                    $csv_array = $this->csvimport->get_array($file_path);
//                var_dump($csv_array);exit;
                    $this->db->trans_start();
                    foreach ($csv_array as $row) {
                      $check= $this->db->query("SELECT * FROM (employees) where epi='".$row['Employee ID']."'");
                       $result= $check->row_array();
                          if(count($result)==0){   
                             $ins_data = array(
                               'epi' => $this->db->escape_str(trim($row['Employee ID'])),
                               'name' => $this->db->escape_str(trim($row['Name'])),
                               'zone' => $this->db->escape_str(trim($row['Zone'])),
                               'department' => $this->db->escape_str(trim($row['Department'])),
                               'phone_no' => $this->db->escape_str(trim($row['Phone no'])),
                               'email_id' => $this->db->escape_str(trim($row['Email ID'])),
                            );
                            //var_dump($insert_data);
                            $this->db->dbprefix('employees');
                            $ins_into_db = $this->db->insert('employees', $ins_data);
                            $user_id=$this->db->insert_id();

                            $user_data= array(
                               'employee_id' => $this->db->escape_str(trim($user_id)),
                               'username' => $this->db->escape_str(trim($row['Employee ID'])),
                               'password' => $this->db->escape_str(trim(md5(123456))),
                               'rainbow' => $this->db->escape_str(trim(123456)),
                               'user_type' => 4,
                            );
                            
                            $this->db->dbprefix('users');
                            $ins_into_db = $this->db->insert('users', $user_data);
                    }
                  }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();
                        return FALSE;
                    } else {

                        return true;

                    }

                }
            }

        } else {
            $file = '';
        }

}

public function add_video($data){
  extract($data);
  // var_dump($_FILES);exit;
        $this->db->trans_start();
            if (!empty($_FILES['video_file']['name'])) {
            $config['upload_path'] = './uploads/audioFile/';
            $config['allowed_types'] = '*';
            $new_name = time();
            $config['file_name'] = $new_name;
            // var_dump($config['upload_path']);exit;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->initialize($config));exit;

            if (!$this->upload->do_upload('video_file')) {
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
       'english_title' => $this->db->escape_str(trim($name_en)),
       'english_desc' => $this->db->escape_str(trim($description_en)),
       'file_path' => $this->db->escape_str(trim(SURL."uploads/audioFile/".$file)),
       'filename' => $this->db->escape_str(trim($file)),
    );
            //  var_dump($ins_data);exit;
                 $this->db->dbprefix('playlists');
                 $ins_into_db = $this->db->insert('playlists', $ins_data);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 return FALSE;
                } else{

                     return true;

                    }
}

public function edit_playlist($data){
  extract($data);
   // var_dump($data);exit;
        $this->db->trans_start();
            if (!empty($_FILES['video_file']['name'])) {
            $config['upload_path'] = './uploads/audioFile/';
            $config['allowed_types'] = '*';
            $new_name = time();
            $config['file_name'] = $new_name;
            // var_dump($config['upload_path']);exit;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

             // var_dump($this->upload->initialize($config));exit;

            if (!$this->upload->do_upload('video_file')) {
                $error = $this->upload->display_errors();
                echo $error;
                exit;
            } else {
                $uploadData = $this->upload->data();
                $file = $uploadData['file_name'];
            }
        }else{
            $file=$old_audio;
        }  
      $ins_data = array(
       'english_title' => $this->db->escape_str(trim($name_en)),
       'english_desc' => $this->db->escape_str(trim($description_en)),
       'file_path' => $this->db->escape_str(trim(SURL."uploads/audioFile/".$file)),
       'filename' => $this->db->escape_str(trim($file)),
    );
             // var_dump($ins_data);exit;
                 $this->db->dbprefix('playlists');
                 $this->db->where('id',$id);
                 $ins_into_db = $this->db->update('playlists', $ins_data);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 return FALSE;
                } else{

                     return true;

                    }
}
    public function add_question($data){
        extract($data);
        $class= getUserNameByEmployeeID($this->session->userdata('employee_id'));
        // var_dump($skills);exit;
        $created_date= date('Y-m-d');
        $this->db->trans_start();
        $ins_data = array(
       'question' => $this->db->escape_str(trim($question)),
       'course_id' => $this->db->escape_str(trim($course_id)),
       'user_id' => $this->db->escape_str(trim($this->session->userdata('employee_id'))),
       'class' => $this->db->escape_str(trim($class['class'])),
    );
            // var_dump($ins_data);exit;
                 $this->db->dbprefix('students_questions');
                 $ins_into_db = $this->db->insert('students_questions', $ins_data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 return FALSE;
                } else{
    
                     return true;

                    }
    }   
        public function edit_profile($data){
        extract($data);
        $created_date= date('Y-m-d');
        if($password){
        $password= md5($password);
      }else{
        $password= $old_password;
      }
        if (!empty($_FILES['picture']['name'])) {
            $config['upload_path'] = './uploads/profile_pic/';
            $config['allowed_types'] = '*';
            $iconnew_name = time();
            $config['file_name'] = $iconnew_name;
            // var_dump($config['upload_path']);exit;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // var_dump($this->upload->initialize($config));exit;

            if (!$this->upload->do_upload('picture')) {
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
        $this->db->trans_start();

          $ins_data = array(
       'full_name' => $this->db->escape_str(trim($name)),
       'password' => $this->db->escape_str(trim($password)),
       'image_url' => $this->db->escape_str(trim(SURL."uploads/profile_pic/".$file)),
       'image_name' => $this->db->escape_str(trim($file)),
    );
            // var_dump($ins_data);exit;
                 $this->db->dbprefix('users');
                 $this->db->where('id',$this->session->userdata('user_id'));
                 $ins_into_db = $this->db->update('users', $ins_data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                 $this->db->trans_rollback();
                 return FALSE;
                } else{

                     return true;

                    }
    }

    public function delete_report($id){
            $this->db->trans_start();
        $this->db->query("DELETE FROM scores WHERE id=".$id.";");
        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
            return FALSE;
       }else{
           return TRUE;
       }
}    public function delete_employee($id){
            $this->db->trans_start();
        $this->db->query("DELETE FROM employees WHERE id=".$id.";");
        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
            return FALSE;
       }else{
           return TRUE;
       }
}

public function delete_audio($id){
  $this->db->trans_start();
$this->db->query("DELETE FROM playlists WHERE id=".$id.";");
$this->db->trans_complete();
  if ($this->db->trans_status() === FALSE) {
 $this->db->trans_rollback();
  return FALSE;
}else{
 return TRUE;
}
}public function delete_quick_list($id){
  $this->db->trans_start();
$this->db->query("DELETE FROM quick_play_lists WHERE id=".$id.";");
$this->db->trans_complete();
  if ($this->db->trans_status() === FALSE) {
 $this->db->trans_rollback();
  return FALSE;
}else{
 return TRUE;
}
}
public function add_category($data){
  extract($data);
  // var_dump($skills);exit;
  $created_date= date('Y-m-d');
  $this->db->trans_start();
  $ins_data = array(
 'category_name' => $this->db->escape_str(trim($category_name)),
);
      // var_dump($ins_data);exit;
  $this->db->dbprefix('categories');
  $ins_into_db = $this->db->insert('categories', $ins_data);
          $this->db->trans_complete();
  if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
           return FALSE;
          } else{

               return true;

          }
}
public function edit_category($data){
  extract($data);
  // var_dump($skills);exit;
  $created_date= date('Y-m-d');
  $this->db->trans_start();
  $ins_data = array(
 'category_name' => $this->db->escape_str(trim($category_name)),
);
      // var_dump($ins_data);exit;
  $this->db->dbprefix('categories');
  $this->db->where('id',$id);
  $ins_into_db = $this->db->update('categories', $ins_data);
          $this->db->trans_complete();
  if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
           return FALSE;
          } else{

               return true;

          }
}
public function add_survey($data){
  extract($data);
//  var_dump($data);exit;
  $created_date= date('Y-m-d');
  $this->db->trans_start();
  $ins_data = array(
 'question' => $this->db->escape_str(trim($question)),
 'category_id' => $this->db->escape_str(trim($category)),
 'playlist_id' => $this->db->escape_str(trim($playlist_id)),
);
      // var_dump($ins_data);exit;
  $this->db->dbprefix('survey_questions');
  $ins_into_db = $this->db->insert('survey_questions', $ins_data);
  $question_id = $this->db->insert_id();

for($i=0;$i<count($option);$i++){
  $ins = array(
    'question_id' => $this->db->escape_str(trim($question_id)),
    'options' => $this->db->escape_str(trim($option[$i])),
  );
   $this->db->dbprefix('survey_options');
   $ins_into_db = $this->db->insert('survey_options', $ins);
  }

  $this->db->trans_complete();
  if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
           return FALSE;
          } else{

               return true;

              }
}
public function edit_survey($data){
  extract($data);
//  var_dump($data);exit;
  $created_date= date('Y-m-d');
  $this->db->trans_start();
  $ins_data = array(
 'question' => $this->db->escape_str(trim($question)),
 'category_id' => $this->db->escape_str(trim($category)),
);
      // var_dump($ins_data);exit;
  $this->db->dbprefix('survey_questions');
  $this->db->where('id',$id);
  $ins_into_db = $this->db->update('survey_questions', $ins_data);
  // $question_id = $this->db->insert_id();
$this->db->query("DELETE FROM survey_options WHERE question_id='".$id."';");
for($i=0;$i<count($option);$i++){
  $ins = array(
    'question_id' => $this->db->escape_str(trim($id)),
    'options' => $this->db->escape_str(trim($option[$i])),
  );
   $this->db->dbprefix('survey_options');
   $ins_into_db = $this->db->insert('survey_options', $ins);
  }

  $this->db->trans_complete();
  if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
           return FALSE;
          } else{

               return true;

              }
}
 function add_user($data){
  extract($data);
    $ins_data = array(
       'full_name' => $this->db->escape_str(trim($name)),
       'phone_no' => $this->db->escape_str(trim($phone_no)),
       'email_id' => $this->db->escape_str(trim($email)),
       'username' => $this->db->escape_str(trim($username)),
       'password' => $this->db->escape_str(trim(md5($password))),
    );
                            //var_dump($insert_data);
        $this->db->dbprefix('users');
        $ins_into_db = $this->db->insert('users', $ins_data);
        if($ins_into_db){
          return TRUE;
        }else{
          return FALSE;
        }

 }
function edit_user($data){
  extract($data);
        if($password){
          $password= md5($password);
        }else{
          $password= $old_password;
        }
    $ins_data = array(
       'full_name' => $this->db->escape_str(trim($name)),
       'phone_no' => $this->db->escape_str(trim($phone_no)),
       'email_id' => $this->db->escape_str(trim($email)),
       'username' => $this->db->escape_str(trim($username)),
       'password' => $this->db->escape_str(trim($password)), 
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
public function sendMail($password,$username,$email="")
{

$config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => 'locumotiveforemail@gmail.com',
    'smtp_pass' => 'AdminLocum',
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);
// Set to, from, message, etc.

$result = $this->email->send();

      $message="Hi,<br>New Course Lecture had been added and assign to you please login to your account! to access your courses and assessments.<br>

                    Regargs<br>
                    <div class='background-color:#666;color:#fff;padding:6px;
                    text-align:center;'>
                    Team LMS.
                    </div>";
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from('ayeenmk@gmail.com'); // change it to yours
      $this->email->to('ayeenmuhammad@gmail.com');// change it to yours
      $this->email->subject('New Course Assign');
      $this->email->message($message);
      if($this->email->send())
     {
      return array('status' => TRUE, 'errors' => array());
     }
     else
    {
     // show_error($this->email->print_debugger());
      $errors = $this->email->print_debugger();
           // echo "<pre>";
           // print_r($errors);
           // exit;
            return array('status' => FALSE, 'errors' => $errors);
    }

}


        public function delete_user($id){

        $this->db->trans_start();
        $this->db->query("DELETE FROM users WHERE id='$id';");
        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
           $this->db->trans_rollback();
            return FALSE;
       }else{
           return TRUE;
       }

    }
    public function delete_survey($id){

      $this->db->trans_start();
      $this->db->query("DELETE FROM survey_questions WHERE id='$id';");
      $this->db->query("DELETE FROM survey_options WHERE question_id='$id';");
      $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE) {
         $this->db->trans_rollback();
          return FALSE;
     }else{
         return TRUE;
     }

  }
    public function delete_category($id){

      $this->db->trans_start();
      $this->db->query("DELETE FROM categories WHERE id='$id';");
      $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE) {
         $this->db->trans_rollback();
          return FALSE;
     }else{
         return TRUE;
     }

  }
   
}
?>