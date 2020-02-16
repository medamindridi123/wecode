<?php
session_start();
if(!isset($_SESSION['admin_id'])) {
$id_manager = $_SESSION['admin_id'];
$name_manager = $_SESSION['admin_user'];
}
else {
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body onload="setdate();">

<p><b>Add your questions here:</b></p>
<form>
<br>
<br>
<label>Start day:&nbsp;&nbsp;</label><input type="date" id="dates"><br>
<br>
<h1 id="ee">Mental Questions</h1>
<button type="button" id="mental_questions" onclick="addquestion('mental_questions');"></button>
<h1 id="eee">Physical Questions</h1>
<icon id="Physical_questions" onclick="addquestion('Physical_questions');"></icon>
<h1 id="other_questions">Other Questions</h1>
<icon onclick="addquestion('other_questions');"></icon>
<button type="button" onclick="showHint();">Add Questions</button>
</form>
</body>
<script>
function addquestion(place) {
  if(place=='mental_questions'){
    <?php $mentalclicked="eeee" ?>
  }
  if(place=='other_questions'){
  <?php $otherclicked ?>}
  if(place=='Physical_questions'){
  <?php $physicalyclicked ?>}
var placetoadd   = document.getElementById(place);
placetoadd.insertAdjacentHTML("beforebegin","<br><label>Your Question : </label><input type='text' class='question_"+place+"'><br><br>");
}
function showHint() {
  var http = new XMLHttpRequest();
  var url = 'Ajaxtesting.php';
  var start = document.getElementById('dates').value;
  var mental_questions = <?php if(isset($mentalclicked)) { echo "document.querySelectorAll('.question_mental_questions');";} else {echo" '';";}?>
  var mental_questions = [].slice.call(mental_questions);
  var mental_questions = mental_questions.map(function(el){
    return el.value;
}).join(', ');
  var Physical_questions = <?php if(isset($physicalyclicked)) { echo "document.getElementsByClassName('question_Physical_questions');";} else {echo" '';";}?>
  var Physical_questions = [].slice.call(mental_questions);
  var Physical_questions = Physical_questions.map(function(el){
    return el.value;
}).join(', ');
  var other_questions = <?php if(isset($otherclicked)) { echo "document.getElementsByClassName('question_other_questions');";} else {echo" '';";}?>
  var other_questions = [].slice.call(other_questions);
  var other_questions = other_questions.map(function(el){
    return el.value;
}).join(', ');



  var params = "start="+start+"&mental_questions="+mental_questions+"&Physical_questions="+Physical_questions+"&other_questions="+other_questions;
  http.open('POST', url, true);

  //Send the proper header information along with the request
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.onreadystatechange = function() {//Call a function when the state changes.
      if(http.readyState == 4 && http.status == 200) {
      }
  }
  http.send(params);
}
function setdate() {
document.getElementById("dates").valueAsDate = new Date();
}

</script>
</html>
