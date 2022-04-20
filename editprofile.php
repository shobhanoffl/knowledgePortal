<?php
include('handling/auth.php');
include('handling/redirect.php');
include('handling/write.php');
include('handling/read.php');
if(!isset($_SESSION['reg_clgid']) || empty($_SESSION['reg_clgid'])){
  header('location: index.php?msg=Logged+Out+Successfully');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="assets/app/css/nav-title.css" rel="stylesheet">
    <link href="assets/app/css/app-nav-bar.css" rel="stylesheet">
    <link href="assets/app/css/edit-profile.css" rel="stylesheet">
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
<br><center>  
  <div class="page-title">
    Edit Profile
  </div>
</center>
<!-- EDIT PROFILE -->
<div class="editprofile-wrap">
  <div class="profile">
      <form action="editprofile.php" method="Post" enctype="multipart/form-data">
			<div class="profile-image">
      <?php if($p_dp[0]){ ?>
        <img src="<?php echo $p_dp[0]; ?>" alt="">
      <?php } else { ?>
        <img src="assets/user/images/placeholder.jpg" alt="">
      <?php } ?>
      <center>
      <div class="update-link" style="color:black;font-weight:normal;">
      <input type="file" name="image" accept="image/png,image/jpeg">
      </div>
      </center>
		</div>

		<div class="profile-user-settings">
      <div class="update-link-text">Basic Info</div>
			<v-text-field name="p_name" v-model="fullname" :counter="40" label="Name" prepend-icon="mdi-account-edit" required></v-text-field>
			<v-text-field name="p_clgid" v-model="clgid" label="College ID" prepend-icon="mdi-circle-edit-outline" readonly required></v-text-field>
			<p class="profile-dept-btn" style="margin-top:12px;">
        <v-select name="p_dept" v-model="selecteddept" :items="depts" label="Department" prepend-icon="mdi-account-details" required></v-select>
        <p><v-select name="p_design" v-model="selectedtitle" :items="titles" label="Designation" prepend-icon="mdi-shield-star" required></v-select></p>
      </p>
      
		</div>

		<div class="profile-bio">
    <div class="update-link-text">Other Info</div>
			<p><v-text-field name="p_email" v-model="email" label="Email" prepend-icon="mdi-email-edit" required></v-text-field></p>
      <v-text-field name="p_phone" v-model="phone" label="Phone" prepend-icon="mdi-phone" required></v-text-field>
		</div>

    <div class="editprofile-btns">
        <button class="update-btn" type="submit" name="editprofile_btn">Update</button>
        <span class="update-link"><a style="text-decoration: none;" href="settings.php">Cancel</a></span>
    </div>
  </form><br><br>
</div>
</div>
<!-- EDIT PROFILE -->
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
            // Snackbar
            <?php if (isset($_GET['msg'])){ ?>
              snackbar: true,
              timeout: 4000,
            <?php } ?>
            // Edit Profile
            selecteddept:'<?php if ($p_dept){ echo $p_dept[0]; } ?>',
            depts: ['Mechanical Engineering','Mechatronics Engineering','Electrical & Electronics Engineering',
            'Electronics & Communication Engineering','Bio Medical Engineering','Computer Science & Engineering',
            'Information Technology','Civil Engineering','Fashion Technology','Master of Business Administration',
            'Master of Computer Applications','Mathematics','Science','English','General Engineering'],
            fullname:'<?php if ($p_name){ echo $p_name[0]; } ?>',
            clgid:'<?php echo $_SESSION['reg_clgid']; ?>',
            dept:'<?php if ($p_dept){ echo $p_dept[0]; } ?>',
            selectedtitle:'<?php if ($p_design){ echo $p_design[0]; } ?>',
            titles: ['Associate Professor','Assistant Professor','Professor','Professor & HOD','HOD'],
            selectedbg:'<?php if ($p_email){ echo $p_email[0]; } ?>',
            email:'<?php if ($p_email){ echo $p_email[0]; } ?>',
            phone:'<?php if ($p_phone){ echo $p_phone[0]; } ?>'
      },
      methods: {
        //
      }
    })
  </script>
</body>
</html>