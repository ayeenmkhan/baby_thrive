
<?php
function getAllUsers(){
     $CI = get_instance();
     $query = $CI->db->query("SELECT * FROM (users) where username !='admin'");
            // var_dump($query->result_array());exit;
        return $query->result_array();
}function getallCategories(){
     $CI = get_instance();
     $query = $CI->db->query("SELECT * FROM (categories)");
            // var_dump($query->result_array());exit;
        return $query->result_array();
}function getUserByID($id){
     $CI = get_instance();
     $query = $CI->db->query("SELECT * FROM (users) where id='$id'");
            // var_dump($query->result_array());exit;
        return $query->row_array();
}
function getQuestionByID($id){
    $CI = get_instance();
    $query = $CI->db->query("SELECT * FROM (questions) where question_id='$id'");
           // var_dump($query->result_array());exit;
       return $query->row_array();
}
function getAllPlaylist(){
     $CI = get_instance();
      $query = $CI->db->query("SELECT * FROM (playlists)");
            // var_dump($query->result_array());exit;
        return $query->result_array();
}function getAudioByID($id){
     $CI = get_instance();
      $query = $CI->db->query("SELECT * FROM (playlists) where id='".$id."'");
            // var_dump($query->result_array());exit;
        return $query->row_array();
}
function getAllQuickPlaylist(){
     $CI = get_instance();
      $query = $CI->db->query("SELECT * FROM (quick_play_lists)");
            // var_dump($query->result_array());exit;
        return $query->result_array();
}function getQuickAudioByID($id){
     $CI = get_instance();
      $query = $CI->db->query("SELECT * FROM (quick_play_lists) where id='".$id."'");
            // var_dump($query->row_array());exit;
        return $query->row_array();
}function getSurveByID($id){
     $CI = get_instance();
      $query = $CI->db->query("SELECT * FROM (survey_questions) where id='".$id."'");
            // var_dump($query->row_array());exit;
        return $query->row_array();
}function getSurveOptionsByID($id){
     $CI = get_instance();
      $query = $CI->db->query("SELECT * FROM (survey_options) where question_id='".$id."'");
            // var_dump($query->row_array());exit;
        return $query->result_array();
}
function getAllSurveyQuestions(){
    $CI = get_instance();
     $query = $CI->db->query("SELECT * FROM (survey_questions)");
           // var_dump($query->result_array());exit;
       return $query->result_array();
}

function getOptionsByID(){
    $CI = get_instance();
    $query = $CI->db->query("SELECT * FROM (survey_options)");
          // var_dump($query->result_array());exit;
      return $query->result_array();
}function getUsersSurveyReport(){
    $CI = get_instance();
    $query = $CI->db->query("SELECT * FROM (scores)");
          // var_dump($query->result_array());exit;
      return $query->result_array();
}