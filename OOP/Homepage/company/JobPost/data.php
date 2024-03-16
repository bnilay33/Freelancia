<?php
@include 'config.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
  </head>
  <body>
    <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>#</td>
        <td>Name</td>
        <td>Demo Image</td>
        <td>Project Image</td>
      </tr>
      <?php
      $rows = mysqli_query($connection, "SELECT Project_Name, Project_description, demo_project FROM job_post_table ORDER BY dt DESC LIMIT 1")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row['Project_Name']; ?></td>
        <td> <img src="UploadImageFile/<?php echo $row['demo_project']; ?>" width = 200 title="<?php echo $row['demo_project']; ?>"> </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="index.php">Upload Project</a>
  </body>
</html>
