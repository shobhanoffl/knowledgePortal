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
    <link href="assets/app/css/settings-options.css" rel="stylesheet">
    <link href="assets/app/css/edit-profile.css" rel="stylesheet">
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
  height: 100vh; 
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
    Change Background
  </div>
</center>
<!-- SETTINGS OPTIONS -->
<form action="display.php" method="Post" enctype="multipart/form-data">
    <div class="element-wrap">
    <v-select name="new_bg" v-model="background" :items="backgrounds" item-text="caption" item-value="link" label="Background" prepend-icon="mdi-image-area" required></v-select>
    <div class="editprofile-btns">
        <button class="update-btn" type="submit" name="chg_bg_btn">Change</button>
        <span class="update-link"><a style="text-decoration: none;" href="settings.php">Back</a></span>
    </div>
    </div>
</form>
<!-- SETTINGS OPTIONS -->
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
            // Settings Options
            optionnames: [
                {icon:'mdi-account-edit',opname:'Edit Profile',link:'editprofile.php'},
                {icon:'mdi-lock',opname:'Change Password',link:'changepass.php'},
                {icon:'mdi-wallpaper',opname:'Display',link:'display.php'}
            ],
            background:'<?php echo $p_display[0]; ?>',
            backgrounds:[
            {caption:'Default', link:'assets/user/display/default.jpg'},
            {caption:'Mild Gradient', link:'assets/user/display/mild.jpg'},
            {caption:'Violet Sky - Iceland', link:'assets/user/display/violet.jpg'},
            {caption:'Sunset - Mexico', link:'assets/user/display/sunset.jpg'},
            {caption:'Antelope Canyon - USA', link:'assets/user/display/antelope.jfif'},
            {caption:'Bettmerhorn - Switzerland', link:'assets/user/display/bettmerhorn.jfif'},
            {caption:'Quiraing - UK', link:'assets/user/display/quiraing.jfif'},
            {caption:'Waterfall - Iceland', link:'assets/user/display/waterfall.jfif'},
            {caption:'Yosemite National Park - USA', link:'assets/user/display/yosemite.jfif'}]
      },
      methods: {
        //
      }
    })
  </script>
</body>
</html>