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

//If a link in the nav bar is active


$pageActiveTag6="Settings";
$currentPageTag="Set Result Mark";




if($pageActiveTag6="Settings"){

  
  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";
  $ExpandSettings="is-expanded";
  


}








if($currentPageTag="Set Result Mark"){
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
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";
  $setResultMarkCurrentPageTag="active";



}







?>

<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>



<?php 
if($settings!="YES")
{
    header("Location: index.php" );
exit;
}
?>
<?php



$current_term_query= $con->prepare("SELECT Term FROM term WHERE Status= 'Current' ");
$current_term_query->execute();                          
$current_term_query->Store_result();                      
$current_term_query->bind_result($current_term);  
$current_term_query->fetch();
$current_term_query->close();




   

$current_session_query= $con->prepare("SELECT sessionName FROM school_session WHERE Status= 'Current' ");
$current_session_query->execute();                          
$current_session_query->Store_result();                      
$current_session_query->bind_result($current_session);  
$current_session_query->fetch();
$current_session_query->close();





   
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
    <title>Set Result Marks</title>
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
          <h1><i class="fa fa-th-list"></i> Result Marks for: <?php echo $current_session;?>-<?php echo $current_term;?> Term</h1>
          <p></p>
        </div>

<?php $check_row_query = $con->query("SELECT School, session, term FROM result_marks WHERE School IN('Junior Secondary School', 'Senior Secondary School') AND session='$current_session' AND term='$current_term' ");?>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <?php 
           if(mysqli_num_rows($check_row_query) < 2){
          ?>
          <li class="breadcrumb-item"> <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add</button></li>
           <?php }?>


          
          
        </ul>



      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              
              
                <table class="table table-bordered  table-striped" id="sampleTable" style="width:60%; margin-left:18%">
                
                  <thead>
                    <tr>
                     
                      <th></th>
                      <th>CA 1</th>
                      <th>CA 2</th>
                      <th>CA 3</th>
                      <th>Exam</th>
                      <th></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                
                 

                    $results =$con->prepare("SELECT Sno, School, CA1, CA2, CA3, Exam FROM result_marks 
                    WHERE 
                    session='$current_session' 
                    AND term='$current_term'
                   
                  
                   
                  ");


             $results->execute();                           
             $results->Store_result();                      
             $results->bind_result($sno, $school, $ca1, $ca2, $ca3, $exam);
            while($results->fetch()) 
            {
                  
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      
                      <td><?php echo $school; ?></td>
                      <td><?php echo $ca1; ?></td>
                      <td><?php echo $ca2; ?></td>
                      <td><?php echo $ca3; ?></td>
                      <td><?php echo $exam; ?></td>
                      <td><input type="button" name="edit" value="Edit" id="<?php echo $sno; ?>" class="btn btn-primary btn-xs edit_data" />
                                          </td>
                      

                      
                      
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
    <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title"></h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                     <table class="table table-hover table-bordered table-striped" style="width:400px; margin-left:50px">
                
               
                <tbody>
               


                <tr>
                <td></td>
                <td>
                <select name="school" id="school" class="form-control form-control-lg form-control-solid" style="width:230px;margin-left:10px">

                <option value=""></option>
                
                <option value="Junior Secondary School">Junior Secondary School</option>
               
                
                <option value="Senior Secondary School">Senior Secondary School</option>
                
                </select>
                
                
                
                
               </td>
                </tr>
                 <tr>
                <td>CA 1</td>
                <td><input name="ca1" id="ca1" class="form-control form-control-lg form-control-solid" style="width:100px;margin-left:50px" type="text" /></td>
                </tr>
                <tr>
                <td>CA 2</td>
                <td><input name="ca2"  id="ca2"  class="form-control form-control-lg form-control-solid" style="width:100px;margin-left:50px" type="text" /></td>
                </tr>
                <tr>
                <td>CA 3</td>
                <td><input name="ca3" id="ca3" class="form-control form-control-lg form-control-solid" style="width:100px;margin-left:50px" type="text" /></td>
                </tr>
                <tr>
                <td>Exam</td>
                <td><input name="exam" id="exam" class="form-control form-control-lg form-control-solid" style="width:100px;margin-left:50px" type="text" /></td>
                </tr>

                








                </tbody>

                </table>
                          <input type="hidden" name="sno" id="sno" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary" style="width:230px;margin-left:130px"/>  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
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

    <!-- Data table plugin
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script> -->
                 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var sno = $(this).attr("id");  
           $.ajax({  
                url:"set-result-marks/fetch.php",  
                method:"POST",  
                data:{sno:sno},  
                dataType:"json",  
                success:function(data){  
                    $('#school').val(data.School);  
                     $('#ca1').val(data.CA1);  
                     $('#ca2').val(data.CA2);  
                     $('#ca3').val(data.CA3);  
                     $('#exam').val(data.Exam);  
                     $('#sno').val(data.Sno);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#school').val() == "")  
           {  
                alert("Select School");  
           }  
          else if($('#ca1').val() == "")  
           {  
                alert("CA1 is required");  
           }  
           else if($('#ca2').val() == '')  
           {  
                alert("CA2 is required");  
           }  
           else if($('#ca3').val() == '')  
           {  
                alert("CA3 is required");  
           }  
           else if($('#exam').val() == '')  
           {  
                alert("Exam is required");  
           }  
           else  
           {  
                $.ajax({  
                     url:"set-result-marks/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('.table-responsive').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var sno = $(this).attr("id");  
           if(sno != '')  
           {  
                $.ajax({  
                     url:"set-result-marks/select.php",  
                     method:"POST",  
                     data:{sno:sno},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  
 </script>


  </body>
</html>


<script src="js/classedit/bootstable.js"></script>
<script src="js/classedit/editable.js"></script>