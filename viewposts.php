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
  header('location: home.php?msg=Unauthorized+Access&getPosts=journal');
  exit();
}
?>
<!doctype html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="assets/app/css/app-nav-bar.css" rel="stylesheet">
<link href="assets/app/css/nav-title.css" rel="stylesheet">
<link href="assets/app/css/search-filter.css" rel="stylesheet">
<link href="assets/app/css/edit-profile.css" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<title>Admin Panel</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Style -->
<style type="text/css">
	body{
        background: url('<?php echo $p_display[0]; ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
		font-family: "Roboto Condensed", Helvetica, sans-serif;
    }
	.container { margin: 150px auto; max-width: -webkit-fill-available; }
	a {
		text-decoration: none;
	}
	table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 20px;
		margin-bottom: 20px;
		background-color:white;

    	overflow-x: auto;
    	white-space: nowrap;
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
	.tablemanager th.disableSort{
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
	.update-btn{
    background: #3d83e4;
    padding: 10px 14px;
    color: white;
    font-weight: 500;
    border-radius: 30px;
    border: 2px solid #3d83e4;
	cursor: pointer;
}
.update-btn:hover{
    background-color: white;
    color: #3d83e4;
    border: 2px solid #3d83e4;
}
</style>
</head>

<!-- TABLE -->
<br><br><br>
<center>  
	<div class="page-title">
		Admin Page
	</div><br><br><br>
</center>

<!-- TITLE & NAVIGATION -->

<div class="table-wrap container"  style="margin-top:-30px; background-color:white;">
<p class="profile-user-name">
	<?php if(isset($_GET['getPosts'])){
		if(($_GET['getPosts']=="it") || ($_GET['getPosts']=="fdp")){
			echo strtoupper($_GET['getPosts']);
		}else{
			echo ucwords($_GET['getPosts']."s");
		}
	 } ?>
</p>
<label for="typeOf">Select Type of Data to Display:</label>
		<select id="typeOf" name="typeOf" onchange="checkType()" selected="Select the Type of Data">
  			<option value="Select the Type of Data">Select</option>
  			<option value="journal">Journals</option>
  			<option value="seminar">Seminars</option>
  			<option value="workshop">Workshop</option>
  			<option value="course">Course</option>
  			<option value="project">Project</option>
  			<option value="it">IT</option>
  			<option value="hackathon">Hackathon</option>
  			<option value="fdp">FDP</option>
		</select>
		<br><br>
	<div style="display:flex;">
		<form action="adminpanel.php"> 
			<button class="update-btn" type="submit">View Users</button>&nbsp;&nbsp;
		</form>
		<form action="adminpanel.php" style="float:left;"> 
			<button class="update-btn" type="submit">Back</button> 
		</form>
	</div>
	<!-- Table start -->
    <table class="tablemanager" id="postsPage">
    	<thead>
    		<tr>
			<!-- Journal  -->
			<?php if(isset($rowSet[0]['jno'])){ ?>
				<th>Name</th>
				<th>Title</th>
				<th>Date</th>
				<th>Coauthor</th>
				<th>Journal Name</th>
				<th>Publisher</th>
				<th>Publisher URL</th>
				<th>Volume No</th>
				<th>Issue No</th>
				<th>Page No</th>
				<th>Date of Issue</th>
				<th>First Impact Factor</th>
				<th>Indexing</th>
			<?php } ?>
			<!-- Course  -->
			<?php if(isset($rowSet[0]['cno'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Course</th>
				<th>Domain</th>
				<th>Company</th>
				<th>Date of Completion</th>
				<th>Duration</th>
				<th>Unit</th>
			<?php } ?>
			<!-- FDP  -->
			<?php if(isset($rowSet[0]['fno'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Title</th>
				<th>Organized By</th>
				<th>Sponsored By</th>
				<th>Venue</th>
				<th>Duration</th>
				<th>Unit</th>
			<?php } ?>
			<!-- Hackathons -->
			<?php if(isset($rowSet[0]['hno'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Title</th>
				<th>Organized By</th>
				<th>Sponsored By</th>
				<th>Members</th>
				<th>Duration</th>
				<th>D.O Commencement</th>
				<th>D.O Completion</th>
			<?php } ?>
			<!-- Projects -->
			<?php if(isset($rowSet[0]['prno'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Title</th>
				<th>Domain</th>
				<th>Members</th>
				<th>Sponsored By</th>
				<th>Cost</th>
				<th>Status</th>
				<th>D.O Commencement</th>
				<th>D.O Completion</th>
				<th>Duration</th>
				<th>Unit</th>
			<?php } ?>
			<!-- ITs -->
			<?php if(isset($rowSet[0]['ino'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Title</th>
				<th>Industry</th>
				<th>Training Field</th>
				<th>Duration</th>
				<th>Unit</th>
				<th>D.O Commencement</th>
				<th>D.O Completion</th>
			<?php } ?>
			<!-- Seminars  -->
			<?php if(isset($rowSet[0]['sno'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Title</th>
				<th>Organized By</th>
				<th>Sponsored By</th>
				<th>Venue</th>
				<th>Duration</th>
				<th>Unit</th>
				<th>Resource Person Name</th>
				<th>R.P Designation</th>
				<th>R.P Institution</th>
			<?php } ?>
			<!-- Workshops  -->
			<?php if(isset($rowSet[0]['wno'])){ ?>
				<th>Name</th>
				<th>Date</th>
				<th>Title</th>
				<th>Organized By</th>
				<th>Sponsored By</th>
				<th>Venue</th>
				<th>Duration</th>
				<th>Unit</th>
				<th>Resource Person Name</th>
				<th>R.P Designation</th>
				<th>R.P Institution</th>
			<?php } ?>
			</tr>
    	</thead>
		<tbody>
			<!-- Journal  -->
			<?php if(isset($rowSet[0]['jno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
				<td><?php echo $rowSet[$j]['coauth']; ?></td>
				<td><?php echo $rowSet[$j]['jname']; ?></td>
				<td><?php echo $rowSet[$j]['publisher']; ?></td>
				<td><?php echo $rowSet[$j]['pub_url']; ?></td>
				<td><?php echo $rowSet[$j]['vol_no']; ?></td>
				<td><?php echo $rowSet[$j]['issue_no']; ?></td>
				<td><?php echo $rowSet[$j]['page_no']; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['do_issue']); ?></td>
				<td><?php echo $rowSet[$j]['imp_factor']; ?></td>
				<td><?php echo $rowSet[$j]['indexing']; ?></td>
				</tr>
            <?php endfor; } ?>
			<!-- Course  -->
			<?php if(isset($rowSet[0]['cno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
					<td><?php echo $post_uname_dyn[$j]; ?></td>
            	<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['name']; ?></td>
            	<td><?php echo $rowSet[$j]['domain']; ?></td>
            	<td><?php echo ($rowSet[$j]['company']!='Other') ? $rowSet[$j]['company'] : $rowSet[$j]['company_f'] ; ?></td>
            	<td><?php echo date('d-m-Y',$rowSet[$j]['enddt']); ?></td>
            	<td><?php echo $rowSet[$j]['length']; ?></td>
            	<td><?php echo $rowSet[$j]['unit']; ?></td>
				</tr>
            <?php endfor; } ?>
			<!-- FDPs  -->
			<?php if(isset($rowSet[0]['fno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo ($rowSet[$j]['org_by']!='Other') ? $rowSet[$j]['org_by'] : $rowSet[$j]['org_by_f'] ; ?></td>
				<td><?php echo ($rowSet[$j]['spon_by']!='Other') ? $rowSet[$j]['spon_by'] : $rowSet[$j]['spon_by_f'] ; ?></td>
				<td><?php echo $rowSet[$j]['venue']; ?></td>
				<td><?php echo $rowSet[$j]['duration']; ?></td>
				<td><?php echo $rowSet[$j]['unit']; ?></td>
				</tr>
            <?php endfor; } ?>
			<!-- Hackathons  -->
			<?php if(isset($rowSet[0]['hno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo ($rowSet[$j]['org_by']!='Other') ? $rowSet[$j]['org_by'] : $rowSet[$j]['org_by_f'] ; ?></td>
				<td><?php echo ($rowSet[$j]['spon_by']!='Other') ? $rowSet[$j]['spon_by'] : $rowSet[$j]['spon_by_f'] ; ?></td>
				<td><?php echo $rowSet[$j]['members']; ?></td>
				<td><?php echo $rowSet[$j]['duration']; ?></td>
				<td><?php echo $rowSet[$j]['startdt']; ?></td>
				<td><?php echo $rowSet[$j]['enddt']; ?></td>
				</tr>
            <?php endfor; } ?>
			<!-- Projects  -->
			<?php if(isset($rowSet[0]['prno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo $rowSet[$j]['domain']; ?></td>
				<td><?php echo $rowSet[$j]['members']; ?></td>
				<td><?php echo ($rowSet[$j]['spon_by']!='Other') ? $rowSet[$j]['spon_by'] : $rowSet[$j]['spon_by_f'] ; ?></td>
				<td><?php echo $rowSet[$j]['cost']; ?></td>
				<td><?php echo $rowSet[$j]['status']; ?></td>
				<td><?php echo $rowSet[$j]['startdt']; ?></td>
				<td><?php echo $rowSet[$j]['enddt']; ?></td>
				<td><?php echo $rowSet[$j]['duration']; ?></td>
				<td>Days</td>
				</tr>
            <?php endfor; } ?>
			<!-- ITs -->
			<?php if(isset($rowSet[0]['ino'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo $rowSet[$j]['ind_name']; ?></td>
				<td><?php echo $rowSet[$j]['training_field']; ?></td>
				<td><?php echo $rowSet[$j]['duration']; ?></td>
				<td>Days</td>
				<td><?php echo $rowSet[$j]['startdt']; ?></td>
				<td><?php echo $rowSet[$j]['enddt']; ?></td>
				</tr>
            <?php endfor; } ?>
			<!-- Seminars  -->
			<?php if(isset($rowSet[0]['sno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo ($rowSet[$j]['org_by']!='Other') ? $rowSet[$j]['org_by'] : $rowSet[$j]['org_by_f'] ; ?></td>
				<td><?php echo ($rowSet[$j]['spon_by']!='Other') ? $rowSet[$j]['spon_by'] : $rowSet[$j]['spon_by_f'] ; ?></td>
				<td><?php echo $rowSet[$j]['venue']; ?></td>
				<td><?php echo $rowSet[$j]['duration']; ?></td>
				<td>Days</td>
				<td><?php echo $rowSet[$j]['res_name']; ?></td>
				<td><?php echo $rowSet[$j]['res_design']; ?></td>
				<td><?php echo $rowSet[$j]['res_insti']; ?></td>
				</tr>
            <?php endfor; } ?>
			<!-- Workshops  -->
			<?php if(isset($rowSet[0]['wno'])){ for ($j = 0; $j < count($rowSet); $j+=1): ?>
				<tr>
				<td><?php echo $post_uname_dyn[$j]; ?></td>
				<td><?php echo date('d-m-Y',$rowSet[$j]['date']); ?></td>
            	<td><?php echo $rowSet[$j]['title']; ?></td>
				<td><?php echo ($rowSet[$j]['org_by']!='Other') ? $rowSet[$j]['org_by'] : $rowSet[$j]['org_by_f'] ; ?></td>
				<td><?php echo ($rowSet[$j]['spon_by']!='Other') ? $rowSet[$j]['spon_by'] : $rowSet[$j]['spon_by_f'] ; ?></td>
				<td><?php echo $rowSet[$j]['venue']; ?></td>
				<td><?php echo $rowSet[$j]['duration']; ?></td>
				<td><?php echo $rowSet[$j]['unit']; ?></td>
				<td><?php echo $rowSet[$j]['res_name']; ?></td>
				<td><?php echo $rowSet[$j]['res_design']; ?></td>
				<td><?php echo $rowSet[$j]['res_insti']; ?></td>
				</tr>
            <?php endfor; } ?>
			

		</tbody>
	</table>
	<br>
	<span class="update-btn" id="csvbtn">Export to CSV</span>
	<span class="update-btn" id="jsonbtn">Export to JSON</span>

</div>
    <!-- External jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/app/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="assets/app/js/tableManager.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script> -->
	<script type="text/javascript" src="assets/app/js/tableHTMLExport.js"></script>
	<script type="text/javascript">
		// Table Manager
		$('.tablemanager').tablemanager({
			firstSort: [[3,0],[2,0],[1,'asc']],
			appendFilterby: true,
			
			<?php if(isset($rowSet[0]['jno'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			dateFormat: [[11,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['cno'])){ ?>
			dateFormat: [[1,"dd-mm-yyyy"]],
			dateFormat: [[6,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['fno'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['hno'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			dateFormat: [[8,"dd-mm-yyyy"]],
			dateFormat: [[9,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['prno'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			dateFormat: [[8,"dd-mm-yyyy"]],
			dateFormat: [[9,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['ino'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			dateFormat: [[8,"dd-mm-yyyy"]],
			dateFormat: [[9,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['ino'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			<?php } ?>

			<?php if(isset($rowSet[0]['wno'])){ ?>
			dateFormat: [[2,"dd-mm-yyyy"]],
			<?php } ?>

			debug: true,
			vocabulary: {
    			voc_filter_by: 'Filter By',
    			voc_type_here_filter: 'Search...',
    			voc_show_rows: 'Rows Per Page'
  			},
			pagination: true,
			showrows: [10,25,50,75,100],
			disableFilterBy: [1]
		});

		// Exporting to JSON
		$("#jsonbtn").click(function(){
			$("#postsPage").tableHTMLExport({
				type:'json',
				filename:'Export.json'
			});
		})
		// Exporting to PDF
		$("#pdfbtn").click(function(){
			$("#postsPage").tableHTMLExport({
				type:'pdf',
				filename:'Export.pdf'
			});
		})
		// Exporting to CSV
		$("#csvbtn").click(function(){
			$("#postsPage").tableHTMLExport({
				type:'csv',
				filename:'Export.csv'
			});
		})

		// Change Type of Data to be Displayed
		function checkType(){
			typeVal = document.getElementById("typeOf").value;
			window.location = "viewposts.php?getPosts="+typeVal;
		};
		
	</script>
</body>
</html>
