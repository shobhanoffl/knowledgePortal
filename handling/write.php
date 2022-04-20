<?php
include('read.php');

// Initializing DB Connection
$ini = parse_ini_file('cred.ini');
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// Connection to the DB
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);


   //*********************//
  // Edit-Update Profile //
 //*********************//
if (isset($_POST['editprofile_btn'])){
    $p_name=mysqli_real_escape_string($db, $_POST['p_name']);
    $p_clgid=mysqli_real_escape_string($db, $_POST['p_clgid']);
    $p_dept=mysqli_real_escape_string($db, $_POST['p_dept']);
    $p_design=mysqli_real_escape_string($db, $_POST['p_design']);
    $p_email=mysqli_real_escape_string($db, $_POST['p_email']);
    $p_phone=mysqli_real_escape_string($db, $_POST['p_phone']);
    $reg_clgid=$_SESSION['reg_clgid'];
    
    // For Storing Image Directory
    $target_dir = "../assets/user/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // Selecting User who registered in previous screen
    $user_select_query = "SELECT * FROM users WHERE clgid='$reg_clgid'";
    $user_select_result = mysqli_query($db, $user_select_query);
    $user_select_status = mysqli_fetch_assoc($user_select_result);
    
    // Inserting details into that selected user's row 
    if($user_select_status){
        if(basename($_FILES["image"]["name"])){
            $editprofile_query = "UPDATE users SET name='$p_name',clgid='$p_clgid',dept='$p_dept',designation='$p_design',email='$p_email',phone='$p_phone',dp='$target_file' WHERE clgid='$reg_clgid'";
        }else{
            $editprofile_query = "UPDATE users SET name='$p_name',clgid='$p_clgid',dept='$p_dept',designation='$p_design',email='$p_email',phone='$p_phone' WHERE clgid='$reg_clgid'";
        }
        mysqli_query($db, $editprofile_query);
        $_SESSION['reg_clgid']=$p_clgid;
        header('location: profile.php?profile='.$p_clgid.'&getPosts=journal');
    }else{
        header('location: login-signup.php?msg=Unauthorized+Access');
    }
}

