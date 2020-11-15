<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends CI_Controller {



	function __construct(){

		// Call the Model constructor

		parent::__construct();

		$this->load->library('session');
		// $this->load->helper('cookie');
		$this->load->library('csvimport');

		$this->load->model('mod_users');

		$this->load->model('mod_admin');
		$this->load->model('mod_menabev');

		$this->load->helper('common');


	}

	public function dashboard_users(){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
		 };

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

	$data['footer'] = $this->load->view('common/footer', '', TRUE);
	$data['zones']= getAllZones();
	$data['departments']=getAllDepartments();
	$data['content_creaters']=getAllContentCreaters();
	$data['employees']=getAllEmployees();
	$data['dashboard_users']=getAllDashboardUsers();
		$this->load->view('dashboard/dashboard_users',$data);
	
}

public function index(){
	if(@$this->session->userdata('user_id')!= ''){
	 		redirect(SURL."admin/home");
		 }
if(@$this->session->userdata('counter')){
    // var_dump("expression");exit;
	$this->session->set_userdata("attempt",$this->session->userdata('counter'));
}else{
	
	$this->session->set_userdata("attempt",0);
}
		// var_dump($this->session->all_userdata());
		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);
		$data['header'] = $this->load->view('common/header', '', TRUE);
		$data['footer'] = $this->load->view('common/footer', '', TRUE);
		// $data['counter'] = $this->session->userdata('counter');
		$this->load->view('login/login',$data);

	}

	public function login_process(){
		if($this->input->post('g-recaptcha-response')){
			// var_dump("expression");exit;
		$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

        $userIp=$this->input->ip_address();
     	// var_dump($userIp);
     	// var_dump($recaptchaResponse);
        $secret = "6Ldp4mcUAAAAAMy31I45H1vNB2KAp3TFZBk-k6ne";
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 		try {
    $ch = curl_init();

    // Check if initialization had gone wrong*    
    if ($ch === false) {
        throw new Exception('failed to initialize');
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt(/* ... */);

    $content = curl_exec($ch);

    // Check the return value of curl_exec(), too
    if ($content === false) {
        throw new Exception(curl_error($ch), curl_errno($ch));
    }

    /* Process $content here */

    // Close curl handle
    curl_close($ch);
    $status= json_decode($content, true);
    // var_dump($content);exit;
         if ($status['success']) {
            // print_r('Google Recaptcha Successful');
            // exit;
        $res=$this->mod_users->userCheck();
        if($res){
			redirect(SURL."admin/home");
		}else{
		 	$attempt= $this->input->post('counter')+1;
			$this->session->set_userdata('counter',$attempt);
			$this->session->set_flashdata('err_message', '- Username / Password Invalide, please try again.');
		 	redirect(base_url().'admin/index');

		}
        }else{
        	// var_dump("expression");exit;
            $this->session->set_flashdata('err_message', 'Sorry Google Recaptcha Verification Falied Try Again!!');
            redirect(base_url().'admin/index');
        }
} catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),E_USER_ERROR);

}
       
	}
		$res=$this->mod_users->userCheck();
           if($res){
			redirect(SURL."admin/home");
			}else{
		 	$attempt= $this->input->post('counter')+1;
			$this->session->set_flashdata('counter',$attempt);
			$this->session->set_flashdata('err_message', '- Username / Password Invalide, please try again.');
		 	redirect(base_url().'admin/index/');

		}
		
			// var_dump($res);exit();
	

	}

	public function edit_profile(){
		if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
		 };
		 if($this->input->post()){

		 	$res=$this->mod_admin->edit_profile($this->input->post());
		 	if($res){
			$this->session->set_flashdata('ok_message', '-  Profile Updated Successfully!');
			redirect(base_url().'admin/home');
			}else{

			$this->session->set_flashdata('err_message', '- Not Updated. Something went wrong, please try again.');
			redirect(base_url().'admin/home');
			}
		 }
		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);
		$data['header'] = $this->load->view('common/header', '', TRUE);
		$data['footer'] = $this->load->view('common/footer', '', TRUE);

		$this->load->view('login/login',$data);
	}
	public function home(){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
		 };

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);
	   $data['users']=getAllUsers();
	   // $data['schools']=getAllSchools();
		$this->load->view('dashboard/users',$data);	

}		public function survey_report(){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
		 };

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);
	   $data['report']=getUsersSurveyReport();
	   // $data['schools']=getAllSchools();
		$this->load->view('dashboard/survey_report',$data);	

}public function survey($id=""){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
};

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

	   $data['footer'] = $this->load->view('common/footer', '', TRUE);
	   $data['users']=getAllUsers();
	   $data['playlist_id']=$id;
		$this->load->view('dashboard/survey',$data);	

}	
public function add_survey(){
	// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){

	 redirect(SURL);
	
	 };
