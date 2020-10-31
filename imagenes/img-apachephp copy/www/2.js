$(document).ready(function(){  
$('.delete_employee').click(function(e){   
e.preventDefault();   
var empid = $(this).attr('data-emp-id');
var parent = $(this).parent("td").parent("tr");   
bootbox.dialog({
message: "Estas seguro que quieres borrarlo ?",
title: "<i class='glyphicon glyphicon-trash'></i> Borrar !",
buttons: {
success: {
	  label: "No",
	  className: "btn-success",
	  callback: function() {
	  $('.bootbox').modal('hide');
  }
},
danger: {
  label: "Borrar!",
  className: "btn-danger",
  callback: function() {       
   $.ajax({        
		type: 'POST',
		url: 'deleteRecords.php',
		data: 'empid='+empid        
   })
   .done(function(response){        
		bootbox.alert(response);
		parent.fadeOut('slow');        
   })
   .fail(function(){        
		bootbox.alert('Error....');               
   })              
  }
}
}
});   
});  
});