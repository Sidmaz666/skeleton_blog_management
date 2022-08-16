<?php 
	include_once 'components/core/blog_.php';

	$get_all_blogs = get_blogs($connection);

	if(isset($_GET['category']) && !empty($_GET['category']) ){
	  $get_all_blogs = get_specific_blogs($connection,'blog_category',$_GET['category']);
	}

	if(isset($_GET['author']) && !empty($_GET['author']) ){
		$get_all_blogs=get_specific_blogs($connection,'submited_user',$_GET['author']);
	}

	if(isset($_GET['tags']) && !empty($_GET['tags']) ){
		$get_all_blogs=get_specific_blogs($connection,'blog_tags',$_GET['tags']);
	}


?>


<header class="
bg-black
text-white
p-3
flex
justify-between
items-center
fixed
w-full
z-50
"
style="
--tw-shadow: 0 4px 6px -1px rgb(84 81 81 / 55%), 0 2px 4px -2px rgb(0 0 0 / 42%);
box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
"
>

<a 
class="
md:text-xl
font-semibold
capitalize
"
href="/<?=$what_blog;?>">
<?=str_replace('_',' ',$what_blog);?>
</a>


<button 
onclick="
document.getElementById('option_wrap').classList.toggle('hidden')
document.getElementById('category_wrap').classList.add('hidden')
document.getElementById('tag_wrap').classList.add('hidden')
"
class="
md:hidden
rotate-90 
font-semibold 
font-sans
">|||</button>


<div class="
absolute
md:block
md:relative
top-[48px]
md:top-auto
left-0
md:left-auto
w-full
md:w-auto
bg-black
flex
flex-col
justify-center
hidden
md:block
"
id="option_wrap"
>