if($this->input->post()){

	$res= $this->mod_admin->add_survey($this->input->post());
	if($res){
		$playlist_id= $this->input->post('playlist_id');
		$this->session->set_flashdata('ok_message', '- Survey Created successfully.');
        redirect(base_url().'admin/survey/'.$playlist_id.'/?r=active');
		}
		else
		{
			$this->session->set_flashdata('err_message', '- Not Created. Something went wrong, please try again.');
			redirect(base_url().'admin/survey/'.$playlist_id.'/?r=active');

				

		}
}	

}		

public function play_list(){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){
	 	redirect(SURL);		
	};

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);
	   $data['playList']=getAllPlaylist();
	   // $data['schools']=getAllSchools();
		$this->load->view('dashboard/playList',$data);	

}
public function quick_list(){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){
	 	redirect(SURL);		
	};

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

		$data['footer'] = $this->load->view('common/footer', '', TRUE);
	   $data['playList']=getAllQuickPlaylist();
	   // $data['schools']=getAllSchools();
		$this->load->view('dashboard/quick_list',$data);	

}
public function categories(){
		// echo "string";exit;
if($this->session->userdata('user_id') != TRUE){
	 	redirect(SURL);
		 };

		$data['header_script'] = $this->load->view('common/header_script', '', TRUE);

		$data['header'] = $this->load->view('common/header', '', TRUE);

	   $data['footer'] = $this->load->view('common/footer', '', TRUE);
	   $data['categories']=getallCategories();
	   // $data['schools']=getAllSchools();
		$this->load->view('dashboard/categories',$data);	

}	

function edit_category(){
if($this->input->post('save')){

// var_dump($_POST);exit;
		$res=$this->mod_admin->edit_category($this->input->post());

		if($res){
				$this->session->set_flashdata('ok_message', '- Category  Updated successfully.');

				redirect(base_url().'admin/categories?c=active');		

		}else{

				$this->session->set_flashdata('err_message', '- Not Updated. Something went wrong, please try again.');

					redirect(base_url().'admin/categories?c=active');
		}
	}

$view=getCategoryByID($this->input->post('category_id'));
// $dates=getCouponsCodesByID($this->input->post('coupon_id'))
?>	
 								<input type="hidden" value="<?php echo $this->input->post('category_id');?>" name="id">
   								 <div class="form-group">       
                                  <label>Category Name</label>
                                  <input type="text" placeholder="Category Name" value="<?php echo $view['category_name']?>" name="category_name" class="form-control" required="" data-msg="Please enter a valid">
                                </div> 
                                 
                              

<?php
}


public function logout_user(){
		$this->session->sess_destroy();
		redirect(SURL."admin");
}

public function checkDuplicateUser(){

if($this->input->post()){
	// var_dump($this->input->post('employee_id'));exit;
	$check=getUserNameByEmployeeID($this->input->post('employee_id'));
	if(count($check)>0){
				echo "1";	
			}else{
				echo "0";
			}	 	
		 }

	}
	
function add_user(){
$res= $this->mod_admin->add_user($this->input->post());

	if($res){
		
		$this->session->set_flashdata('ok_message', '- User Created successfully.');
        redirect(base_url().'admin/home?h=active');
		}
		else
		{
			$this->session->set_flashdata('err_message', '- Not Created. Something went wrong, please try again.');
			redirect(base_url().'admin/home?h=active');

				

		}
}
function add_category(){
	$res= $this->mod_admin->add_category($this->input->post());
	
		if($res){
			
			$this->session->set_flashdata('ok_message', '- Category Created successfully.');
			redirect(base_url().'admin/categories?c=active');
			}
			else
			{
				$this->session->set_flashdata('err_message', '- Not Created. Something went wrong, please try again.');
				redirect(base_url().'admin/categories?c=active');
	
					
	
			}
}
function edit_user(){
if($this->input->post('save')){

// var_dump($_POST);exit;
		$res=$this->mod_admin->edit_user($this->input->post());

		if($res){
				$this->session->set_flashdata('ok_message', '- User  Updated successfully.');

				redirect(base_url().'admin/home?h=active');		

		}else{

				$this->session->set_flashdata('err_message', '- Not Updated. Something went wrong, please try again.');

					redirect(base_url().'admin/home?h=active');
		}
	}

$view=getUserByID($this->input->post('user_id'));
// $dates=getCouponsCodesByID($this->input->post('coupon_id'))
?>	
 <input type="hidden" value="<?php echo $this->input->post('user_id');?>" name="id">
   								<div class="form-group">       
                                  <label>Name</label>
                                  <input type="text" placeholder="Name..." value="<?php echo $view['full_name']?>" name="name" class="form-control" required="" data-msg="Please enter a valid name">
                                </div> 
                                <div class="form-group">       
                                  <label>Phone Number</label>
                                  <input type="text" placeholder="Phone..." value="<?php echo $view['phone_no']?>" name="phone_no" class="form-control" required="" data-msg="Please enter a valid name">
                                </div> 
                                <div class="form-group">       
                                  <label>Email ID</label>
                                  <input type="text" placeholder="Email" value="<?php echo $view['email_id']?>" name="email" class="form-control" required="" data-msg="Please enter a valid name">
                                </div>   
                                 <div class="form-group">       
                                  <label>Username</label>
                                  <input type="text" placeholder="Username" value="<?php echo $view['username']?>" name="username" class="form-control" required="" data-msg="Please enter a valid name">
                                  </div> 
                                  <div class="form-group">       
                                  <label>Password</label>
                                  <input type="hidden" name="old_password" value="<?php echo $view['password'];?>">
                                  <input type="password" placeholder="*************" name="password" class="form-control"  data-msg="Please enter a valid name">
                                </div> 
                                 
                              

<?php
}

	public function delete_user($id){
if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
		 }


		$res=$this->mod_admin->delete_user($id);

					if($res){

				

				$this->session->set_flashdata('ok_message', '- User Deleted successfully.');

				redirect(base_url().'admin/home?h=active');

				

		}else{

				$this->session->set_flashdata('err_message', '- Not Deleted. Something went wrong, please try again.');

					redirect(base_url().'admin/home?h=active');
				

		}



	}	
