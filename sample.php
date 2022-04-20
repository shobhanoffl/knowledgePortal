<!-- POST TEMPLATE -->

<?php
if(count($jno)<1){ ?>
  <span class="update-link" style="color:black;padding:35px 2px;">No Posts to Show!</span>
<?php } ?>

<?php for ($i = 0; $i < count($jno); $i+=1): ?>
    <div class="post-wrap">
    <div class="post-header">
        <img src="<?php echo $post_udp[$i]; ?>" class="avator post-img">

        <div class="post-header-info">
            <div class="post-header-line-one">
              <span class="location-link mintext">&nbsp;
                <!-- <v-icon small>mdi-map-marker</v-icon>  -->
              </span>
              <span style="float:right;margin-right: 10px;" class="mintext">
              <?php 
              echo date("d M Y", $date[$i]); 
              ?>
              </span>
            </div>
            &nbsp;<div style="margin-top:6px;margin-left:1px;display:inline-block;font-size:16px;">
            <a href="profile.php?profile=<?php echo $post_clgid[$i]; ?>" class="link-to-profile" style="color: black;">
            <?php echo $post_uname[$i]; ?>
            </a>
            </div> 
            &nbsp;·
            <!-- <span class="mintext"> -->
            <?php
            //if($post_type[$i]=='Usual'){
            //  echo 'Published a Post'; }
            //elseif($post_type[$i]=='Seminar' OR $post_type[$i]=='Workshop' OR $post_type[$i]=='Hackathon'){
            //  echo 'Attended a '.$post_type[$i]; }
            //elseif($post_type[$i]=='IT'OR $post_type[$i]=='FDP'){
            //  echo 'Attended a '.$post_type[$i],' Program'; }
            //else{
            //  echo 'Completed a '.$post_type[$i]; }
            ?>
            <!-- </span> -->

            <p class="post-caption">
            <?php echo $title[$i]; ?>
            </p>

        </div>
    </div>

    <?php $post_image_arr=explode(",",$image[$i]); ?>
    <?php if($image[$i]!='assets/posts/images/' AND $image[$i]!=''){ ?>
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
      <?php $post_document_arr=explode(",",$document[$i]); ?>
    <?php if($document[$i]!='assets/posts/documents/' AND $document[$i]!=''){ ?>
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
      <?php $post_video_arr=explode(",",$video[$i]); ?>
    <?php if($video[$i]!='assets/posts/videos/' AND $video[$i]!=''){ ?>
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
          <a href="home.php?delete=<?php echo $jno[$i]; ?>" style="color: red;text-decoration: none;">
            <v-list-item-title>
            <v-icon dense style="vertical-align:top;" color="red">
              mdi-trash-can-outline
            </v-icon>  Delete
            </v-list-item-title>
          </a>
        </v-list-item>
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
















<!-- Retriving -->



<?php 
echo $rowSet[1]["jno"];
?>