//********************//
// To Create New Post //
//********************//
if (isset($_POST['newpost_btn'])){
    $posttype=mysqli_real_escape_string($db,$_POST['posttype']);

    // $postcaption=mysqli_real_escape_string($db,$_POST['postcaption']);
    // $postdate=time();
    
    // To Handle Images Uploaded
    // $count=0;
    // $imglocationarray=array();
    // foreach($_FILES['post_image']['name'] as $filename){
    //     $target_dir = "assets/posts/images/";
    //     $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
    //     move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
    //     array_push($imglocationarray,$target_file);
    //     $count=$count + 1;
    //     $target_file='';
    // }
    // $imglocationarray_arr=implode(',',$imglocationarray);
    
    // To Handle Documents Uploaded
    // $count=0;
    // $doclocationarray=array();
    // foreach($_FILES['post_document']['name'] as $filename){
    //     $target_dir = "assets/posts/documents/";
    //     $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
    //     move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
    //     array_push($doclocationarray,$target_file);
    //     $count=$count + 1;
    //     $target_file='';
    // }
    // $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    // $count=0;
    // $vidlocationarray=array();
    // foreach($_FILES['post_video']['name'] as $filename){
    //     $target_dir = "assets/posts/videos/";
    //     $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
    //     move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
    //     array_push($vidlocationarray,$target_file);
    //     $count=$count + 1;
    //     $target_file='';
    // }
    // $vidlocationarray_arr=implode(',',$vidlocationarray);
    

    if($posttype=='Seminar'){
        header('location: newposts/seminar.php');
        // $p_seminars[0]=$p_seminars[0]+1;
        // $update_col_query = "UPDATE users SET seminars='$p_seminars[0]' WHERE clgid='$p_clgid[0]'";
    }elseif($posttype=='Workshop'){
        header('location: newposts/workshop.php');
        // $p_wshops[0]=$p_wshops[0]+1;
        // $update_col_query = "UPDATE users SET workshops='$p_wshops[0]' WHERE clgid='$p_clgid[0]'";
    }elseif($posttype=='Course'){
        header('location: newposts/course.php');
        // $p_courses[0]=$p_courses[0]+1;
        // $update_col_query = "UPDATE users SET courses='$p_courses[0]' WHERE clgid='$p_clgid[0]'";
    }elseif($posttype=='Project'){
        header('location: newposts/project.php');
        // $p_proj[0]=$p_proj[0]+1;
        // $update_col_query = "UPDATE users SET projects='$p_proj[0]' WHERE clgid='$p_clgid[0]'";
    }elseif($posttype=='IT'){
        header('location: newposts/it.php');
        // $p_it[0]=$p_it[0]+1;
        // $update_col_query = "UPDATE users SET it='$p_it[0]' WHERE clgid='$p_clgid[0]'";
    }elseif($posttype=='Hackathon'){
        header('location: newposts/hackathon.php');
        // $p_hackathons[0]=$p_hackathons[0]+1;
        // $update_col_query = "UPDATE users SET hackathons='$p_hackathons[0]' WHERE clgid='$p_clgid[0]'";
    }elseif($posttype=='FDP'){
        header('location: newposts/fdp.php');
        // $p_fdp[0]=$p_fdp[0]+1;
        // $update_col_query = "UPDATE users SET fdp='$p_fdp[0]' WHERE clgid='$p_clgid[0]'";
    }else{
        header('location: newposts/journal.php');
        // $p_journals[0]=$p_journals[0]+1;
        // $update_col_query = "UPDATE users SET posts='$p_journals[0]' WHERE clgid='$p_clgid[0]'";
    }

    mysqli_query($db,$update_col_query);

    $new_post_query = "INSERT INTO posts (date,type,caption,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$posttype','$postcaption','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    
    if(mysqli_query($db, $new_post_query)){
        header('location: home.php?post=added&getPosts=journal');
    }else{
        header('location: home.php?post=notadded');
    }
}

   //*********************//
  // Update New Password //
 //*********************//
if ((isset($_POST['chg_pass_btn'])) AND (isset($_POST['new_pass']))){
    $new_pass=mysqli_real_escape_string($db, $_POST['new_pass']);
    $new_pass=md5($new_pass);
    $change_pass_query = "UPDATE users SET pass='$new_pass' WHERE clgid='$p_clgid[0]'";
    if(mysqli_query($db, $change_pass_query)){
        header('location: settings.php?msg=Password+Changed+Successfully');
    }else{
        header('location: settings.php?msg=Unable+to+Update+Password+-+Kindly+Raise+Issue');
    }
}

   //*****************************//
  // Update New Background Image //
 //*****************************//
if ((isset($_POST['chg_bg_btn'])) AND (isset($_POST['new_bg']))){
    $new_bg=mysqli_real_escape_string($db, $_POST['new_bg']);
    $change_bg_query = "UPDATE users SET display='$new_bg' WHERE clgid='$p_clgid[0]'";
    if(mysqli_query($db, $change_bg_query)){
        header('location: display.php?msg=Background+Changed+Successfully');
    }else{
        header('location: display.php?msg=Unable+to+Background+Changed+Successfully');
    }
}


  //***************//
 // New Hackathon //
//***************//
if (isset($_POST['newhackathon_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $org_by     =   mysqli_real_escape_string($db,$_POST['org_by']);
    $org_by_f   =   mysqli_real_escape_string($db,$_POST['org_by_f']);
    $spon_by    =   mysqli_real_escape_string($db,$_POST['spon_by']);
    $spon_by_f  =   mysqli_real_escape_string($db,$_POST['spon_by_f']);
    $members    =   mysqli_real_escape_string($db,$_POST['proj_members']);
    $startdt    =   mysqli_real_escape_string($db,$_POST['proj_startdt']);
    $enddt      =   mysqli_real_escape_string($db,$_POST['proj_enddt']);

    // Duration Calculator
    $date1 = $startdt;
    $date2 = $enddt;
    $diff = abs(strtotime($date2) - strtotime($date1));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $duration = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);
    
    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO hackathons (date,title,org_by,org_by_f,spon_by,spon_by_f,members,startdt,enddt,duration,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$org_by','$org_by_f','$spon_by','$spon_by_f','$members','$startdt','$enddt','$duration','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_hackathons[0]=$p_hackathons[0]+1;
        $update_col_query = "UPDATE users SET hackathons='$p_hackathons[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=hackathon');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=hackathon');
        }
    }else{
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=hackathon');
    }

}


  //************//
 // New Course //
