<?php
include('handling/auth.php');
include('handling/redirect.php');
include('handling/write.php');
include('handling/read.php');
// $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $current_link;
// if($current_link==="home.php"){
  // header('location: home.php?getPosts=journal',TRUE, 301);
  // die;
// }

if(!isset($_SESSION['reg_clgid']) || empty($_SESSION['reg_clgid'])){
  header('location: index.php?msg=Logged+Out+Successfully');
  exit();
}

if (isset($_GET['delType'])) {

  if($_GET['jno']){
    $p_journals[0]=$p_journals[0]-1;
    $update_col_query = "UPDATE users SET posts='$p_posts[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM journals WHERE jno='" .$_GET["jno"]. "'";
  }elseif($_GET['sno']){
    $p_seminars[0]=$p_seminars[0]-1;
    $update_col_query = "UPDATE users SET seminars='$p_seminars[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM seminars WHERE sno='" .$_GET["sno"]. "'";
  }elseif($_GET['wno']){
    $p_workshops[0]=$p_workshops[0]-1;
    $update_col_query = "UPDATE users SET workshops='$p_workshops[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM workshops WHERE wno='" .$_GET["wno"]. "'";
  }elseif($_GET['cno']){
    $p_courses[0]=$p_courses[0]-1;
    $update_col_query = "UPDATE users SET courses='$p_courses[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM courses WHERE cno='" .$_GET["cno"]. "'";
  }elseif($_GET['prno']){
    $p_projects[0]=$p_projects[0]-1;
    $update_col_query = "UPDATE users SET projects='$p_projects[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM projects WHERE prno='" .$_GET["prno"]. "'";
  }elseif($_GET['ino']){
    $p_it[0]=$p_it[0]-1;
    $update_col_query = "UPDATE users SET it='$p_it[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM its WHERE ino='" .$_GET["ino"]. "'";
  }elseif($_GET['hno']){
    $p_hackathons[0]=$p_hackathons[0]-1;
    $update_col_query = "UPDATE users SET hackathons='$p_hackathons[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM hackathons WHERE hno='" .$_GET["hno"]. "'";
  }elseif($_GET['fno']){
    $p_fdps[0]=$p_fdps[0]-1;
    $update_col_query = "UPDATE users SET fdps='$p_fdps[0]' WHERE clgid='$p_clgid[0]'";
    $del_query = "DELETE FROM fdps WHERE fno='" .$_GET["fno"]. "'";
  }

  mysqli_query($db,$update_col_query);

  if(mysqli_query($db, $del_query)){
    header('location: home.php?msg=Post+Deleted&getPosts=journal');
  }
  else{
    header('location: home.php?msg=Unable+to+Delete+the+Post+-+Kindly+Raise+Issue&getPosts=journal');
  }  
}

