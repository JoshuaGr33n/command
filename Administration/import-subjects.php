<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


//database connection
include('include/db.php');





?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag="All Students";
$currentPageTag="All Subject";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
  $ExpandAdmin="";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";
  


}








if($currentPageTag="All Subject"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="";

  $allSubjectCurrentPageTag="active";
  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";



}







?>

<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES" && $addEditStudentM !="YES")
{
    header("Location: index.php" );
exit;
}
?>



<?php

//output all from classes table
        $allSubjectsQuery = "SELECT * FROM subjects";
        $allSubjectsResult = mysqli_query($con, $allSubjectsQuery);
	
?>






<?php// if(isset($_POST['subupdate']))
//{

    //$updateClass="Update classes set className ='".$_POST['fname']."'
    //where student_id='".$student_id."'";

//}
  ?> 
  <?php 

$insertQuery="";

if(isset($_POST['submit']))


{

  $addNew = $_POST['addNew'];




  $check = "SELECT * FROM subjects where subjectName = '".$addNew."'";
  $rs = mysqli_query($con, $check);
  //$data = mysqli_fetch_array($rs, MYSQLI_NUM);
  $num_rows =mysqli_num_rows($rs);
  $data=mysqli_fetch_array($rs);
  
  
  
  




  if( $addNew != $data['subjectName'])
  {
  $insertQuery = "INSERT INTO subjects (subjectName) VALUES
  ('".$addNew."')";
  }
  
    
  
 



  
 $insertResult ="";
  
 if($insertQuery)
 
 
 {
 
     $insertResult = mysqli_query($con, $insertQuery);

     
 }
 
 if( $insertResult)
   {
       
    
    header("Location:all-subjects.php" );
    exit;

   }
   else{

   
   }
 
 
 

}
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="description" content="">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <title>Import Subjects</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
 <!--begin::Global Theme Styles(used by all pages)-->
    
 <link href="other.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->


    
		
    


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">





    



<!--edit and delete form script-->

<script language="javascript" src="formjs/all-subjects.js" type="text/javascript"></script>
<!--edit and delete form script-->







<!--check all boxes script-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<SCRIPT language="javascript">

    $(function () {

        // add multiple select / deselect functionality

        $("#selectall").click(function () {

            $('.name').attr('checked', this.checked);

        });

 

        // if all checkbox are selected, then check the select all checkbox

        // and viceversa

        $(".name").click(function () {

 

            if ($(".name").length == $(".name:checked").length) {

                $("#selectall").attr("checked", "checked");

            } else {

                $("#selectall").removeAttr("checked");

            }

 

        });

    });

</SCRIPT>




<!--modal-->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--modal-->




      </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
      <div>
          <h1><i class="fa fa-th-list"></i> All Subject</h1>
          <p></p>
        </div>


        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          
          <li> <form method="post" action="exports/all-subjects-export.php">
          <button name="export" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export in Excel</button>
          </form></li>
          



        
           <li class="breadcrumb-item"><a href="all-subjects.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1"  style="margin-right:10px;">Back</a></li>



          
          
        </ul>



      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="card card-custom example example-compact">
											<div class="card-header">
												<h3 class="card-title">
                        <?php if (isset ($_GET['wrongformat'])){
            echo $_GET['wrongformat']; }?>
                                            </h3>
            <div class="tile-body">
              <div class="table-responsive">    <form method="post" action="all-subjects-import.php" name="upload_excel" enctype="multipart/form-data">
              
                                                   <div class="form-group row" action="all-subjects-import.php">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Import Excel File *</label>
														<div class="col-lg-6 col-md-6 col-sm-12">
															<input type="file" name="import" id="import" accept=".csv" class="form-control form-control-lg form-control-solid"/>
															<span class="form-text text-muted"></span>
														</div>
                                                    </div>
                                                    

                                                    <div class="card-footer">
													<div class="row">
														<div class="col-lg-9 ml-lg-auto">
															<input type="submit" class="btn btn-primary font-weight-bold mr-2" name="import_subjects" value="Import"/>
															
														</div>
													</div>
                                                </div>
                                              </form>


                
              </div>
            </div>
          </div>
        </div>
      </div>







      
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    

    <script type="text/javascript" src="js/plugins/dropzone.js"></script>
  </body>
</html>


<script src="js/classedit/bootstable.js"></script>
<script src="js/classedit/editable.js"></script>