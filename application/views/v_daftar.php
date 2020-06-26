<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Let's Create Your Account</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>
  <?php
  $notif = $this->session->flashdata('notif');
  if ($notif) {
    echo "<script>alert('$notif');</script>";
  }
  ?>
  <?php echo form_open('', ['id' => 'regist']); ?>
  <div class="form-title">
    <h2>Register</h2>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input class="inp" type="text" name="username" id="username" <?php set_value('username'); ?>>
     <?= form_error('username'); ?>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input class="inp" type="password" name="password" id="password" <?php set_value('username'); ?>>
    <?= form_error('password'); ?>
  </div>
  <div class="form-group">
    <button type="submit" name="button">Regsiter</button>
  </div>
  <?php echo form_close(); ?>
</body>

</html>