//************//
if (isset($_POST['newcourse_btn'])){

    // Variables
    $postdate   =   time();
    $name      =   mysqli_real_escape_string($db,$_POST['course_name']);
    $domain     =   mysqli_real_escape_string($db,$_POST['course_domain']);
    $company   =   mysqli_real_escape_string($db,$_POST['company']);
    $company_f    =   mysqli_real_escape_string($db,$_POST['company_f']);
    $enddt  =   mysqli_real_escape_string($db,$_POST['proj_enddt']);
    $enddt      =    strtotime($enddt);
    $length    =   mysqli_real_escape_string($db,$_POST['course_len']);
    $unit    =   mysqli_real_escape_string($db,$_POST['duration_unit']);

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);
    
    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO courses (date,name,domain,company,company_f,enddt,length,unit,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$name','$domain','$company','$company_f','$enddt','$length','$unit','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_courses[0]=$p_courses[0]+1;
        $update_col_query = "UPDATE users SET courses='$p_courses[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=course');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=course');
        }
    }else{
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=course');
    }

}


  //*************//
 // New Project //
//*************//
if (isset($_POST['newproject_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $domain     =   mysqli_real_escape_string($db,$_POST['proj_domain']);
    $members     =   mysqli_real_escape_string($db,$_POST['proj_members']);
    $spon_by    =   mysqli_real_escape_string($db,$_POST['spon_by']);
    $spon_by_f  =   mysqli_real_escape_string($db,$_POST['spon_by_f']);
    $cost    =   mysqli_real_escape_string($db,$_POST['proj_cost']);
    $startdt    =   mysqli_real_escape_string($db,$_POST['proj_startdt']);
    $status     =   mysqli_real_escape_string($db,$_POST['proj_status']);
    $enddt      =   mysqli_real_escape_string($db,$_POST['proj_enddt']);

    // Duration Calculator
    $date1 = $startdt;
    $date2 = $enddt;
    $diff = abs(strtotime($date2) - strtotime($date1));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $duration = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);
    
    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO projects (date,title,domain,members,spon_by,spon_by_f,cost,startdt,status,enddt,duration,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$domain','$members','$spon_by','$spon_by_f','$cost','$startdt','$status','$enddt','$duration','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_projects[0]=$p_projects[0]+1;
        $update_col_query = "UPDATE users SET projects='$p_projects[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=project');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=project');
        }
    }else{
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=project');
    }

}


  //*************//
 // New Journal //
