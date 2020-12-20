<?php session_start();?>
<?php
//database connection
include('include/db.php');


       
        $allPromotedStudentResult = $con->query("SELECT * FROM `results` WHERE school_session ='".$_SESSION['promoteStudentSession']."' AND class ='".$_SESSION['promoteStudentClass']."' AND Promotion_Status ='Promoted' GROUP BY StudentID");
	
	




?>


<table class="table table-hover table-bordered table-striped" id="sampleTable">
                
                  <thead>
                    <tr>
                    <th>
                   
                    </th>
                      <th>Passport</th>
                      <th>Name</th>
                      <th>Registration Number</th>
                      <th>Results Class</th>
                      <th>Current Class</th>
                      <th>Status</th>
                     
                      
                     
                      
                    </tr>
                  </thead>
                  <tbody>


                



                   <?php
                   while ($allPromotedStudentRow = mysqli_fetch_array($allPromotedStudentResult))
                   {
                   //output all from students table
                    $student_id =$allPromotedStudentRow['StudentID']; 

                   $reg = $allPromotedStudentRow['StudentReg'];
                   $status = $allPromotedStudentRow['Promotion_Status'];
                   $resultsClass = $allPromotedStudentRow['class'];
                   




                   $studentDetailQuery = "SELECT * FROM students where student_id= '". $student_id."'";
                   $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                   
                   $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                  
                   $fname = $studentDetailrow['FirstName'];
                   $mName = $studentDetailrow['MiddleName'];
                   $lname = $studentDetailrow['LastName'];
                   $currentClass = $studentDetailrow['Class'];
                   $pic = $studentDetailrow['ProfilePic'];
                   $RegNum = $studentDetailrow['RegNum'];




                   $classPromotionQuery = "SELECT * FROM class_promotion WHERE Promote_From= '".$resultsClass."'";
                   $classPromotionResult = mysqli_query($con, $classPromotionQuery);
                   
                   $classPromotionrow = mysqli_fetch_array($classPromotionResult);


                   
                  
                   $promote_from = $classPromotionrow['Promote_From'];
                   $promote_to = $classPromotionrow['Promote_To'];
                  
                   








                   if(isset($_POST["save"])) {
                   
                
                    
                
                      mysqli_query($con, "UPDATE students set Class = '" .$promote_to."' WHERE student_id='" .$student_id. "'");
                      mysqli_query($con, "UPDATE registered_subjects SET current_class='$promote_to'
                      WHERE StudentID='$student_id'");
                      
                
                    
                  
                   
                  
                            
                  
                 
                  
                   }
                  
                   

                   ?>


                    
                   
                   
                   
            
                   
                   			
                   
                     
                    <tr>
                    <td>
                    

                    
                    
                    </td>
                     
                      <td><img src="images/student-passport/<?php echo $pic;?>" height="60" width="60" class="rounded"/></td>
                      <td><?php echo $fname;?> <?php echo $mName;?> <?php echo $lname;?></td>
                      <td><?php echo $reg;?></td>
                      <td><?php echo $resultsClass;?></td>
                      <td><?php echo $currentClass;?></td>
                      <td><?php echo $status;?></td>
                     
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>




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
    