public function delete_category($id){
if($this->session->userdata('user_id') != TRUE){

	 	redirect(SURL);
		
		 }


		$res=$this->mod_admin->delete_category($id);

					if($res){

				

				$this->session->set_flashdata('ok_message', '- Category Deleted successfully.');

				redirect(base_url().'admin/categories?c=active');

				

		}else{

				$this->session->set_flashdata('err_message', '- Not Deleted. Something went wrong, please try again.');

					redirect(base_url().'admin/consignment?c=active');

				

		}



	}	
	public function delete_survey($id){
		if($this->session->userdata('user_id') != TRUE){
		
				 redirect(SURL);
				
				 }
		
		
				$res=$this->mod_admin->delete_survey($id);
		
							if($res){
		
						
		
						$this->session->set_flashdata('ok_message', '- Survey Question Deleted successfully.');
		
						redirect(base_url().'admin/survey?s=active');
		
						
		
				}else{
		
						$this->session->set_flashdata('err_message', '- Not Deleted. Something went wrong, please try again.');
		
							redirect(base_url().'admin/survey?s=active');
		
						
		
				}
		
		
		
			}
	public function delete_audio($id){
		if($this->session->userdata('user_id') != TRUE){
		
				 redirect(SURL);
				
				 }
		
		
				$res=$this->mod_admin->delete_audio($id);
		
							if($res){
		
						
		
						$this->session->set_flashdata('ok_message', '- Audio Deleted successfully.');
		
						redirect(base_url().'admin/play_list?r=active');
		
						
		
				}else{
		
						$this->session->set_flashdata('err_message', '- Not Deleted. Something went wrong, please try again.');
		
							redirect(base_url().'admin/play_list?r=active');
		
						
		
				}
		
		
		
			}	
public function delete_quick_list($id){
		if($this->session->userdata('user_id') != TRUE){
		
				 redirect(SURL);
				
				 }
		
		
				$res=$this->mod_admin->delete_quick_list($id);
		
							if($res){
		
						
		
						$this->session->set_flashdata('ok_message', '- Audio Deleted successfully.');
		
						redirect(base_url().'admin/play_list?r=active');
		
						
		
				}else{
		
						$this->session->set_flashdata('err_message', '- Not Deleted. Something went wrong, please try again.');
		
							redirect(base_url().'admin/play_list?r=active');
		
						
		
				}
		
		
		
			}public function delete_report($id){
		if($this->session->userdata('user_id') != TRUE){
		
				 redirect(SURL);
				
				 }
		
		
				$res=$this->mod_admin->delete_report($id);
		
							if($res){
		
						
		
						$this->session->set_flashdata('ok_message', '- Report Deleted successfully.');
		
						redirect(base_url().'admin/survey_report?sr=active');
		
						
		
				}else{
		
						$this->session->set_flashdata('err_message', '- Not Deleted. Something went wrong, please try again.');
		
							redirect(base_url().'admin/survey_report?sr=active');
		
						
		
				}
		
		
		
			}
	function add_video(){
		$res= $this->mod_admin->add_video($this->input->post());
		
			if($res){
				
				$this->session->set_flashdata('ok_message', '- Video Added successfully.');
				redirect(base_url().'admin/play_list?r=active');
				}
				else
				{
					$this->session->set_flashdata('err_message', '- Not Created. Something went wrong, please try again.');
					redirect(base_url().'admin/play_list?r=active');
		
						
		
				}
		}


