var student="";
jQuery(document).ready(function($) {
    var student="";
    jQuery(document).ready(function($){
        $("#student_form").hide();
        $("#form").click(function(){
          $("#listing").hide();
          $("#student_form").show();
        });
        $(".edit-form").click(function(){
            $("#listing").hide();
            $("#student_edit_form").show();           
            var student=data[$(this).attr("data-id")];
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
