<?php
 if(mysqli_num_rows($credit) >= 5 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) == 1){
  $commandantsComment="Good Results";
}
else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) == 1){
  $commandantsComment="Put Effort in English Language";
}
else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) < 1){
  $commandantsComment="Put Effort in Mathematics";
}
else if(mysqli_num_rows($credit) >= 5 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) < 1){
  $commandantsComment="No English Language and Mathematics";
}

else{
$commandantsComment="Poor";
}

?>