function edit_playlist(){
if($this->input->post('save')){

// var_dump($_POST);exit;
		$res=$this->mod_admin->edit_playlist($this->input->post());

		if($res){
				$this->session->set_flashdata('ok_message', '- Play List  Updated successfully.');

				redirect(base_url().'admin/play_list?r=active');		

		}else{

				$this->session->set_flashdata('err_message', '- Not Updated. Something went wrong, please try again.');

					redirect(base_url().'admin/play_list?r=active');
		}
	}

$view=getAudioByID($this->input->post('audio_id'));
// $dates=getCouponsCodesByID($this->input->post('coupon_id'))
?>	
 								<input type="hidden" value="<?php echo $this->input->post('audio_id');?>" name="id"> 
   								 <div class="form-group">       
                                  <label>Title</label>
                                  <input type="text" placeholder="English Name" value="<?php echo $view['english_title'];?>" name="name_en" class="form-control" required="" data-msg="Please enter a valid">
                                </div>  
                                <div class="form-group">       
                                  <label>Description</label>
                                  <textarea class="form-control" name="description_en" placeholder="Description"><?php echo $view['english_desc'];?></textarea>
                                </div>
                            
                                  <div class="form-group">  
                                  <input type="hidden" name="old_audio" value="<?php echo $view['filename'];?>">     
                                  <label>Video File</label>
                                  <input type="file" name="video_file" class="form-control">
                                  </div>       
                                 
                              

<?php
}


function edit_survey(){
if($this->input->post('save')){

// var_dump($_POST);exit;
		$res=$this->mod_admin->edit_survey($this->input->post());

		if($res){
				$this->session->set_flashdata('ok_message', '- Survey  Updated successfully.');

				redirect(base_url().'admin/survey?s=active');		

		}else{

				$this->session->set_flashdata('err_message', '- Not Updated. Something went wrong, please try again.');

					redirect(base_url().'admin/survey?s=active');
		}
	}

$view=getSurveByID($this->input->post('question_id'));
$options=getSurveOptionsByID($this->input->post('question_id'));
// $dates=getCouponsCodesByID($this->input->post('coupon_id'))
?>	
 								<input type="hidden" value="<?php echo $this->input->post('question_id');?>" name="id">
   							    <div class="form-group">       
                                  <label>Category</label>
                                  <select class="form-control" name="category" required>
                                  <option value=''>Select Category</option>
                                  <option value="Welcome"<?php if($view['category_id']=="Welcome"){echo "selected";}?> >Welcome</option>
                                  <?php $categories = getallCategories();?>
                                  <?php foreach($categories as $res) {?>
                                    <option value="<?php echo $res['id'];?>"><?php echo $res['category_name'];?></option>
                                  <?php }?>
                                  </select>
                            </div> 
                                <div class="form-group">       
                                  <label>Question</label>
                                  <input type="text" placeholder="Survey Question" value="<?php echo $view['question'];?>" name="question" class="form-control" required="" data-msg="Please enter a valid">
                                </div> 
                                <table id="surveyz">
                               <?php $count=1; foreach($options as $res){?>
                                <tr id="row-<?php echo $count;?>">
                                <td>
                                <div class="form-group" id="newOptions">       
                                <label>Option <?php echo $count;?></label>
                                <input type="text" placeholder="survey option" value="<?php echo $res['options'];?>" name="option[]" class="form-control marginbottoms" required="" data-msg="Please enter a valid" >                                
                                </div>
                                </td>
                              
                                <td>
                                <a href='#' onclick="remove('survey',<?php echo $count;?>)"><i class='fa fa-close' style='color: red;font-size:18px;'></i></a>
                                </td>
                                </tr>
                               <?php $count++;}?>
                                </table> 
                                <div class="form-group"> 
                                <input type="button" onClick="add_option()" value="Add New" class="btn btn-primary btn-sm">
                                </div>  
                                 
                                 <script type="text/javascript">
 function add_option(){
 	// alert("function call");
       var i = $('#newOptions .marginbottoms').length;
       var rows = "";
       // alert(i);
        i=i+1;
       // alert(i);
       rows += "<tr id='row-" + i + "'><td><div class='form-group' id='newOptions'>"+       
                                "<label>Options "+i+"</label>"+
                                "<input type='text' placeholder='survey option' name='option[]' class='form-control marginbottoms' required='' data-msg='Please enter a valid' >"+                                
                                "</div>"+
                                "</td>"+
                                "<td>"+
                                "<a href='#'' onclick=remove('surveyz',"+i+")><i class='fa fa-close' style='color: red;font-size:18px;'></i></a>"+
                                "</td> </tr>";
       // alert(rows);
        $(rows).appendTo("#surveyz tbody");
  }
      function remove(table, row) {
       // alert(table);
    $('#' + table + ' ' + '#row-' + row).remove();
}

</script>
                              

<?php
}
}