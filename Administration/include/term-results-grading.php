






<?php
 $teacherComment="";

                      if($teacherCustomRemark=="")



                      {





                      
                      
                      if($totalRow['totalsummation']<=560)
                      {

                        $teacherComment="Fail";




                      }
                      

                      if($totalRow['totalsummation']>=561)
                      {

                        $teacherComment="Pass";




                      }



                      if($totalRow['totalsummation']>=757)
                      {

                        $teacherComment="Good";




                      }


                      if($totalRow['totalsummation']>=827)
                      {

                        $teacherComment="Very Good";




                      }


                      if($totalRow['totalsummation']>=966)
                      {

                        $teacherComment="Excellent";




                      }

                      else if($totalRow['totalsummation']=="")
                      {

                       

                        $teacherComment="No Comment";
                      




                      }







                      




                    }



                    else if($totalRow['totalsummation']=="")
                      {

                        $teacherCustomRemark="No Comment";

                       
                      




                      }

                    else{

                       $teacherCustomRemark;

                       $teacherComment="";

                   }



                      
                      
                      
                      ?>



















                      