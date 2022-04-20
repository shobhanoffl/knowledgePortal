<?php
include('../handling/auth.php');
include('../handling/redirect.php');
include('../handling/write.php');
include('../handling/read.php');
if(!isset($_SESSION['reg_clgid']) || empty($_SESSION['reg_clgid'])){
  header('location: ../index.php?msg=Logged+Out+Successfully');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="../assets/app/css/nav-title.css" rel="stylesheet">
    <link href="../assets/app/css/app-nav-bar.css" rel="stylesheet">
    <link href="../assets/app/css/settings-options.css" rel="stylesheet">
    <link href="../assets/app/css/edit-profile.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <style>
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
          <a href="../home.php?getPosts=journal" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-home</v-icon>
          </li>
          </a><a href="../profile.php?profile=<?php echo $p_clgid[0]; ?>&getPosts=journal" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-account</v-icon>
          </li>
          </a><a href="../settings.php" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-cog</v-icon>
          </li>
          </a>
          <?php if($p_suser[0]==1){ ?>
          <a href="../adminpanel.php" class="nav-link">
          <li @click="toShow = false" :style="{display:[toShow ? 'Block' : 'None']}">
              <v-icon color="black">mdi-account-cog</v-icon>
          </li>
          </a>
          <?php } ?>
          <a href="../index.php?logout=success" class="nav-link">
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
<br><center>  
  <div class="page-title">
    Seminar
  </div>
</center>
<br>
<!-- NEW POST -->
<div class="editprofile-wrap">
  <div class="profile">
      <form action="../home.php?getPosts=journal" method="Post" enctype="multipart/form-data">

		<div class="profile-user-settings">
      <div class="update-link-text">Basic Info</div>
		<!-- <v-text-field name="p_name" v-model="fullname" :counter="40" label="Name" prepend-icon="mdi-account-edit" readonly required></v-text-field> -->
		<!-- <v-text-field name="p_clgid" v-model="clgid" label="College ID" prepend-icon="mdi-circle-edit-outline" readonly required></v-text-field> -->
		<v-text-field name="post_title" v-model="post_title" label="Title" prepend-icon="mdi-format-title" required></v-text-field>
        <v-select name="org_by" v-model="s_org_by" :items="org_bys" label="Organized by" prepend-icon="mdi-account-group" required></v-select>
		<v-text-field name="org_by_f" v-model="org_by_f" label="Organizers (If not Self)" prepend-icon="mdi-account-group-outline"></v-text-field>
        <v-select name="spon_by" v-model="s_spon_by" :items="spon_bys" label="Sponsored by" prepend-icon="mdi-account-supervisor-circle" required></v-select>
		<v-text-field name="spon_by_f" v-model="spon_by_f" label="Sponsors (If not Self)" prepend-icon="mdi-account-supervisor-circle-outline"></v-text-field>
		<v-text-field name="post_venue" v-model="post_venue" label="Venue" prepend-icon="mdi-map-marker" required></v-text-field>
		<v-row style="margin:auto 0px;">
      <v-text-field name="post_duration" v-model="post_duration" label="Duration (Just Number)" prepend-icon="mdi-calendar-range" required></v-text-field>
      <v-select name="duration_unit" v-model="s_duration_unit" :items="duration_units" label="Duration Unit" prepend-icon="mdi-clock" required style="width:50%;"></v-select>
    </v-row>  
		</div>
        <br>
		<div class="profile-bio">
    <div class="update-link-text">Resource Person Details (If not Self)</div>
        <v-text-field name="res_name" v-model="res_name" label="Name" prepend-icon="mdi-account-edit"></v-text-field>
		<v-text-field name="res_design" v-model="res_design" label="Designation" prepend-icon="mdi-account-details"></v-text-field>
		<v-text-field name="res_insti" v-model="res_insti" label="Institution" prepend-icon="mdi-domain"></v-text-field>

    <br>
    <div class="update-link-text">Attachments</div>
    <br>
        <!-- <div class="newpost-icons"> -->
      <v-icon>mdi-wallpaper</v-icon> <input style="color:black;font-weight:normal;" class="update-link" type="file" name="post_image[]" accept="image/*" multiple><br><br>
      <v-icon>mdi-file-document</v-icon> <input style="color:black;font-weight:normal;" class="update-link" type="file" name="post_document[]" accept=".pdf,.doc" multiple><br><br>
      <v-icon>mdi-play-box</v-icon> <input style="color:black;font-weight:normal;" class="update-link" type="file" name="post_video[]" accept="video/*" multiple>
      <!-- </div> -->
		</div>

    <div class="editprofile-btns">
        <button class="update-btn" type="submit" name="newseminar_btn">Post</button>
        <span class="update-link"><a style="text-decoration: none;" href="../home.php?getPosts=journal">Cancel</a></span>
    </div>
  </form><br><br>
</div>
</div>
<!-- NEW POST -->
    </v-app>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script>
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      data:{
            // Nav Bar Show
            toShow : false,
            //New Post
            s_org_by:'',
            org_bys:['Self','Other'],
            s_spon_by:'',
            spon_bys:['Self','Other'],
            s_duration_unit:'',
            duration_units:['Hours','Days','Weeks','Months','Years']
      },
      methods: {
        //
      }
    })
  </script>
</body>
</html>