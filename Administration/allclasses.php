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
$currentPageTag="All Classes";




if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
  $ExpandAdmin="";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";
  $ExpandSettings="";
  


}








if($currentPageTag="All Classes"){
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

  $allSubjectCurrentPageTag="";

  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="active";
  $studentsActiveTag="";
  $dashboardActiveTag="";
  $setResultMarkCurrentPageTag="";



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

$updateClassLink="";
$deleteClassLink="";
$addNewClassLink="";
if($addEditStudentM=="YES" && $studentManagement=="YES")
{
 $updateClassLink='<li><button name="update" onClick="setUpdateAction();"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update</button></li>';
 $deleteClassLink='<li><button name="delete" onClick="setDeleteAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete</button></li>';
 $addNewClassLink='<button type="button"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;" data-toggle="modal" data-target="#myModal">Add new Class</button>';
 }

?>

<?php

//output all from classes table
        $allClassesQuery = "SELECT * FROM classes";
        $allClassesResult = mysqli_query($con, $allClassesQuery);
	
?>


<?php

	
	//query for class link
		$Query = "SELECT * FROM classes";
    $Result = mysqli_query($con, $Query);
	
	
	
	
	// Loop through each row, outputting the login and password
while ($row = mysqli_fetch_array($Result))
{
$classN = $row['className'];
}
?>



<?php// if(isset($_POST['subupdate']))
//{

    //$updateClass="Update classes set className ='".$_POST['fname']."'
    //where student_id='".$student_id."'";

//}
  ?> 
  <?php 

$insertClassQuery="";

if(isset($_POST['submit']))


{

  

  $newClass = strtoupper($_POST['newClass']);
  $ck_row=mysqli_query($con, "SELECT  className FROM  `classes` WHERE className='$newClass' ");





  if($newClass!="" && mysqli_num_rows($ck_row) < 1)
  {
  $insertClassQuery = "INSERT INTO classes (className,FormTeacher) VALUES
  ('".$newClass."', ' ')";
  }
  
    
  
 



  
 $insertClassResult ="";
  
 if($insertClassQuery)
 
 
 {
 
     $insertClassResult = mysqli_query($con, $insertClassQuery);

     
 }
 
 if($insertClassResult)
   {
       
    
    header("Location:allclasses.php" );
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
    <title>All Classes</title>
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





    <style type="text/css">
    
    </style>



<!--edit and delete form script-->

<script language="javascript" src="formjs/users.js" type="text/javascript"></script>
<!--edit and delete form script-->







<!--check all boxes script-->

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

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
          <h1><i class="fa fa-th-list"></i> All Classes </h1>
          <p></p>
        </div>


        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->


          <!-- Trigger the modal with a button -->
           <?php echo $addNewClassLink;?>
           <!-- Trigger the modal with a button -->
           <!-- Modal -->
           <form method="post">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New class</h4>
        </div>
        <div class="modal-body">
          <p>Class Name</p>
          <p><input type="text" name="newClass"  class="form-control form-control-lg form-control-solid" value=""/></p>
          <p><input type="submit" name="submit" class="btn btn-primary " style="margin-left:25%; width:50%; margin-top:20px;" value="Submit"/></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  </form>
 <!-- Modal -->
          
        </ul>



      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              
              <form name="frmUser" method="post" action="">
                <table class="table table-bordered  table-striped" id="sampleTable" style="width:60%; margin-left:18%">
                
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Class ID</th>
                      <th>Class Name</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($allClassesRow = mysqli_fetch_array($allClassesResult))
                   {
                   //output all from students table
                    $class_id =$allClassesRow['classID']; 

                   $className =$allClassesRow['className'];
                  
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $allClassesRow['classID']; ?>" class="name" /></td>
                      <td><?php echo $allClassesRow['classID']; ?></td>
                      <td><a href="classmates.php?classmate=<?php echo $className;?>"><?php echo $allClassesRow['className'];?></a></td>
                      

                      
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
                <tr>
                       
                    </tr>
                </form>
                <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
         
        <?php echo $deleteClassLink;?>
        <?php echo $updateClassLink;?>  
        </ul>
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
    
  </body>
</html>


<script src="js/classedit/bootstable.js"></script>
<script src="js/classedit/editable.js"></script>