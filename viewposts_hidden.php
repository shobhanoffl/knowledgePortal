<?php
include('handling/auth.php');
include('handling/redirect.php');
include('handling/write.php');
include('handling/read.php');
include('handling/admin.php');
if(!isset($_SESSION['reg_clgid']) || empty($_SESSION['reg_clgid'])){
  header('location: index.php?msg=Logged+Out+Successfully');
  exit();
}
if($p_suser[0]==0){
  header('location: home.php?access=unauthorized');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="assets/app/css/nav-title.css" rel="stylesheet">
    <link href="assets/app/css/app-nav-bar.css" rel="stylesheet">
    <link href="assets/app/css/search-filter.css" rel="stylesheet">
    <link href="assets/app/css/profile-search-result.css" rel="stylesheet">
    <link href="assets/app/css/sidepanel.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css " rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

		body {
			font-family: "Roboto Condensed", Helvetica, sans-serif;
			background-color: #f7f7f7;
		}
		.container { margin: 150px auto; max-width: 960px; }
		a {

			text-decoration: none;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			margin-bottom: 20px;
      background-color:white;
		}
		table, th, td {
		   border: 1px solid #bbb;
		   text-align: left;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		th {
			background-color: #ddd;
		}
		th,td {
			padding: 5px;
		}
		button {
			cursor: pointer;
		}
		/*Initial style sort*/
		.tablemanager th.sorterHeader {
			cursor: pointer;
		}
		.tablemanager th.sorterHeader:after {
			content: " \f0dc";
			font-family: "FontAwesome";
		}
		/*Style sort desc*/
		.tablemanager th.sortingDesc:after {
			content: " \f0dd";
			font-family: "FontAwesome";
		}
		/*Style sort asc*/
		.tablemanager th.sortingAsc:after {
			content: " \f0de";
			font-family: "FontAwesome";
		}
		/*Style disabled*/
		.tablemanager th.disableSort {

		}
		#for_numrows {
			padding: 10px;
			float: left;
		}
		#for_filter_by {
			padding: 10px;
			float: right;
		}
		#pagesControllers {
			display: block;
			text-align: center;
		}
	</style>
</head>
<body>
  <div id="app">
    <v-app>
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
<!-- SIDEPANEL -->
<!-- <input id="clicker" type="checkbox" />

<div class="panel-wrap">
  <div class="panel">
  <div>hEllow</div>
  </div>
</div> -->
<!-- SIDEPANEL -->
<!-- TABLE -->
<br><center>  
  <div class="page-title">
    Admin Page
  </div>
</center><br>

<!-- <div class="table-wrap">
  <form action="adminpanel.php"> 
    <button class="update-btn" type="submit">View Users</button> 
  </form><br>

  <v-card>
    <v-card-title>Search<v-spacer>
    </v-spacer>
      <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
    </v-card-title>
    <v-data-table :headers="headers" :items="data" item-key="name" :search="search" multi-sort >
      <template #item.date="{ value }">
        <?php echo date("d-m-Y",`{{value}}`); ?>
      </template>
      <template #item.do_issue="{ value }">
        <?php echo date("d-m-Y",`{{value}}`); ?>
      </template>
    </v-data-table>
  </v-card>
</div> -->

<div class="table-wrap-style">
<div class="container">
  <table class="tablemanager">
    <thead>
    		<tr>
				<th class="disableSort">Number</th>
				<th>&nbsp;First Name&nbsp;</th>
				<th>&nbsp;Last Name&nbsp;</th>
				<th>&nbsp;Date&nbsp;</th>
				<th>&nbsp;Points&nbsp;</th>
			</tr>
    </thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>Sara</td>
				<td>Jackson</td>
				<td>08-06-1989</td>
				<td>94</td>
			</tr>
			<tr>
				<td>2</td>
				<td>John</td>
				<td>Doe</td>
				<td>10-05-1987</td>
				<td>80</td>
			</tr>
		</tbody>
	</table>
  </div>
  </div>



