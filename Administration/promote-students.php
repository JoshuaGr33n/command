<?php session_start();?>
<?php
if($_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if($_SESSION['promoteStudentSession'] =="")
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
$currentPageTag="promote-students";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="";
   $ExpandPinManager="";
  


}








if($currentPageTag="promote-students"){
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
  $promoteStudentsCurrentPageTag="active";
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


<?php 

if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}




?>


<?php

//output all from students table
       
        $allStudentResult = $con->query("SELECT * FROM `results` WHERE school_session ='".$_SESSION['promoteStudentSession']."' AND class ='".$_SESSION['promoteStudentClass']."' GROUP BY StudentID");
	
	




?>





<?php

//output all from classes table
        $allClassQuery = "SELECT * FROM classes";
        $allClassResult = mysqli_query($con, $allClassQuery);
	
        
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
    <title>Promote Students</title>
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

<!--checkbox select all-->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    
		
  <!--checkbox select all--> 
    

   
 
  <script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","promote.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>








<script>
function reverseUser(reverse) {
  if (reverse == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","promote.php?reverse="+reverse,true);
    xmlhttp.send();
  }
}
</script>






  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>
      

                   
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> <?php echo $_SESSION['promoteStudentSession'];?>--<?php echo $_SESSION['promoteStudentClass'];?></h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->


          
         



          <li><a href="promoted-students.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:700px;">Promoted Students</a></li>
          <li><a href="select-promote-student-category.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>




         

        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <form>
          <li><button type="submit" id="submit" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:700px;">Apply</button>
          </form>

               
             
              

                  

                   


                  


                   

                   
                   


                   
                  
                   
                   





                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                
                  <thead>
                    <tr>
                    <th>Select</th>
                     <th>Select</th>
                      <th>Passport</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Registration Number</th>
                      <th> Results Class</th>
                      <th>Current Class</th>
                      <th>View Annual Result</th>
                      <th>Promotion Status</th>
                     
                      
                    </tr>
                  </thead>
                  <tbody>


                



                   <?php
                   while ($allStudentRow = mysqli_fetch_array($allStudentResult))
                   {
                   //output all from students table
                    $student_id =$allStudentRow['StudentID']; 

                   
                   $resultsClass = $allStudentRow['class'];
                   $session = $allStudentRow['school_session'];
                   $term = $allStudentRow['Term'];
                   
                   $RegNumber = $allStudentRow['StudentReg'];
                   $promotion_status = $allStudentRow['Promotion_Status'];




                   $studentDetailQuery = "SELECT * FROM students where student_id= '". $student_id."'";
                   $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                   
                   $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                  
                   $fname = $studentDetailrow['FirstName'];
                   $mName = $studentDetailrow['MiddleName'];
                   $lname = $studentDetailrow['LastName'];
                   $RegNum = $studentDetailrow['RegNum'];
                   $pic = $studentDetailrow['ProfilePic'];
                   $gender = $studentDetailrow['Gender'];
                   $currentClass = $studentDetailrow['Class'];

                   ?>


                    

                  



                   
                   
                   
                   
            
                   
                   			
                   
                     
                    <tr>

                    <td>
                    <div class="bs-component" style="margin-bottom: 15px;">
                       <div class="btn-group btn-group-toggle" data-toggle="buttons">
                       <label class="btn btn-danger">
                           <input type="checkbox" name="reverse" onchange="reverseUser(this.value)" value="<?php echo $student_id; ?>"  autocomplete="off" />Reverse 
                        </label>   

                       </div>
                    </div>   
                    

                    
                    
                    </td>





                    <td>
                    <div class="bs-component" style="margin-bottom: 15px;">
                       <div class="btn-group btn-group-toggle" data-toggle="buttons">
                       <label class="btn btn-primary">
                           <input type="checkbox" name="users" onchange="showUser(this.value)" value="<?php echo $student_id; ?>"  autocomplete="off" class="name"/>Promote
                        </label>   

                       </div>
                    </div>   
                    

                    
                    
                    </td>

                   
                     <td><img src="images/student-passport/<?php echo $pic;?>" height="60" width="60" class="rounded"/></td>
                      <td><a href="student-details.php?studentID=<?php echo $student_id;?>" style="text-decoration:none"> <?php echo strtoupper($fname);?> <?php echo strtoupper($mName);?> <?php echo strtoupper($lname);?></a></td>
                      <td><?php echo $gender;?></td>
                      <td><?php echo $RegNumber;?></td>
                      <td><?php echo $resultsClass;?></td>
                      <td><?php echo $currentClass;?></td>
                      <td><button type="button" data-toggle="modal"
                                           data-target="#exampleModal"
                                           data-whatever="<?php echo $student_id;?>"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="text-decoration:none; margin-left:30%;">View Result</button>
                                           </td>
                      <td><?php echo $promotion_status;?></td>                     
                     
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

   

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                   <h4 class="modal-title" id="memberModalLabel"><?php //echo $fname;?> <?php //echo $lname;?></h4>
                               </div>
                               <div class="dash">
                   
                               </div>
                   
                           </div>
                       </div>
                   </div>
                    <!-- Modal -->

                    
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
    <script>
      $('.bs-component [data-toggle="popover"]').popover();
      $('.bs-component [data-toggle="tooltip"]').tooltip();
    </script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
     
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "results-modal.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>










  </body>

 
</html>


