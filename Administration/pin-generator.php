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


$pageActiveTag5="pin manager";
$currentPageTag="generate pin";


if($pageActiveTag5="pin manager"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="";
    $ExpandSiteManager="";
    $ExpandPinManager="is-expanded";

    


}

if($currentPageTag="generate pin"){
  
  $pinGeneratorCurrentPageTag="active";
  $allPinCurrentPageTag="";
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
  $allSubjectCurrentPageTag="";
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



<?php if($pinManagement!="YES")
{
    header("Location: index.php" );
exit;
}
?>

<?php

if(isset($_POST['save'])){
  $number=$_POST['number'];
  $update_pin_number_of_times_query = $con->prepare("UPDATE sitemanager SET content_for_integer =? WHERE tag = 'pin_number_of_times'");
  $update_pin_number_of_times_query->bind_param("i", $number); 

  if($number!==""){
  $update_pin_number_of_times_query->execute();     
  }                       
 
  
  


}
?>

<?php 

   $pin_number_of_times_query= $con->prepare("SELECT content_for_integer FROM sitemanager  WHERE tag = 'pin_number_of_times'");
  
   $pin_number_of_times_query->execute();                            
   $pin_number_of_times_query->Store_result();                       
   $pin_number_of_times_query->bind_result($pin_number_of_times);  
   $pin_number_of_times_query->fetch();
   $pin_number_of_times_query->close();
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
    <title>Generate Pin</title>
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
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Generate Pin</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <form class="form" id="kt_form_1" method="post" action="pin-generator-suc.php">
          <li>	<input type="submit" name="generate_pin" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:800px; width:200px" value="Generate Pins"/></li>
          
          </form>
        </ul>
      </div>



     
      <div class="row" style="width:45%; margin-left:22%">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <form method="post">  
                     <table class="table table-hover table-bordered table-striped" style="width:500px; margin-left:80px">
                
               
                <tbody>
               


                <tr>
                
                
                
                
                
               </td>
                </tr>
                 <tr>
                <td> Pin Valid Time</td>
                <td><input name="number"  class="form-control form-control-lg form-control-solid" style="width:100px;margin-left:50px" type="text" value="<?php echo $pin_number_of_times;?>"/></td>
                </tr>
                

                








                </tbody>

                </table>
                          
                          <input type="submit" name="save"  value="Save" class="btn btn-primary" style="width:230px;margin-left:200px"/>  
                     </form>  
              
              
															
																
              </div>
                                                            

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
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>

     <!--begin::Global Theme Bundle(used by all pages)-->
     <script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
       
       <script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
       <script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
       
       <!--end::Global Theme Bundle-->
       



<!--begin::Page Vendors(used by this page)-->
<script src="external/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="external/js/pages/crud/datatables/extensions/buttons526f.js?v=7.0.8"></script>
<!--end::Page Scripts-->
  </body>
</html>






