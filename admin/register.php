<?php include_once './config.php'; ?>

<div class="text-left bg-white shadow-lg">
<h3 class="text-2xl font-semibold text-center p-2 bg-black text-white border-t-4 border-blue-500 ">Register ~ </h3>


<form action="" method="POST">
<div class="mt-4 p-4">


<div>
<label class="block font-semibold text-lg mb-4" for="first_name">First Name<label>
<input type="text" name="first_name" placeholder="John" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md " pattern=".{4,20}" required="">
 </label></label></div>



<div>
<label class="block font-semibold text-lg mb-4" for="last_name">Last Name<label>
<input type="text" name="last_name" placeholder="Dee" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md " pattern=".{4,20}" required="">
 </label></label></div>



<div>
<label class="block font-semibold text-lg mb-4" for="email">Email<label>
<input type="text" name="email" placeholder="email@domain.xyz" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md " required="">
 </label></label></div>



<div>
<label class="block font-semibold text-lg mb-4" for="username">Username<label>
<input type="text" name="username" placeholder="John01" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md " pattern=".{4,20}" required="">
 </label></label></div>


<div class="mt-4">
<label class="block font-semibold text-lg mb-4">Password<label>
<input type="password" name="password" placeholder="********" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md" pattern="(?=.*\d)(?=.*[a-z]).{8,}" required="">
 </label></label></div>


<div class="mt-4">
<label class="block font-semibold text-lg">Role<label>

<select id="" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md"  name="role">
  <option value="writer">Writer</option>
  <option value="publisher">Publisher</option>
<?php if($is_admin_role){ ?>
  <option value="admin">Admin</option>
<?php } ?>
</select>

 </label></label></div>



<div class="flex items-baseline justify-center pb-5 mt-3"> 
<button class="px-6 py-2 mt-4 text-white text-xl font-semibold shadow bg-black hover:bg-gray-900" type="submit" name="registerBtn">Register</button> 
</div>
</div>
</form>
</div>

