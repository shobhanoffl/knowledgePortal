<?php

// Initializing DB Connection
$ini = parse_ini_file('cred.ini');
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// Connection to the DB
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);


   //*************************************************************//
  // Reading Currently Logged in User Details for Frequent Usage //
 //*************************************************************//
$p_uno=array();
$p_name=array();
$p_clgid=array();
$p_dept=array();
$p_design=array();
$p_email=array();
$p_phone=array();
$p_journals=array();
$p_seminars=array();
$p_wshops=array();
$p_courses=array();
$p_proj=array();
$p_it=array();
$p_hackathons=array();
$p_fdp=array();
$p_dp=array();
$p_suser=array();
$p_updated =array();
$p_display =array();
$reg_clgid=$_SESSION['reg_clgid'] ?? null;

$user_details_query = "SELECT * FROM users WHERE clgid='$reg_clgid'";
$user_details_result = mysqli_query($db, $user_details_query);
while($user_details=mysqli_fetch_assoc($user_details_result)){
    $p_uno[] = $user_details['uno'];
    $p_name[] = $user_details['name'];
    $p_clgid[] = $user_details['clgid'];
    $p_dept[] = $user_details['dept'];
    $p_design[] = $user_details['designation'];
    $p_email[] = $user_details['email'];
    $p_phone[] = $user_details['phone'];
    $p_journals[] = $user_details['journals'];
    $p_seminars[] = $user_details['seminars'];
    $p_wshops[] = $user_details['workshops'];
    $p_courses[] = $user_details['courses'];
    $p_proj[] = $user_details['projects'];
    $p_it[] = $user_details['it'];
    $p_hackathons[] = $user_details['hackathons'];
    $p_fdp[] = $user_details['fdp'];
    $p_dp[] = $user_details['dp'];
    $p_suser[] = $user_details['superuser'];
    $p_updated[] = $user_details['lastupdated'];
    $p_display[] = $user_details['display'];
}


   //*******************************************************//
  // Reading Posts Sorted by Recent to Display on Homepage //
 //*******************************************************//
// $post_pno=array();
// $post_date=array();
// $post_type=array();
// $post_caption=array();
// $post_image=array();
// $post_document=array();
// $post_video=array();
// $post_uid=array();
// $post_clgid=array();

// $posts_query = "SELECT * FROM posts ORDER BY pno DESC";
// $posts_result = mysqli_query($db, $posts_query);
// while($posts=mysqli_fetch_assoc($posts_result)){
//     $post_pno[] = $posts['pno'];
//     $post_date[] = $posts['date'];
//     $post_type[] = $posts['type'];
//     $post_caption[] = $posts['caption'];
//     $post_image[] = $posts['image'];
//     $post_document[] = $posts['document'];
//     $post_video[] = $posts['video'];
//     $post_uid[] = $posts['uid'];
//     $post_clgid[] = $posts['uclgid'];
// }

// // Query for dynamically taking the currently updated DP and Name of Author of Post
// $post_uname=array();
// $post_udp=array();
// for($i = 0; $i < count($post_clgid); $i+=1):
//     $posts_query = "SELECT name,dp FROM users WHERE clgid='$post_clgid[$i]'";
//     $posts_result = mysqli_query($db, $posts_query);
//     while($posts=mysqli_fetch_assoc($posts_result)){
//         $post_uname[]=$posts['name'];
//         $post_udp[]=$posts['dp'];
//     }
// endfor;


   //********************************************************//
  // For Fetching Profile Details of Users & Posts of Users //
 //********************************************************//
