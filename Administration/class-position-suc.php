<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if(  $_SESSION['searchPositionSession'] =="")
{
header("Location: class-position.php" );
exit;
}


include('include/db.php');





?>

<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag="All Students";
$currentPageTag="class-position";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="";
   $ExpandPinManager="";


}








if($currentPageTag="class-position"){
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
  $classPositionCurrentPageTag="active";
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



<?php 

if($studentManagement!="YES")
{
  header("Location: index.php" );
  exit;
}

$score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");

?>





<?php

//search results table

    $searchresultQuery = "SELECT StudentReg, Sno, StudentID, SUM(Total) AS TotalTotal, SUM(Average) AS sum_average FROM results where Class ='". $_SESSION['searchPositionClass']."' And school_session ='".$_SESSION['searchPositionSession']."' AND Term ='".$_SESSION['searchPositionTerm']."'
    
    GROUP BY StudentReg   ORDER BY sum_average DESC";
    $searchresultResult = mysqli_query($con, $searchresultQuery);
	
	
$class=$_SESSION['searchPositionClass'];
$session=$_SESSION['searchPositionSession'];
$term=$_SESSION['searchPositionTerm'];



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
    <title>Class Position</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Global Theme Styles(used by all pages)-->
    
		<link href="other.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->



<!--edit and delete form script-->

<script language="javascript" src="formjs/results-suc.js" type="text/javascript"></script>
<!--edit and delete form script-->




<!--checkbox select all-->
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
  <!--checkbox select all-->  


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
          <h1><i class="fa fa-th-list"></i>  Class Position For:</h3> <?php echo $_SESSION['searchPositionClass'];?>-<?php echo $_SESSION['searchPositionSession'];?>-<?php echo $_SESSION['searchPositionTerm'];?> Term </h3>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li class="breadcrumb-item active"><a href="class-position.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
         
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">

              
              

                  

                   


                  


                   

                   
                   


                   
                  
																
                    

                  



            
                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                
                  <thead>
                    <tr>
                   
                      <th>Student Reg Number</th>
                      <th>Name</th>
                      <th>Total Average Scores</th>
                      <th>Position in Class</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                 

                            
                  foreach ($searchresultResult as $searchresultRow) 
                   {
                   //output all from students table
                   $sno =$searchresultRow['Sno']; 
                    $student_id =$searchresultRow['StudentID']; 
                    $student_reg =$searchresultRow['StudentReg']; 
                    $ave =$searchresultRow['sum_average'];
                    $ave2 =$searchresultRow['TotalTotal']/4;


                    
                    $studentDetailQuery = "SELECT * FROM students where student_id= '".$student_id."'";
                   $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                   
                   $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                  
                   $fname = $studentDetailrow['FirstName'];
                   $mName = $studentDetailrow['MiddleName'];
                   $lname = $studentDetailrow['LastName'];
                  






                    
   
                  
                  

                   
                   
                   
                   
                   
            
                   
                   			
                  
                     ?>
                    <tr>
                   
                      <td><a href="student-details.php?studentID=<?php echo $student_id;?>" style="text-decoration:none"><?php echo $student_reg;?></a></td>
                      <td><?php echo $fname;?> <?php echo $mName;?> <?php echo $lname;?> </td>
                      <td><?php echo $ave;?></td>
                      <td><strong><?php
 
 $check_res  = "
     SELECT StudentReg, SUM(Average) AS sum_ave
     FROM `results` 
     WHERE school_session = '$session'
         AND Term = '$term'
         AND class = '$class' 
         GROUP BY StudentID
         order by sum_ave DESC
         
        
        
       
 ";
 
 $queryPos  = $con->prepare($check_res);                                    // Prepare the query
// $query->bind_param("iiii", $session, $term, $class, $subjectID); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
$queryPos->execute();                            // Run the query
$queryPos->Store_result();                       // Store the result set
$queryPos->bind_result($studentreg, $sum_ave);   // Bind returned rows to variables
 
$counter = 1; // init absolute counter
$rank = 1; // init rank counter
//$score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
// initial "previous" score:
$prevScore = 0;


  

while($queryPos->fetch()){
    // get "current" score
    $score = $sum_ave;

    if ($prevScore != $score) // if previous & current scores differ
        $rank = $counter;
        include('include/end.php');
    // else //same // do nothing

    if($student_reg == $studentreg){
   
    echo $rank.$end;
    

       
  
}
    $counter ++; // always increment absolute counter
    
    //current score becomes previous score for next loop iteration
    $prevScore = $score;

}
?></strong></td>
                     
                    </tr>
                   <?php    }?>

                   

                    
                    
                  </tbody>
                   
                </table>


             

                   </form>

                   
              </div>

              
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--handle conflict-->
    <script src='js/jquery-3.3.1.min.js'></script>
<script>
var jq132 = jQuery.noConflict();
</script>
<script src='external/plugins/global/plugins.bundle526f.js?v=7.0.8'></script>
<script>
var jq142 = jQuery.noConflict();
</script>
<!--handle conflict-->
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
  </body>
</html>


