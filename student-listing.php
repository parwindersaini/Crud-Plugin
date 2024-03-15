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
        echo '<td> <button class="edit-form" data-id='.$key.'>Edit</button> </td>';

        echo '</tr>';
      } ?>
    </table>
  </div>
  <div id="student_form">
    <h1>Student Form</h1>
    <form id="custom-admin-form" method="post" action="">
      <label>Student Name</label>
      <input type="text" name="student_name">
      <label>Student Email</label>
      <input type="email" name="student_email">
      <label>Class</label>
      <input type="text" name="class">
      <label>Roll No.</label>
      <input type="text" name="roll_no">
      <input type="submit" value="Submit">
    </form>
  </div>
  <div id="student_edit_form">
    <h1>Student Edit Form</h1>
    <form id="custom-admin-form" method="post" action="">
      <label>Student Name</label>
      <input type="text" name="student_name">
      <label>Student Email</label>
      <input type="email" name="student_email">
      <label>Class</label>
      <input type="text" name="class">
      <label>Roll No.</label>
      <input type="text" name="roll_no">
      <input type="submit" value="Submit">
    </form>
  </div>