if (isset($_GET['profile'])){
    $profile_uno=array();
    $profile_name=array();
    $profile_clgid=array();
    $profile_dept=array();
    $profile_design=array();
    $profile_email=array();
    $profile_phone=array();
    $profile_journals=array();
    $profile_seminars=array();
    $profile_wshops=array();
    $profile_courses=array();
    $profile_proj=array();
    $profile_it=array();
    $profile_hackathons=array();
    $profile_fdp=array();
    $profile_dp=array();
    $profile_suser=array();
    $profile_updated =array();

    $profile_pno=array();
    $profile_date=array();
    $profile_type=array();
    $profile_caption=array();
    $profile_image=array();
    $profile_document=array();
    $profile_video=array();
    $profile_uid=array();
    $profile_uname=array();
    $profile_udp=array();
    $profile_uclgid=array();

    $profile_details_query = "SELECT * FROM users WHERE clgid='".$_GET['profile']."'";
    $profile_details_result = mysqli_query($db, $profile_details_query);
    while($profile_details=mysqli_fetch_assoc($profile_details_result)){
        $profile_uno[] = $profile_details['uno'];
        $profile_name[] = $profile_details['name'];
        $profile_clgid[] = $profile_details['clgid'];
        $profile_dept[] = $profile_details['dept'];
        $profile_design[] = $profile_details['designation'];
        $profile_email[] = $profile_details['email'];
        $profile_phone[] = $profile_details['phone'];
        $profile_journals[] = $profile_details['journals'];
        $profile_seminars[] = $profile_details['seminars'];
        $profile_wshops[] = $profile_details['workshops'];
        $profile_courses[] = $profile_details['courses'];
        $profile_proj[] = $profile_details['projects'];
        $profile_it[] = $profile_details['it'];
        $profile_hackathons[] = $profile_details['hackathons'];
        $profile_fdp[] = $profile_details['fdp'];
        $profile_dp[] = $profile_details['dp'];
        $profile_suser[] = $profile_details['superuser'];
        $profile_updated[] = $profile_details['lastupdated'];
    }

    
}

   //************************//
  // For Fetching All Posts //
 //************************//

if(isset($_GET['getPosts'])){
    switch ($_GET['getPosts']){
        case 'journal':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from journals WHERE uclgid='".$_GET['profile']."'ORDER BY jno DESC";
            }else{
                $sql = "SELECT * from journals ORDER BY jno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'seminar':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from seminars WHERE uclgid='".$_GET['profile']."'ORDER BY sno DESC";
            }else{
                $sql = "SELECT * from seminars ORDER BY sno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'workshop':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from workshops WHERE uclgid='".$_GET['profile']."'ORDER BY wno DESC";
            }else{
                $sql = "SELECT * from workshops ORDER BY wno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'course':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from courses WHERE uclgid='".$_GET['profile']."'ORDER BY cno DESC";
            }else{
                $sql = "SELECT * from courses ORDER BY cno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'project':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from projects WHERE uclgid='".$_GET['profile']."'ORDER BY prno DESC";
            }else{
                $sql = "SELECT * from projects ORDER BY prno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'it':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from its WHERE uclgid='".$_GET['profile']."'ORDER BY ino DESC";
            }else{
                $sql = "SELECT * from its ORDER BY ino DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'hackathon':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from hackathons WHERE uclgid='".$_GET['profile']."'ORDER BY hno DESC";
            }else{
                $sql = "SELECT * from hackathons ORDER BY hno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
        case 'fdp':
            $rowSet = array();
            if (isset($_GET['profile'])){
                $sql = "SELECT * from fdps WHERE uclgid='".$_GET['profile']."'ORDER BY fno DESC";
            }else{
                $sql = "SELECT * from fdps ORDER BY fno DESC";
            }
            $query = $db -> prepare($sql);
            $query->execute();
            $resultSet = $query->get_result();
            while(($row = mysqli_fetch_array($resultSet))) {
                $rowSet[] = $row;
            }
            $i=0;
            $post_clgid = array();
            $uid = array();
            while($i<count($rowSet)){
                array_push($uid,$rowSet[$i]['uid']) ;
                array_push($post_clgid,$rowSet[$i]['uclgid']); 
                $i++;
            }
            break;
    }
    // Query for dynamically taking the currently updated DP and Name of Author of Post
    $post_uname_dyn=array();
    $post_udp_dyn=array();
    $i=0;
    while($i<count($rowSet)){
        $posts_query = "SELECT name,dp FROM users WHERE clgid='$post_clgid[$i]'";
        $posts_result = mysqli_query($db, $posts_query);
        while($posts=mysqli_fetch_assoc($posts_result)){
            $post_uname_dyn[]=$posts['name'];
            $post_udp_dyn[]=$posts['dp'];
        }
        $i++;
    }
}



?>