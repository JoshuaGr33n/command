$(document).ready(function(){ 	
	 $(document).on('click', '#getEmployee', function(e){  
     e.preventDefault();  
     var empid = $(this).data('StudentID');    
	  $('#employee-detail').hide();
     $('#employee_data-loader').show();  
     $.ajax({
          url: 'empData.php',
          type: 'POST',
          data: 'empid='+empid,
          dataType: 'json',
		  cache: false
     })
     .done(function(data){
          console.log(data.StudentID); 
          $('#employee-detail').hide();
		  $('#employee-detail').show();
		  $('#empid').html(data.StudentID);
            $('#emp_Total').html(data.Total);
            
		  	 
		  $('#employee_data-loader').hide();
     })
     .fail(function(){
          $('#employee-detail').html('Error, Please try again...');
          $('#employee_data-loader').hide();
     });
    });	
});
