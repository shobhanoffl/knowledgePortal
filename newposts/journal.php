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
    Journal
  </div>
</center>
<br>
<!-- NEW POST -->
<div class="editprofile-wrap">
  <div class="profile">
      <form action="../home.php?getPosts=journal" method="Post" enctype="multipart/form-data">

		<div class="profile-user-settings">
      <div class="update-link-text">Basic Info</div>
        <v-text-field name="post_title" v-model="post_title" label="Title" prepend-icon="mdi-format-title" required></v-text-field>
        <v-select name="author_posi" v-model="s_author_posi" :items="author_posis" label="Author Positions" prepend-icon="mdi-typewriter" required></v-select>
		<v-text-field name="coauthor" v-model="coauthor" label="Co-Author" prepend-icon="mdi-book" required></v-text-field>
		<v-text-field name="journal_name" v-model="journal_name" label="Journal Name" prepend-icon="mdi-newspaper-variant" required></v-text-field>
		<v-text-field name="vol_no" v-model="vol_no" label="Volume Number" prepend-icon="mdi-numeric-1-box-multiple-outline" required></v-text-field>
		<v-text-field name="issue_no" v-model="issue_no" label="Issue Number" prepend-icon="mdi-numeric-2-box-multiple-outline" required></v-text-field>
		<v-text-field name="page_no" v-model="page_no" label="Page Number" prepend-icon="mdi-numeric-3-box-multiple-outline" required></v-text-field>
		<v-text-field name="do_issue" v-model="do_issue" label="Date of Issue" prepend-icon="mdi-calendar-range" type="date" required></v-text-field>
		<v-text-field name="imp_factor" v-model="imp_factor" label="Impact Factor" prepend-icon="mdi-numeric" required></v-text-field>
		<v-text-field name="publisher" v-model="publisher" label="Publisher" prepend-icon="mdi-newspaper" required></v-text-field>
		<v-text-field name="publisher_url" v-model="publisher_url" label="Publisher URL (Link)" prepend-icon="mdi-link" required></v-text-field>
		<v-select name="indexing" v-model="s_indexing" :items="indexings" label="Indexing" prepend-icon="mdi-chevron-triple-up" required></v-select>
      
		</div>
        <br>
		<div class="profile-bio">
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
        <button class="update-btn" type="submit" name="newjournal_btn">Post</button>
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
            s_author_posi:'',
            author_posis:['1st','2nd','3rd'],
            s_indexing:'',
            indexings:['Yes','No']
      },
      methods: {
        //
      }
    })
  </script>
</body>
</html>