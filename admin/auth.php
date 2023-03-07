<link rel="stylesheet" href="css/extra_style.css"> 
<script type="module" src="js/handleAuth.js" defer></script>



<div
class="
p-5
flex
justify-center
text-xl
font-semibold
bg-gray-800
text-white
w-full
shadow-xl
"
>
<button
 class="
p-2
"
 id="loginSwitch">Login</button>

<button
  class="
p-2
bg-white
text-black
"
 id="registerSwitch">Register</button>


</div>


<div
class="
p-5
flex
justify-center
items-center
bg-[#37474F90]
"
 id="login_register_container">
<?php include_once 'login.php'; ?>
</div>
