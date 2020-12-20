<?php
if($rank == 11){
    $end='th';
  
  }
  else if($rank == 12){
    $end='th';
  
  }
  else if($rank == 13){
    $end='th';
  
  }

  else{

$last_digit=substr($rank, -1);

if($last_digit==1){
  $end='st';

}
else if($last_digit==2){
  $end='nd';

}
else if($last_digit==3){
  $end='rd';

}

else if($last_digit >= 4){

  

  $end='th';

}


  }
  
    



?>