//*************//
if (isset($_POST['newjournal_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $auth_pos     =   mysqli_real_escape_string($db,$_POST['author_posi']);
    $coauth   =   mysqli_real_escape_string($db,$_POST['coauthor']);
    $jname  =   mysqli_real_escape_string($db,$_POST['journal_name']);
    $vol_no    =   mysqli_real_escape_string($db,$_POST['vol_no']);
    $issue_no    =   mysqli_real_escape_string($db,$_POST['issue_no']);
    $page_no      =   mysqli_real_escape_string($db,$_POST['page_no']);
    $do_issue      =   mysqli_real_escape_string($db,$_POST['do_issue']);
    $do_issue      =    strtotime($do_issue);
    $imp_factor      =   mysqli_real_escape_string($db,$_POST['imp_factor']);
    $publisher      =   mysqli_real_escape_string($db,$_POST['publisher']);
    $publisher_url      =   mysqli_real_escape_string($db,$_POST['publisher_url']);
    $indexing      =   mysqli_real_escape_string($db,$_POST['indexing']);


    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);
    
    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO journals (date,title,auth_pos,coauth,jname,vol_no,page_no,issue_no,do_issue,imp_factor,publisher,pub_url,indexing,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$auth_pos','$coauth','$jname','$vol_no','$page_no','$issue_no','$do_issue','$imp_factor','$publisher','$publisher_url','$indexing','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";

    if(mysqli_query($db, $new_post_query)){
        $p_journals[0]=$p_journals[0]+1;
        $update_col_query = "UPDATE users SET posts='$p_journals[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=journal');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=journal');
        }
    }else{
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=journal');
    }

}


  //**************//
 // New Workshop //
//**************//
if (isset($_POST['newwshop_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $org_by     =   mysqli_real_escape_string($db,$_POST['org_by']);
    $org_by_f   =   mysqli_real_escape_string($db,$_POST['org_by_f']);
    $spon_by    =   mysqli_real_escape_string($db,$_POST['spon_by']);
    $spon_by_f  =   mysqli_real_escape_string($db,$_POST['spon_by_f']);
    $venue    =   mysqli_real_escape_string($db,$_POST['post_venue']);
    $duration    =   mysqli_real_escape_string($db,$_POST['post_duration']);
    $unit    =   mysqli_real_escape_string($db,$_POST['duration_unit']);

    $res_name    =   mysqli_real_escape_string($db,$_POST['res_name']);
    $res_design    =   mysqli_real_escape_string($db,$_POST['res_design']);
    $res_insti    =   mysqli_real_escape_string($db,$_POST['res_insti']);

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);
    
    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO workshops (date,title,org_by,org_by_f,spon_by,spon_by_f,venue,duration,unit,res_name,res_design,res_insti,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$org_by','$org_by_f','$spon_by','$spon_by_f','$venue','$duration','$unit','$res_name','$res_design','$res_insti','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_workshops[0]=$p_workshops[0]+1;
        $update_col_query = "UPDATE users SET workshops='$p_workshops[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=workshop');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=workshop');
        }
    }else{
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=workshop');
    }

}

  //*************//
 // New Seminar //
//*************//
if (isset($_POST['newseminar_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $org_by     =   mysqli_real_escape_string($db,$_POST['org_by']);
    $org_by_f   =   mysqli_real_escape_string($db,$_POST['org_by_f']);
    $spon_by    =   mysqli_real_escape_string($db,$_POST['spon_by']);
    $spon_by_f  =   mysqli_real_escape_string($db,$_POST['spon_by_f']);
    $venue    =   mysqli_real_escape_string($db,$_POST['post_venue']);
    $duration    =   mysqli_real_escape_string($db,$_POST['post_duration']);
    $unit    =   mysqli_real_escape_string($db,$_POST['duration_unit']);

    $res_name    =   mysqli_real_escape_string($db,$_POST['res_name']);
    $res_design    =   mysqli_real_escape_string($db,$_POST['res_design']);
    $res_insti    =   mysqli_real_escape_string($db,$_POST['res_insti']);

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);

    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO seminars (date,title,org_by,org_by_f,spon_by,spon_by_f,venue,duration,unit,res_name,res_design,res_insti,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$org_by','$org_by_f','$spon_by','$spon_by_f','$venue','$duration','$unit','$res_name','$res_design','$res_insti','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_seminars[0]=$p_seminars[0]+1;
        $update_col_query = "UPDATE users SET seminars='$p_seminars[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=seminar');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=seminar');
        }
    }else{
        die(mysqli_error($db));
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=seminar');
    }

}


  //********//
 // New IT //
//********//
if (isset($_POST['newit_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $ind_name      =   mysqli_real_escape_string($db,$_POST['ind_name']);
    $training_field     =   mysqli_real_escape_string($db,$_POST['training_field']);
    $startdt  =   mysqli_real_escape_string($db,$_POST['proj_startdt']);
    $enddt    =   mysqli_real_escape_string($db,$_POST['proj_enddt']);

    // Duration Calculator
    $date1 = $startdt;
    $date2 = $enddt;
    $diff = abs(strtotime($date2) - strtotime($date1));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $duration = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $unit = 'Days';

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);

    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO its (date,title,ind_name,training_field,duration,unit,startdt,enddt,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$ind_name','$training_field','$duration','$unit','$startdt','$enddt','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_it[0]=$p_it[0]+1;
        $update_col_query = "UPDATE users SET it='$p_it[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=it');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=it');
        }
    }else{
        die(mysqli_error($db));
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=it');
    }

}

  //*********//
 // New FDP //
//*********//
if (isset($_POST['newfdp_btn'])){

    // Variables
    $postdate   =   time();
    $title      =   mysqli_real_escape_string($db,$_POST['post_title']);
    $org_by     =   mysqli_real_escape_string($db,$_POST['org_by']);
    $org_by_f   =   mysqli_real_escape_string($db,$_POST['org_by_f']);
    $spon_by    =   mysqli_real_escape_string($db,$_POST['spon_by']);
    $spon_by_f  =   mysqli_real_escape_string($db,$_POST['spon_by_f']);
    $venue  =   mysqli_real_escape_string($db,$_POST['post_venue']);
    $duration  =   mysqli_real_escape_string($db,$_POST['post_duration']);
    $unit  =   mysqli_real_escape_string($db,$_POST['duration_unit']);

    // To Handle Images Uploaded
    $count=0;
    $imglocationarray=array();
    foreach($_FILES['post_image']['name'] as $filename){
        $target_dir = "assets/posts/images/";
        $target_file = $target_dir . basename($_FILES["post_image"]["name"][$count]);
        move_uploaded_file(($_FILES["post_image"]["tmp_name"][$count]), $target_file);
        array_push($imglocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $imglocationarray_arr=implode(',',$imglocationarray);

    // To Handle Documents Uploaded
    $count=0;
    $doclocationarray=array();
    foreach($_FILES['post_document']['name'] as $filename){
        $target_dir = "assets/posts/documents/";
        $target_file = $target_dir . basename($_FILES["post_document"]["name"][$count]);
        move_uploaded_file(($_FILES["post_document"]["tmp_name"][$count]), $target_file);
        array_push($doclocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $doclocationarray_arr=implode(',',$doclocationarray);

    // To Handle Videos Uploaded
    $count=0;
    $vidlocationarray=array();
    foreach($_FILES['post_video']['name'] as $filename){
        $target_dir = "assets/posts/videos/";
        $target_file = $target_dir . basename($_FILES["post_video"]["name"][$count]);
        move_uploaded_file(($_FILES["post_video"]["tmp_name"][$count]), $target_file);
        array_push($vidlocationarray,$target_file);
        $count=$count + 1;
        $target_file='';
    }
    $vidlocationarray_arr=implode(',',$vidlocationarray);

    // Post Query
    $new_post_query = "INSERT INTO fdps (date,title,org_by,org_by_f,spon_by,spon_by_f,venue,duration,unit,image,document,video,uid,uclgid) 
    VALUES ('$postdate','$title','$org_by','$org_by_f','$spon_by','$spon_by_f','$venue','$duration','$unit','$imglocationarray_arr','$doclocationarray_arr','$vidlocationarray_arr','$p_uno[0]','$p_clgid[0]')";
    if(mysqli_query($db, $new_post_query)){
        $p_fdp[0]=$p_fdp[0]+1;
        $update_col_query = "UPDATE users SET fdp='$p_fdp[0]' WHERE clgid='$p_clgid[0]'";
        if(mysqli_query($db,$update_col_query)){
            header('location: home.php?msg=Posted+Successfully&getPosts=fdp');
        }else{
            header('location: home.php?msg=Updating+Post+Count+Failed+-+Kindly+Raise+Issue&getPosts=fdp');
        }
    }else{
        header('location: home.php?msg=Unable+to+Post+-+Kindly+Raise+Issue&getPosts=fdp');
    }

}

?>