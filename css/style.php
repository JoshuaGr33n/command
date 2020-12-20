<?php
    header("Content-type: text/css; charset: UTF-8");



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Front-Page-Background'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$bgName = $row['name'];
?>




body {
    padding: 3em 0;
    background: url(../images/<?php echo $bgName;?>); 
	background-attachment:fixed;
	background-size:cover;
}

