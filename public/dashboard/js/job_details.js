$(function(){
   $(".job-link").on("click",function(e){
    e.preventDefault();
    var userId = $(this).data("id");
    alert(userId);  
      });
});