<button 
class="
bg-[#26323870]
hover:bg-[#26323890]
md:rounded-md
p-2
text-lg
font-semibold
"
onclick="
document.getElementById('category_wrap').classList.toggle('hidden')
document.getElementById('tag_wrap').classList.add('hidden')
"
>

Category
</button>

<div id="category_wrap" 
class="
hidden
w-full
text-center
md:absolute
md:-translate-x-[24px]
md:translate-y-[12px]
"
>
<?php
	// CATEGORY SECTION
	$get_categories	= get_category($connection);

?>

<?php foreach(json_decode($get_categories) as $cat){ ?>

<span
class="
w-full
capitalize
flex
"
>
<a 
class="
p-2
text-md
w-full
bg-[#37474F80]
hover:bg-[#26323860]
md:bg-[#37474F]
md:hover:bg-[#263238]
"
href="?category=<?=trim($cat->category_name);?>">
<?=$cat->category_name;?>
</a>

</span>

<?php } ?>
</div>






<button 
class="
bg-[#26323870]
hover:bg-[#26323890]
p-2
text-lg
font-semibold
md:rounded-md
"
onclick="
document.getElementById('tag_wrap').classList.toggle('hidden')
document.getElementById('category_wrap').classList.add('hidden')
"

>
Tags
</button>



<div 
class="
hidden
w-full
text-center
md:absolute
md:translate-x-[12px]
md:translate-y-[12px]
"
id="tag_wrap">


<?php
	// TAGS SECTION
	$get_tags = get_tags($connection);

?>


<?php foreach(json_decode($get_tags) as $tg){ ?>

<span
class="
w-full
capitalize
flex
"
>
<a 
class="
p-2
text-md
w-full
bg-[#37474F80]
hover:bg-[#26323860]
md:bg-[#37474F]
md:hover:bg-[#263238]
"
href="?tags=<?=trim($tg->tag_name);?>">
<?=$tg->tag_name;?>
</a>

</span>

<?php } ?>

</div>


</div>


</header>



<?php

//HOME PAGE/MAIN PAGE-> SECTION1
	
	if(!isset($_GET['view_blog'])){

?>

<div class="
p-3
md:translate-y-20
translate-y-16

mb-[10rem]
md:mb-[20rem]

"
>

<span class="
text-3xl
font-semibold
text-[#424242]
text-opacity-90
">Recent Blogs</span>


<div
class="
md:flex
md:flex-wrap
md:space-x-2
"
>
<?php 
	if($get_all_blogs){
	foreach(json_decode($get_all_blogs) as $blog){
?>

<div
class="
bg-[#263238]
hover:bg-[#37474F]
text-white
mt-3
rounded-md
flex
flex-col
shadow-xl
md:w-[380px]
w-auto
"
>


<span
class="
text-2xl
font-semibold
bg-[#00000090]
rounded-md
rounded-b-none
pb-[0.5rem]
"
>

<img 
class="
rounded-md
rounded-b-none
w-full
h-[200px]
"
src="<?=$blog->blog_image;?>" alt="<?=$blog->blog_title."-Image";?>">



<a 
class="pl-[0.5rem]"
href="?view_blog=<?=$blog->blog_id;?>">
<?=$blog->blog_title;?>
</a>
</span>


<span
class="
p-3
flex
items-center
bg-[#00695C20]
"
>

<span
class="
text-xl
font-semibold
overflow-ellipsis
ml-2
"
>
<?=$blog->blog_description;?>
</span>

</span>

<span
class="
p-3
bg-[#00000050]
flex
items-center
space-x-2
"
>

<span
class="
font-bold
text-md
"
>
<a 
class="
p-1
pl-2 pr-2
bg-[#AA00FF40]
rounded-full
"
href="?category=<?=$blog->blog_category;?>">
<?=$blog->blog_category;?>
</a>
</span>

<span>
<?php
      foreach(explode(",",$blog->blog_tags) as $tags){
?>
<a
class="
p-1
pl-2 pr-2
bg-[#00C85340]
rounded-full
"
 href="?tags=<?=$tags;?>">
<?=$tags;?>
</a>
<?php } ?>
</span>
</span>



<span
class="
p-3
bg-[#00000020]
flex
items-center
space-x-2
justify-between
"
>
<i>
<?=$blog->published_at;?>
</i>


<span>
<a 
class="
font-bold
text-red-500
"
href="?author=<?=$blog->submited_user;?>">
<?=$blog->submited_user;?>
</a>
</span>

</span>


<span
class="
p-3
bg-[#00000070]
flex
items-center
space-x-2
h-full
justify-center
"
>

<a 
class="
p-1
pl-2 pr-2
font-semibold
bg-[#AD1457]
rounded-full
"
href="?view_blog=<?=$blog->blog_id;?>">
Read More
</a>


</span>


</div>




<?php
	  }
	} else {
?>
<span
class="
mt-3
text-4xl
text-[#9E9E9E]
font-semibold
"
>
No Post Available!
</span>

<?php
	}


?>

</div>
</div>



<?php
	}

//SINGLE BLOG VIEW/SECTION2

	if(isset($_GET['view_blog'])){

	include_once 'components/core/handleComment.php';
	
	$get_this_blog = json_decode(get_this_blog($connection,$_GET['view_blog']));

	foreach($get_this_blog as $blog){

?>

<script id="set_timer_script" defer>
	  document.title = '<?=$blog->blog_title;?>' + ' ~ Blog'
	    setTimeout(()=>{
		document.getElementById('set_timer_script').remove();	
	},400)
</script>

<div
class="
p-2
"
style="
transform: translateY(5rem);
"
>


<div
class="p-2"
style="
font-size:26px;
font-weight:bold;
color:#757575;
display:flex;
flex-direction: column;
flex-wrap:wrap;
"
>
<?=$blog->blog_title;?>

<div
style="
font-size: 16px;
"
>
<span
style="
font-weight: bold;
color:#546E7A;
"
>
Category:
</span>

<a 
style="
color: #42A5F5;
"
href="?category=<?=$blog->blog_category;?>">
<?=$blog->blog_category;?>
</a>
</div>

</div>



<div
style="
margin: 3rem;
"
>
<?=$blog->blog_data;?>



<div
style="display: flex;justify-content: space-between;"
>



<div
style="
display: flex;
"
>
<?php
      foreach(explode(",",$blog->blog_tags) as $tags){
?>
<a
style="
background: #546E7A;
padding:5px;
border-radius:15px;
color:white;
font-weight:bold;
margin-right: 0.5rem;
"
 href="?tags=<?=$tags;?>">
<?=$tags;?>
</a>
<?php } ?>
</div>




<div
style="
color:#EF5350;
font-weight: bolder;
"
>
<span
style="
color:#00000090;
"
>
Author:
</span>
<a href="?author=<?=$blog->submited_user;?>">
<?=$blog->submited_user;?>
</a>
</div>




</div>
</div>


<style>

#comment_section {
margin:5rem;
padding-left:20px ;
padding-right:20px ;
}

@media (max-width: 570px){

#comment_section{
margin:1rem;
}

}

</style>




<div
id="comment_section"
>

<h2>Submit a Comment!</h2>

<script src="components/js/handleComment.js" defer></script>

<div
>
<div
style="
display: flex;
flex-direction: column;
background: #424242;
border-radius: 1rem;
padding:10px;
color:white;
font-weight: bolder;
"
>

<label for=""
style="
display: flex;
flex-direction: column;
font-size: 20px;
"
>Email:

<input 
style="
padding: 0.5%;
color:#00000090;
border-radius: 0.5rem;
"
placeholder="email@domain.do"
type="email" id="c_email" required>

</label>

<label for=""
style="
display: flex;
flex-direction: column;
font-size: 20px;
"
>Name:

<input 
style="
padding: 0.5%;
color:#00000090;
border-radius: 0.5rem;
"
placeholder="Jhon Dee"
type="text" id="c_name" required>
</label>

<label for=""
style="
display: flex;
flex-direction: column;
font-size: 20px;
"
>Comment:
<textarea 
style="
padding: 0.5%;
color:#00000090;
border-radius: 0.5rem;
"
placeholder="Write Your Comment..."
required id="c_comment">
</textarea>
</label>

<button
style="
margin-top:0.5rem;
background: white;
color:#000000;
font-weight: bolder;
border-radius: 20px;
padding: 0.5%;
"
 id="comment_submitBtn"
 onclick="postComment('<?=$blog->blog_id;?>',document.getElementById('c_email').value,document.getElementById('c_name').value,document.getElementById('c_comment').value)">

Submit

</button>

</div>

</div>

<br/>

<h2>
Comments
</h2>

<?php

	  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM comments WHERE blog_id = '$blog->blog_id'");


    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){


      while($fetch_all_comments = mysqli_fetch_assoc($get_data_query)){

?>

	<div
	style="
    padding: 0.7rem;
    background: #2a2a2acf;
    color: white;
    border-radius: 15px;
    font-weight: bolder;
    margin-top: 0.6rem;
	"
	>
	<span>
	<span>User : </span>
	<?=$fetch_all_comments['username'];?>
	</span>
	<br>
	<span>
	<span>Comment : </span>
	<?=$fetch_all_comments['comment'];?>
	</span>
	<br>
	<span>
	<span>Time : </span>
	<?=$fetch_all_comments['creation_time'];?>
	</span>
	</div>
		


<?php

    }

    }


?>

</div>



<?php 
		}
	}
?>

