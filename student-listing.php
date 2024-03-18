<?php
// require_once plugin_dir_path( __FILE__ ) . 'my_database_handler.php';
// $database_handler = new MyDatabaseHandler('student');
// $students = $database_handler->fetch_data();
// echo "<pre>";
// print_r($students);

$json = json_encode($students);
echo "<script>var data = $json;
</script>";
?>
<style>
  table,
  th,
  td {
    border: 1px solid black;
  }
</style>


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
      foreach ($students as $key => $student) {
        echo '<tr>';

        echo '<td>' . $student['roll_no'] . '</td>';
        echo '<td>' . $student['student_name'] . '</td>';
        echo '<td>' . $student['student_email'] . '</td>';
        echo '<td>' . $student['class'] . '</td>';
        echo '<td> <button class="edit-form" data-id='.$key.'>Edit</button> <button class="delete-student" data-id='.$key.'>Delete</button></td>';

        echo '</tr>';
      } ?>
    </table>
  </div>
  <div id="student_form">
    <h1>Student Form</h1>
    <form id="custom-admin-form" method="post" action="">
      <input type="hidden" id="id" name="id" >
      <label>Student Name</label>
      <input type="text" id="name" name="student_name">
      <label>Student Email</label>
      <input type="email" id="email" name="student_email">
      <label>Class</label>
      <input type="text" id="class" name="class">
      <label>Roll No.</label>
      <input type="text" id="roll_no" name="roll_no">
      <input type="submit" value="Submit">
    </form>
  </div>
  


