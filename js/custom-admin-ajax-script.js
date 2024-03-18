var student="";
jQuery(document).ready(function($) {
    var student="";
    jQuery(document).ready(function($){
        $("#student_form").hide();
        $("#form").click(function(){
          $("#listing").hide();
          $("#student_form").show();
        });
        $(".delete-student").click(function(){
            
            if(confirm("Are you sure you want to delete this?")){
            var student=data[$(this).attr("data-id")];
            const form_data ={ id: student['id'] };
                

       console.log(form_data);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'custom_admin_form_submit',
                data:form_data // Get input data value
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } 
            }
        });
            }
            else{
                return false;
            }

        });
        $(".edit-form").click(function(){
            $("#listing").hide();
            $("#student_form").show();           
            var student=data[$(this).attr("data-id")];
            $('#name').val(student['student_name']); 
            $('#email').val(student['student_email']); 
            $('#class').val(student['class']); 
            $('#roll_no').val(student['roll_no']); 
            $('#id').val(student['id']); 
            // console.log( student);
          });
      });
    $('#custom-admin-form').submit(function(e) { 
        e.preventDefault();
        var form_data = $(this).serialize();
       console.log(form_data);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'custom_admin_form_submit',
                data:form_data // Get input data value
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } 
            }
        });
    });
});
