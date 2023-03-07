

<div class="text-left bg-white shadow-lg" style="margin-top:200px;margin-bottom: 200px;">
<h3 class="text-2xl font-semibold text-center p-2 bg-black text-white border-t-4 border-blue-500 ">Login ~ </h3>


<form action="" method="POST">
<div class="mt-4 p-4">
<div>
<label class="block font-semibold text-lg" for="username">Username<label>
<input type="text" name="username" placeholder="Jhon001" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md " pattern=".{4,20}" required="">
 </label></label></div>
<div class="mt-4">
<label class="block font-semibold text-lg">Password<label>
<input type="password" name="password" placeholder="********" class="w-full px-4 py-2 mt-2 border-b-2 border-gray-800 focus:outline-none focus:border-green-500 shadow-md" pattern="(?=.*\d)(?=.*[a-z]).{8,}" required="">
 </label></label></div>
<div class="flex items-baseline justify-center pb-5 mt-3"> 
<button 
class="px-6 py-2 mt-4 text-white text-xl font-semibold shadow bg-black hover:bg-gray-900" 
name="loginBtn"
type="submit">Login</button> 
</div>
</div>
</form>
</div>

