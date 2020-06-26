<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <div class="container">
    <?php
    if ($role === "1") {
      $role = "Admin";
    } else {
      $role = "Member";
    }
    echo "Hallo $uname Anda login Sebagai $role <br>";
    echo anchor( base_url('admin/logout'), 'Logout' );
    ?>
  </div>
</body>
</html>
