<?php
include 'connect.php';
session_start();

// get the q parameter from URL
$startdate = $_REQUEST["start"];
$mental_questions = $_REQUEST["mental_questions"];
$Physical_questions = $_REQUEST["Physical_questions"];
$other_questions = $_REQUEST["other_questions"];
$mental_questions  = explode(',',$mental_questions );
for ($i=0; $i <sizeof($mental_questions); $i++) {
  $sql = "INSERT INTO questions(Question, Questiontype, company_w_code, companyid, sdate, edate) VALUES ('$mental_questions[$i]', 'mental','test' ,'12', '$startdate','$startdate');";
  if (mysqli_query($conn, $sql)) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


 }
mysqli_close($conn);

 ?>
