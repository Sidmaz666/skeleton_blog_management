document.addEventListener("DOMContentLoaded", function(){

  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

})


function setPost(params,redirect_page){

const form = document.createElement("form");
form.setAttribute("method", "post");
  form.setAttribute("action", redirect_page ? redirect_page : "" );

  
  for(const key in params) {
        if(params.hasOwnProperty(key)) {
            const hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();

}


function postComment(blog_id,email,username,comment){

  if(email.length > 0 && username.length > 0 && comment.length > 0){
  const params = {action : 'add_comment' , email : email, blog_id : blog_id,
  name: username, msg: comment};

  setPost(params)

  }


}

