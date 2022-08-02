
document.addEventListener("DOMContentLoaded", function(){

	new TomSelect("#select_tags",{
	maxItems: 5
	});


  if(document.getElementById('edit_select_tags') !== null){

	const newTomSel = new TomSelect("#edit_select_tags",{
	maxItems: 5
	});


  }

});
