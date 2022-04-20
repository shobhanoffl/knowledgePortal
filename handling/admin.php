<?php
// Initializing DB Connection
$ini = parse_ini_file('cred.ini');
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// Connection to the DB
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);


   //******************************************//
  // Reading All User Details for Admin Panel //
 //******************************************//
 $s_uno=array();
 $s_name=array();
 $s_clgid=array();
 $s_dept=array();
 $s_design=array();
 $s_email=array();
 $s_phone=array();
 $s_journals=array();
 $s_seminars=array();
 $s_wshops=array();
 $s_courses=array();
 $s_proj=array();
 $s_it=array();
 $s_hackathons=array();
 $s_fdp=array();
 $s_dp=array();
 $s_suser=array();
 $s_updated =array();
 
 $user_details_query = "SELECT * FROM users";
 $user_details_result = mysqli_query($db, $user_details_query);
 while($user_details=mysqli_fetch_assoc($user_details_result)){
     $s_uno[] = $user_details['uno'];
     $s_name[] = $user_details['name'];
     $s_clgid[] = $user_details['clgid'];
     $s_dept[] = $user_details['dept'];
     $s_design[] = $user_details['designation'];
     $s_email[] = $user_details['email'];
     $s_phone[] = $user_details['phone'];
     $s_journals[] = $user_details['journals'];
     $s_seminars[] = $user_details['seminars'];
     $s_wshops[] = $user_details['workshops'];
     $s_courses[] = $user_details['courses'];
     $s_proj[] = $user_details['projects'];
     $s_it[] = $user_details['it'];
     $s_hackathons[] = $user_details['hackathons'];
     $s_fdp[] = $user_details['fdp'];
     $s_dp[] = $user_details['dp'];
     $s_suser[] = $user_details['superuser'];
     $s_updated[] = $user_details['lastupdated'];
}


?>