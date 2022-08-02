function convertDiv2Textarea(elm){

const initial_value = elm.textContent.replaceAll(' ','').replaceAll('\n','').replaceAll('\t','')

const createTextarea = document.createElement('textarea')

createTextarea.id = elm.id

createTextarea.textContent = initial_value  

elm.replaceWith(createTextarea)

  createTextarea.onmouseout = () => 
  {
    const id = elm.id
    Textarea2Div(createTextarea,id)
  }

}

function Textarea2Div(elm,id){

const createDiv = document.createElement('div')
createDiv.id = id

createDiv.textContent = elm.value 

elm.replaceWith(createDiv)

  createDiv.ondblclick = () => {

  convertDiv2Textarea(createDiv)

  }

}

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


function delete_category(id,category_name){

const params = {action : 'delete' , field: 'category' , category_name : category_name, category_id : id};

  setPost(params)

}


function update_category(id,category_name,category_description){

const params = {action : 'update' , field: 'category' , category_name : category_name, category_id : id , category_description : category_description };

  setPost(params)

}

function delete_tag(id,tag_name){

const params = {action : 'delete' , field: 'tag' , tag_name : tag_name, tag_id: id };

  setPost(params)

}


function update_tag(id,tag_name){

const params = {action : 'update' , field: 'tag' , tag_name : tag_name, tag_id : id };

  setPost(params)

}


function delete_blog(blog_id){

const params = {action : 'delete' , field: 'blog' , blog_id : blog_id };

  setPost(params)

}


function publish_blog(blog_id,user,user_role,publish_action){

  const params = {action : 'approve_post' , field: 'blog' , blog_id : blog_id, user: user, role: user_role , publish_action : publish_action  };

  setPost(params)

}

function edit_blog(blog_id,user,user_role){

const params = {action : 'edit_post' , field: 'blog' , blog_id : blog_id, user: user, role: user_role  };

  setPost(params)

}