<!-- TABLE -->
<!-- SEARCH & FILTER -->
<!-- <div class="newpost-wrap">
  <v-form>
    <div class="newpost-title"> <center>Search</center> <br>
      <form>
        <v-text-field label="Search" oulined><v-icon color="#3d83e4" style="cursor:pointer;" slot="prepend">mdi-magnify</v-icon></v-text-field>
        <v-select label="Sort by" v-model="selectedSort" :items="sortTypes" clearable><v-icon color="#3d83e4" style="cursor:pointer;" slot="prepend">mdi-sort</v-icon></v-select>
        <v-switch v-model="orderby" label="Order in Reverse"></v-switch>
      </form>
      <br>
        <center @click="expandBar=!expandBar" style="cursor:pointer;"><span style="padding-left:23px;">Filter</span>
        <span class="expand-icon" >
            <v-icon color="#3d83e4" style="cursor:pointer;" v-if="expandBar==false">mdi-arrow-down-drop-circle-outline</v-icon>
            <v-icon color="#3d83e4" style="cursor:pointer;" v-if="expandBar==true">mdi-arrow-up-drop-circle-outline</v-icon>
        </span>
      </center>
    </div>
    <div class="expandable-part" v-show="expandBar">
      <v-select label="Department" v-model="selectedDept" :items="deptTypes" attach chips multiple></v-select>
      <v-select label="Qualification" v-model="selectedQuali" :items="qualiTypes" attach chips multiple></v-select>
      <v-select label="Designation" v-model="selectedDesign" :items="designTypes" attach chips multiple></v-select>
      <v-select label="Category" v-model="selectedCateg" :items="categTypes" attach chips multiple></v-select>
      <v-select label="Class" v-model="selectedClass" :items="classTypes" attach chips multiple></v-select>
    </div><br>
    <div class="update-btn" style="cursor:pointer;">Apply and Search</div>
  </v-form>
</div> -->
<!-- SEARCH & FILTER -->
<BR></BR>
<!-- PROFILE SEARCH RESULT -->
<!-- <div class="profile-wrap">
    <div class="first-line">
        <img :src="profilePicURL" class="avator">
        <span class="profileName">{{profileName}}</span><br>
        <span class="mintext">{{profileStats}} Seminars</span>
    </div>
</div> -->
<!-- PROFILE SEARCH RESULT -->
    </v-app>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script type="text/javascript" src="assets/app/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/app/js/tableManager.js"></script>
  <script>
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      data:{
            // Nav Bar Show
            toShow : false,
            // Search & Filter
            expandBar:false,
            showAttach:false,
            newPost:'',
            postType:null,
            selectedSort:null,
            sortTypes:['Seminars','Courses','Workshops','Industrial Training',
            'Hackathons','Consultancy Projects','FDP','BG','Phone'],
            selectedDept:null,
            deptTypes:['IT','ADS'],
            selectedClass:null,
            classTypes:['A','B'],
            selectedQuali:null,
            qualiTypes:['B.Tech','B.E'],
            selectedDesign:null,
            designTypes:['Professor','Assistant Professor'],
            selectedCateg:null,
            categTypes:['Full Time','Other'],
            orderby:false,
            //  Profile Search Result
            profilePicURL:'https://pbs.twimg.com/profile_images/1295112038096629760/3eCOaKDb_400x400.jpg',
            profileName:'Shobhan',
            profileStats:'123',
            // Table
            search: '',
            headers: [
              // Journals
              {text:'Title',align:'start',value:'title'},
              {text:'Date',value:'date'},
              {text:'Name',value:'post_uname_dyn'},
              {text:'Coauthor',value:'coauth'},
              {text:'Journal Name',value:'jname'},
              {text:'Publisher',value:'publisher'},
              {text:'Publisher URL',value:'pub_url'},
              {text:'Volume No',value:'vol_no'},
              {text:'Issue No',value:'issue_no'},
              {text:'Page No',value:'page_no'},
              {text:'Date of Issue',value:'do_issue'},
              {text:'Impact Factor',value:'imp_factor'},
              {text:'Indexing',value:'indexing'},
            ],
            data: [
              <?php for ($j = 0; $j < count($rowSet); $j+=1): ?>{
                $rowSet[$j]['title'];
                $rowSet[$j]['date'];
                php echo $post_uname_dyn[$j];
                $rowSet[$j]['coauth'];
                $rowSet[$j]['jname'];
                $rowSet[$j]['publisher'];
                $rowSet[$j]['pub_url'];
                $rowSet[$j]['vol_no'];
                $rowSet[$j]['issue_no'];
                $rowSet[$j]['page_no'];
                $rowSet[$j]['do_issue'];
                $rowSet[$j]['imp_factor'];
                $rowSet[$j]['indexing'];
              },<?php endfor; ?>
            ]
      },
      methods: {
        //
      }
    })
  </script>
  <script type="text/javascript">
		// basic usage
		$('.tablemanager').tablemanager({
			// firstSort: [[3,0],[2,0],[1,'asc']],
			// disable: ["last"],
			appendFilterby: true,
			dateFormat: [[4,"dd-mm-yyyy"]],
			debug: true,
			vocabulary: {
        voc_filter_by: '<span style=""> Filter By </span>',
        voc_type_here_filter: 'Search',
        voc_show_rows: '<span>Rows Per Page</span>'
      },
			pagination: true,
			showrows: [5,10,25,50,100],
			disableFilterBy: [1]
		});
		// $('.tablemanager').tablemanager();
	</script>
</body>
</html>