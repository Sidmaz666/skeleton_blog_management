<?php include_once './config.php'; ?>

<div>
<form action="" method="POST">
<label for="">
first name
<input type="text" name="first_name">
</label>
<label for="">
last name
<input type="text" name="last_name">
</label>
<label for="">
email
<input type="email" name="email">
</label>
<label for="">
username
<input type="text" name="username">
</label>
<label for="">
password
<input type="password" name="password">
</label>
<label for="">
Role
<select id="" name="role">
  <option value="writer">Writer</option>
  <option value="publisher">Publisher</option>
<?php if($is_admin_role){ ?>
  <option value="admin">Admin</option>
<?php } ?>
</select>
</label>
<button type="submit" name="registerBtn">Register</button>
</form>
</div>
