
<?php
require_once plugin_dir_path( __FILE__ ) . 'my_database_handler.php';
$database_handler = new MyDatabaseHandler('student');
$students = $database_handler->fetch_data();
// echo "<pre>";
// print_r($students);

if(isset($_POST['SubmitButton'])){ //check if form was submitted
 $name= $_POST['student_name'];
 $email= $_POST['student_email'];
 $class= $_POST['student_class'];
 $rollno= $_POST['student_roll_no'];
 $data = array(
  'student_name' =>  $name,
  'student_email' => $email,
  'class' =>  $class,
  'roll_no' => $rollno
);
$database_handler->insert_data($data);
$students = $database_handler->fetch_data();
} 






?> 
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>
<div id="listing">
  <h2>Student Listing</h2>
  <button id="form">Create</button>
  <table style="width:100%">
    <tr>
      <th>Roll Number</th>
      <th>Name</th>
      <th>Email</th>
      <th>Class</th>
      <th>Action</th>
    </tr>
    <?php
    foreach ($students as $student) {
          echo '<tr>';
          
              echo '<td>' . $student['roll_no'] . '</td>';
              echo '<td>' . $student['student_name'] . '</td>';
              echo '<td>' . $student['student_email'] . '</td>';
              echo '<td>' . $student['class'] . '</td>';
              echo '<td>edit delete</td>';
        
          echo '</tr>';
    } ?>
  </table>
</div>
<div id="student_form">
<h1>Student Form</h1>
<form id="custom-admin-form" method="post" action="">
    <label >Student Name</label>
    <input type="text"  name="student_name" >
    <label >Student Email</label>
    <input type="email"  name="student_email">
    <label >Class</label>
    <input type="text"  name="student_class">
    <label >Roll No.</label>
    <input type="text"  name="student_roll_no">
    <input type="submit" name="SubmitButton" value="Submit">
</form>
</div>
<script>
    jQuery(document).ready(function($){
      $("#student_form").hide();
      $("#form").click(function(){
        $("#listing").hide();
        $("#student_form").show();
      });
      
    });
    </script>
</body>



