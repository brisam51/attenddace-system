$(function(){
    $(".start-attendance").on("click"   ,function(){
        var project_id = $(this).data("id");
        var user_id = $(this).data("user");
        console.log(project_id, user_id);
        
    });
    });//end class