if (isset($_GET['chgProjStatus'])){
  $current=time();
  $proj_status_query = "UPDATE projects SET status='Completed',enddt='".$current."' WHERE prno='".$_GET["chgProjStatus"]."'";
  if(mysqli_query($db,$proj_status_query)){
    header('location: home.php?msg=Project+Status+Updated&getPosts=project');
  }else{
    //die(mysqli_error($db));
    header('location: home.php?msg=Project+Status+Not+Updated+-+Kindly+Raise+Issue&getPosts=journal');
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <link href="assets/app/css/post-template.css" rel="stylesheet">
    <link href="assets/app/css/new-post.css" rel="stylesheet">
    <link href="assets/app/css/nav-title.css" rel="stylesheet">
    <link href="assets/app/css/app-nav-bar.css" rel="stylesheet">
    <link href="assets/app/css/carousel.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <style>
      #app{
        background: url('<?php echo $p_display[0]; ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
      .update-btn{
        background: #3d83e4;
        padding: 10px 14px;
        color: white;
        font-weight: 500;
        border-radius: 30px;
        border: 2px solid #3d83e4;
      }
      .update-btn:hover{
    background-color: white;
    color: #3d83e4;
    border: 2px solid #3d83e4;
  }
</style>
</head>
<body>
  <div id="app">
    <v-app>
<!-- TITLE & NAVIGATION -->
      <div class="menu-component">
      <nav class="navbar">
        <ul class="menu-bar" style="flex-direction: column;">
          <li @click="toShow = !toShow"><v-icon color="black">mdi-menu</v-icon></li>
          <a href="home.php?getPosts=journal" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-home</v-icon>
          </li>
          </a><a href="profile.php?profile=<?php echo $p_clgid[0]; ?>&getPosts=journal" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-account</v-icon>
          </li>
          </a><a href="settings.php" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-cog</v-icon>
          </li>
          </a>
          <?php if($p_suser[0]==1){ ?>
          <a href="adminpanel.php" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-account-cog</v-icon>
          </li>
          </a>
          <?php } ?>
          <a href="index.php?logout=success" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="red">mdi-logout</v-icon>
          </li>
          </a>
        </ul>
      </nav>
      </div>
    <span class="nav-title">
      Knowledge Portal
    </span>
<!-- TITLE & NAVIGATION -->
<!-- POSTS TAB -->
<center>
<div class="tabs-wrap" id="tabs-feed">
<v-card elevation="0">
    <v-tabs show-arrows fixed v-model="active_tab">
      <v-tabs-slider></v-tabs-slider>
      <v-tab v-for="item of tabs" :key="item.id" :href="item.link" >
          {{ item.title }}
      </v-tab>
    </v-tabs>
</v-card>
</div>
</center>
<!-- POSTS TAB -->
<!-- Vuetify Snackbar for Displaying Messages -->
<?php if (isset($_GET['msg'])){ ?>
<div class="text-center">
    <v-snackbar v-model="snackbar" :timeout="timeout" color="primary" shaped> 
      <?php echo $_GET['msg']; ?>
      <template v-slot:action="{ attrs }">
        <v-btn color="white" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
</div>
<?php } ?>
<!-- Vuetify Snackbar for Displaying Messages -->
<div id="posts-feed">
<!-- NEW POST -->
  <div class="newpost-wrap">
  <form action="home.php" method="Post" enctype="multipart/form-data">
    <div class="newpost-title">What's up
      <span class="expand-icon" @click="expandBar=!expandBar">
        <v-icon color="#3d83e4" style="cursor:pointer;">mdi-arrow-down-drop-circle-outline</v-icon>
      </span>
    </div>
    <div class="expandable-part" v-if="expandBar">
      <br>
      <v-select name="posttype" label="Post Type" v-model="selectedPost" :items="postTypes" required outlined clearable></v-select>
      <!-- <v-autocomplete label="Location" v-model="selectedCollege" :items="colleges" required outlined clearable></v-autocomplete> -->

      <!-- Caption Area & Other Old Inputs Hidden -->
      <!-- <v-textarea name="postcaption" v-model="newPost" :counter="280" label="Caption" hint="Share your Achievement !" required outlined></v-textarea> -->

      <!-- <span class="update-link" @click="showAttach=!showAttach" style="cursor:pointer;"> -->
        <!-- <v-icon color="#3a7bd5">mdi-attachment</v-icon> Attach Files -->
      <!-- </span> -->

      <!-- <div class="newpost-icons" v-if="showAttach==true"> -->
      <!-- <v-icon>mdi-wallpaper</v-icon> <input style="color:black;font-weight:normal;" class="update-link" type="file" name="post_image[]" accept="image/*" multiple><br><br> -->
      <!-- <v-icon>mdi-file-document</v-icon> <input style="color:black;font-weight:normal;" class="update-link" type="file" name="post_document[]" accept=".pdf,.doc" multiple><br><br> -->
      <!-- <v-icon>mdi-play-box</v-icon> <input style="color:black;font-weight:normal;" class="update-link" type="file" name="post_video[]" accept="video/*" multiple> -->
      <!-- </div> -->
      <!-- Caption Area & Other Old Inputs Hidden -->

      <!-- <v-file-input  small-chips  multiple dense prepend-icon="mdi-wallpaper" accept="image/*" ></v-file-input> -->
      <!-- <v-file-input  small-chips  multiple dense prepend-icon="mdi-file-document" accept="document/pdf, document/docx"></v-file-input> -->
      
      <center>
        <button class="update-btn" style="cursor:pointer;" name="newpost_btn" type="submit">Post</button>&nbsp;&nbsp;&nbsp;
        <button class="update-link" type="reset"><a style="text-decoration: none;" href="home.php?getPosts=journal">Cancel</a></button>
      </center>
    </div>
  </form>
</div>
<!-- NEW POST -->
<div style="margin-top:12px;"></div>
<!-- POST TEMPLATE -->

<center>
<?php if(count($rowSet)<1){ ?>
  <span class="update-link" style="color:black;padding:35px 2px; ">No Posts to Show!</span>
<?php } ?>
</center>

<?php for ($i = 0; $i < count($rowSet); $i+=1): ?>
  <div class="post-wrap">
    <div class="post-header">
      <img src="<?php echo $post_udp_dyn[$i]; ?>" class="avator post-img">
      <div class="post-header-info">
        <div class="post-header-line-one">
          <span class="location-link mintext">

            <?php echo isset($rowSet[$i]['venue']) ? '&nbsp;<v-icon small>mdi-map-marker</v-icon>'.$rowSet[$i]['venue'] : NULL ; ?>

          </span>
          <span style="float:right;margin-right: 10px;" class="mintext">
            <?php echo date("d M Y", $rowSet[$i]['date']); ?>
          </span>
        </div> &nbsp;
        <div style="margin-top:6px;margin-left:1px;display:inline-block;font-size:16px;">
          <a href="profile.php?profile=<?php echo $post_clgid[$i]; ?>" class="link-to-profile" style="color: black;">
            <?php echo $post_uname_dyn[$i]; ?>
          </a>
        </div> &nbsp;·

<!-- Mini Tag -->
          <span class="mintext"> &nbsp;
          <?php echo isset($rowSet[$i]['jno']) ? "Journal" : NULL ; ?>
          <?php echo isset($rowSet[$i]['sno']) ? "Seminar" : NULL ; ?>
          <?php echo isset($rowSet[$i]['wno']) ? "Workshop" : NULL ; ?>
          <?php echo isset($rowSet[$i]['cno']) ? "Course" : NULL ; ?>
          <?php echo isset($rowSet[$i]['prno']) ? "Project" : NULL ; ?>
          <?php echo isset($rowSet[$i]['ino']) ? "IT" : NULL ; ?>
          <?php echo isset($rowSet[$i]['hno']) ? "Hackathon" : NULL ; ?>
          <?php echo isset($rowSet[$i]['fno']) ? "FDP" : NULL ; ?>
          </span>

<!-- Caption -->
          <p class="post-caption">
            <!-- Journals Caption  -->
            <?php if(isset($rowSet[$i]['jno'])){ ?>
              Published a Journal titled as 
              '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>' as 
              <?php echo isset($rowSet[$i]['auth_pos']) ? $rowSet[$i]['auth_pos'] : NULL ; ?> Author with
              <?php echo isset($rowSet[$i]['coauth']) ? $rowSet[$i]['coauth'] : NULL ; ?> as Coauthor in the Journal ~ 
              <?php echo isset($rowSet[$i]['jname']) ? $rowSet[$i]['jname'] : NULL ; ?> (Vol No - 
              <?php echo isset($rowSet[$i]['vol_no']) ? $rowSet[$i]['vol_no'] : NULL ; ?>, Issue No - 
              <?php echo isset($rowSet[$i]['issue_no']) ? $rowSet[$i]['issue_no'] : NULL ; ?>, Page No -
              <?php echo isset($rowSet[$i]['page_no']) ? $rowSet[$i]['page_no'] : NULL ; ?>), Dated - 
              <?php echo isset($rowSet[$i]['do_issue']) ? $rowSet[$i]['do_issue'] : NULL ; ?>, with an impact factor of
              <?php echo isset($rowSet[$i]['imp_factor']) ? $rowSet[$i]['imp_factor'] : NULL ; ?>. This was Published by 
              <?php echo isset($rowSet[$i]['publisher']) ? $rowSet[$i]['publisher'] : NULL ; ?> (URL: 
              <?php echo isset($rowSet[$i]['pub_url']) ? $rowSet[$i]['pub_url'] : NULL ; ?>).
              <?php echo isset($rowSet[$i]['indexing']) && ($rowSet[$i]['indexing']=="Yes") ? "This is an Indexed Publication." : NULL ; ?>
            <?php } ?>

            <!-- Seminars Caption -->
            <?php if(isset($rowSet[$i]['sno'])){ ?>
              <?php if($rowSet[$i]['org_by']=='Self'){ ?>
                Organized <?php echo ($rowSet[$i]['spon_by']=='Self') ? 'and Sponsored' : '' ; ?>
                a Seminar, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>',
              <?php }else{ ?>
                Participated in a Seminar, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>'
                organized by <?php echo isset($rowSet[$i]['org_by_f']) ? $rowSet[$i]['org_by_f'] : NULL ; ?> and 
              <?php } ?>
              <?php echo ($rowSet[$i]['spon_by']!='Self') ? 'Sponsored by '.$rowSet[$i]['spon_by_f'] : NULL ; ?>, for
              <?php echo isset($rowSet[$i]['duration']) ? $rowSet[$i]['duration'] : NULL ; ?> 
              <?php echo isset($rowSet[$i]['unit']) ? $rowSet[$i]['unit'] : NULL ; ?>.
              <br><br> Resource Person Details : <br>
              Name : <?php echo isset($rowSet[$i]['res_name']) ? $rowSet[$i]['res_name'] : NULL ; ?> <br>
              Designation : <?php echo isset($rowSet[$i]['res_design']) ? $rowSet[$i]['res_design'] : NULL ; ?> <br>
              Institution : <?php echo isset($rowSet[$i]['res_insti']) ? $rowSet[$i]['res_insti'] : NULL ; ?> <br>  
            <?php } ?>

            <!-- Workshops Caption -->
            <?php if(isset($rowSet[$i]['wno'])){ ?>
              <?php if($rowSet[$i]['org_by']=='Self'){ ?>
                Organized <?php echo ($rowSet[$i]['spon_by']=='Self') ? 'and Sponsored' : '' ; ?>
                a Workshop, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>',
              <?php }else{ ?>
                Participated in a Workshop, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>'
                organized by <?php echo isset($rowSet[$i]['org_by_f']) ? $rowSet[$i]['org_by_f'] : NULL ; ?> and 
              <?php } ?>
              <?php echo ($rowSet[$i]['spon_by']!='Self') ? 'Sponsored by '.$rowSet[$i]['spon_by_f'] : NULL ; ?>, for
              <?php echo isset($rowSet[$i]['duration']) ? $rowSet[$i]['duration'] : NULL ; ?> 
              <?php echo isset($rowSet[$i]['unit']) ? $rowSet[$i]['unit'] : NULL ; ?>.
              <br><br> Resource Person Details : <br>
              Name : <?php echo isset($rowSet[$i]['res_name']) ? $rowSet[$i]['res_name'] : NULL ; ?> <br>
              Designation : <?php echo isset($rowSet[$i]['res_design']) ? $rowSet[$i]['res_design'] : NULL ; ?> <br>
              Institution : <?php echo isset($rowSet[$i]['res_insti']) ? $rowSet[$i]['res_insti'] : NULL ; ?> <br>  
            <?php } ?>

            <!-- Courses Caption -->
            <?php if(isset($rowSet[$i]['cno'])){ ?>
              Completed the  Course
              '<?php echo isset($rowSet[$i]['name']) ? $rowSet[$i]['name'] : NULL ; ?>' in the domain
              '<?php echo isset($rowSet[$i]['domain']) ? $rowSet[$i]['domain'] : NULL ; ?>' from
              <?php echo ($rowSet[$i]['company']!='Other') ? $rowSet[$i]['company'] : $rowSet[$i]['company_f'] ; ?>. Duration of this course is
              <?php echo isset($rowSet[$i]['length']) ? $rowSet[$i]['length'] : NULL ; ?>
              <?php echo isset($rowSet[$i]['unit']) ? $rowSet[$i]['unit'] : NULL ; ?>, Completed it on
              <?php echo isset($rowSet[$i]['enddt']) ? $rowSet[$i]['enddt'] : NULL ; ?>
            <?php } ?>

            <!-- Project Caption -->
            <?php if(isset($rowSet[$i]['prno'])){ 
              if($rowSet[$i]['status']=="Completed"){ ?>
                Completed the project
              <?php }else{ ?>
                Working on the Project
              <?php } ?>
                '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>' in the domain
                <?php echo isset($rowSet[$i]['domain']) ? $rowSet[$i]['domain'] : NULL ; ?> with 
                <?php echo isset($rowSet[$i]['members']) ? $rowSet[$i]['members'] : NULL ; ?>
                <?php echo ($rowSet[$i]['spon_by']=="Other") ? 'as members and Sponsored by'.$rowSet[$i]['spon_by_f'] : 'as members.' ; ?>Cost of this Project is Rs.
                <?php echo isset($rowSet[$i]['cost']) ? $rowSet[$i]['cost'] : NULL ; ?>/-, Started on 
                <?php echo isset($rowSet[$i]['startdt']) ? date("d-m-Y", strtotime($rowSet[$i]['startdt'])) : NULL ; ?>
                <?php if($rowSet[$i]['status']=="Completed"){ ?>
                  and Completed on 
                  <?php echo date("d-m-Y", strtotime($rowSet[$i]['enddt'])).'.'; ?>
                  Duration of this Project is 
                  <?php echo $rowSet[$i]['duration'].' Days.'; ?>
                <?php }else{ echo 'and working on it.'; } ?>
            <?php } ?>      

            <!-- IT Caption -->
            <?php if(isset($rowSet[$i]['ino'])){ ?>
              Attended a Industrial Training Programme on
              <?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?> from
              <?php echo isset($rowSet[$i]['ind_name']) ? $rowSet[$i]['ind_name'] : NULL ; ?> in the domain
              <?php echo isset($rowSet[$i]['training_field']) ? $rowSet[$i]['training_field'] : NULL ; ?> for 
              <?php echo isset($rowSet[$i]['duration']) ? $rowSet[$i]['duration'] : NULL ; ?> days
              (<?php echo isset($rowSet[$i]['startdt']) ? date("d-m-Y", strtotime($rowSet[$i]['startdt'])) : NULL ; ?>  to 
              <?php echo isset($rowSet[$i]['enddt']) ? date("d-m-Y", strtotime($rowSet[$i]['enddt'])) : NULL ; ?>)
            <?php } ?>  
            
            <!-- Hackathons Caption -->
            <?php if(isset($rowSet[$i]['hno'])){ ?>
              <?php if($rowSet[$i]['org_by']=='Self'){ ?>
                Organized <?php echo ($rowSet[$i]['spon_by']=='Self') ? 'and Sponsored' : '' ; ?>
                a Hackathon, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>',
              <?php }else{ ?>
                Participated in a Hackathon, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>'
                organized by <?php echo isset($rowSet[$i]['org_by_f']) ? $rowSet[$i]['org_by_f'] : NULL ; ?> and 
              <?php } ?>
              <?php echo ($rowSet[$i]['spon_by']!='Self') ? 'Sponsored by '.$rowSet[$i]['spon_by_f'] : NULL ; ?>, for
              <?php echo isset($rowSet[$i]['duration']) ? $rowSet[$i]['duration'] : NULL ; ?> Days 
              (<?php echo isset($rowSet[$i]['startdt']) ? date("d-m-Y", strtotime($rowSet[$i]['startdt'])) : NULL ; ?>  to 
              <?php echo isset($rowSet[$i]['enddt']) ? date("d-m-Y", strtotime($rowSet[$i]['enddt'])) : NULL ; ?>), with
              <?php echo isset($rowSet[$i]['members']) ? $rowSet[$i]['members'] : NULL ; ?> as members.
            <?php } ?>

            <!-- FDPs Caption -->
            <?php if(isset($rowSet[$i]['fno'])){ ?>
              <?php if($rowSet[$i]['org_by']=='Self'){ ?>
                Organized <?php echo ($rowSet[$i]['spon_by']=='Self') ? 'and Sponsored' : '' ; ?>
                a FDP, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>',
              <?php }else{ ?>
                Participated in a FDP, titled '<?php echo isset($rowSet[$i]['title']) ? $rowSet[$i]['title'] : NULL ; ?>'
                organized by <?php echo isset($rowSet[$i]['org_by_f']) ? $rowSet[$i]['org_by_f'] : NULL ; ?> and 
              <?php } ?>
              <?php echo ($rowSet[$i]['spon_by']!='Self') ? 'Sponsored by '.$rowSet[$i]['spon_by_f'] : NULL ; ?>, for
              <?php echo isset($rowSet[$i]['duration']) ? $rowSet[$i]['duration'] : NULL ; ?> 
              <?php echo isset($rowSet[$i]['unit']) ? $rowSet[$i]['unit'] : NULL ; ?>.
            <?php } ?>
          </p>

      </div>
    </div>

    <?php $post_image_arr=explode(",",$rowSet[$i]['image']); ?>
    <?php if($rowSet[$i]['image']!='assets/posts/images/' AND $rowSet[$i]['image']!=''){ ?>
    <div class="align-straight">
      <div class="carousel">
        <div class="slides">
          <?php foreach($post_image_arr as $img){ ?>
          <img src="<?php echo $img;?>" class="slide">
          <?php } ?>
        </div>
        <div class="controls">
        <?php if(count($post_image_arr)>1){ ?>
          <div class="control prev-slide">&#9668;</div>
          <div class="control next-slide">&#9658;</div>
        <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>

    <!-- <span class="attached-link"> +  -->
      <?php //echo count($post_image_arr); ?> 
    <!-- images</span> -->
    <div class="align-straight">
      <?php $post_document_arr=explode(",",$rowSet[$i]['document']); ?>
    <?php if($rowSet[$i]['document']!='assets/posts/documents/' AND $rowSet[$i]['document']!=''){ ?>
      <br>
      <?php foreach($post_document_arr as $doc){ ?>
      <a href="<?php echo $doc; ?>" target="_blank">
        <div class="document-wrap document-link" style="display: inline-block;">
          <v-icon dense>mdi-file-document</v-icon> <?php echo str_replace("assets/posts/documents/","",$doc); ?>
        </div>
      </a>
      <?php } ?>
      <br>
      <?php } ?>
    </div>

    <div class="align-straight">
      <?php $post_video_arr=explode(",",$rowSet[$i]['video']); ?>
    <?php if($rowSet[$i]['video']!='assets/posts/videos/' AND $rowSet[$i]['video']!=''){ ?>
      <br>
      <?php foreach($post_video_arr as $vid){ ?>
      <a href="<?php echo $vid; ?>" target="_blank">
        <div class="document-wrap document-link" style="display: inline-block;">
          <v-icon dense>mdi-play-circle</v-icon> <?php echo str_replace("assets/posts/videos/","",$vid); ?>
        </div>
      </a>
      <?php } ?>
      <br>
      <?php } ?>
    </div>

    <?php if($p_clgid[0]==$post_clgid[$i]){ ?>
    <span class="delete-post-link">
    <v-menu bottom left>
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon v-bind="attrs" v-on="on">
          <v-icon dense>mdi-menu-down</v-icon>
        </v-btn>
      </template>

      <v-list>
        <v-list-item>
          <a href="home.php?<?php
           echo (isset($rowSet[$i]['jno'])) ? "jno=".$rowSet[$i]['jno'] : NULL; 
           echo (isset($rowSet[$i]['sno'])) ? "sno=".$rowSet[$i]['sno'] : NULL;
           echo (isset($rowSet[$i]['wno'])) ? "wno=".$rowSet[$i]['wno'] : NULL;
           echo (isset($rowSet[$i]['cno'])) ? "cno=".$rowSet[$i]['cno'] : NULL;
           echo (isset($rowSet[$i]['prno'])) ? "prno=".$rowSet[$i]['prno'] : NULL;
           echo (isset($rowSet[$i]['itno'])) ? "itno=".$rowSet[$i]['itno'] : NULL;
           echo (isset($rowSet[$i]['hno'])) ? "hno=".$rowSet[$i]['hno'] : NULL;
           echo (isset($rowSet[$i]['fno'])) ? "fno=".$rowSet[$i]['fno'] : NULL;
           ?>&delType=<?php
           echo (isset($rowSet[$i]['jno'])) ? "Journals" : NULL; 
           echo (isset($rowSet[$i]['sno'])) ? "Seminars" : NULL;
           echo (isset($rowSet[$i]['wno'])) ? "Workshops" : NULL;
           echo (isset($rowSet[$i]['cno'])) ? "Courses" : NULL;
           echo (isset($rowSet[$i]['prno'])) ? "Projects" : NULL;
           echo (isset($rowSet[$i]['itno'])) ? "IT" : NULL;
           echo (isset($rowSet[$i]['hno'])) ? "Hackathon" : NULL;
           echo (isset($rowSet[$i]['fno'])) ? "FDP" : NULL;
           ?>" style="color:red;text-decoration:none;">
            <v-list-item-title>
            <v-icon dense style="vertical-align:top;" color="red">
              mdi-trash-can-outline
            </v-icon>  Delete
            </v-list-item-title>
          </a>
        </v-list-item>
        <?php if(isset($rowSet[$i]['status']) && isset($rowSet[$i]['prno'])){ ?>
        <?php if(($rowSet[$i]['status']=="Under Development")){ ?>
        <v-list-item>
          <a href="home.php?chgProjStatus=<?php echo (isset($rowSet[$i]['prno'])) ? $rowSet[$i]['prno'] : NULL;  
          ?>" style="text-decoration:none;">
            <v-list-item-title>
            <v-icon dense style="vertical-align:top;" color="blue">
              mdi-pencil
            </v-icon>  Change Status
            </v-list-item-title>
          </a>
        </v-list-item>
        <?php } ?>
        <?php } ?>
      </v-list>
    </v-menu>
    </span>
    <?php } ?>

    <!-- <div class="align-straight like-bar">
      <span><v-icon>mdi-thumb-up</v-icon></span>
      <span style="float:right;margin-right: 20px;"><v-icon>mdi-bookmark</v-icon></span>
    </div> -->
  </div>
<?php endfor; ?>
  
</div>
<!-- POST TEMPLATE -->
    </v-app>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script>
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      data:{
            // Post Layout
            postLocation:'Erode',
            postProfilePicURL:'https://pbs.twimg.com/profile_images/1295112038096629760/3eCOaKDb_400x400.jpg',
            postFirstPicURL:'https://www.smartinsights.com/wp-content/uploads/2020/03/The-theory-of-Golden-Circle-model.png',
            postProfileName:'Simon Sinek',
            postMonth:'December',
            postYear:'2021',
            postContent:'Seminar',
            postCaption:'The Golden Circle theory explains how leaders can inspire cooperation, trust and change in a business based on his research into how the most successful organizations think, act and communicate if they start with why.',
            postImageNos:'2',
            postFistDocName:'The Golden Circle',
            postDocNos:'1',
            // New Post
            expandBar:false,
            showAttach:false,
            newPost:'',
            postType:null,
            selectedPost:'',
            postTypes:['Journal','Seminar','Workshop','Course','Project','IT','Hackathon','FDP'],
            // Nav Bar Show
            toShow : false,
            // Tabs to Filter Posts
            active_tab:null,
            tabs:[{id:1,title:'Journal',link:'?getPosts=journal'},
            {id:2,title:'Seminar',link:'?getPosts=seminar'},
            {id:3,title:'Workshop',link:'?getPosts=workshop'},
            {id:4,title:'Course',link:'?getPosts=course'},
            {id:5,title:'Project',link:'?getPosts=project'},
            {id:6,title:'IT',link:'?getPosts=it'},
            {id:7,title:'Hackathon',link:'?getPosts=hackathon'},
            {id:8,title:'FDP',link:'?getPosts=fdp'}],
            // Snackbar
            <?php if (isset($_GET['msg'])){ ?>
              snackbar: true,
              timeout: 4000,
            <?php } ?>
      },
      methods: {
        //
      },
      mounted: function() {
        for (let i = 0; i < <?php echo count($rowSet); ?>; i++) {
          const delay = 15000; //ms

          const slides = document.querySelectorAll(".slides")[i];
          const slidesCount = slides.childElementCount;
          const maxLeft = (slidesCount - 1) * 100 * -1;

          let current = 0;

          function changeSlide(next = true) {
            if (next) {
              current += current > maxLeft ? -100 : current * -1;
            } else {
              current = current < 0 ? current + 100 : maxLeft;
            }

            slides.style.left = current + "%";
          }

          let autoChange = setInterval(changeSlide, delay);
          const restart = function () {
            clearInterval(autoChange);
            autoChange = setInterval(changeSlide, delay);
          };

          // Controls
          document.querySelectorAll(".next-slide")[i].addEventListener("click", function () {
            changeSlide();
            restart();
          });

          document.querySelectorAll(".prev-slide")[i].addEventListener("click", function () {
            changeSlide(false);
            restart();
          });
        }
      },function(){
        window.onscroll = function() {myFunctionTwo()};

        var tabsfeed = document.getElementById("tabs-feed");
        var postsfeed = document.getElementById("posts-feed");
        var stickyTwo = tabsfeed.offsetTop;
        function myFunctionTwo() {
          if (window.pageYOffset >= stickyTwo) {
            tabsfeed.classList.add("tabs-wrap-added");
            postsfeed.classList.add("posts-feed-added");
          } else {
            tabsfeed.classList.remove("tabs-wrap-added");
            postsfeed.classList.remove("posts-feed-added");
          }
        }
      },
    })

  </script>
</body>
</html>