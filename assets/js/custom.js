(function($) {
	
// Start of use strict
"use strict";

//Confirm Before Delete
$(document).ready(function(){
  $(".deleteMem").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});


// Print Button To Print Invoice
$('#btnPrint').click(function(){
     window.print();
});

})(jQuery); // End of use strict