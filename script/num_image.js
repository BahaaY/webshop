//get number of image selected
$(document).ready(function(){
    $("#input_image").change(function(){
        var files=$(this)[0].files;
        if(files.length==1){
            $("#num_image").empty();
            $("#num_image").append(files.length+ " image chosen.");
        }else if(files.length >7){
            $("#num_image").empty();
            $("#num_image").append("<span style='color:rgb(255, 52, 52);'>You can only select 7 images.</span>");
        }else{
            $("#num_image").empty();
            $("#num_image").append(files.length+ " images chosen.");
        }
        
    });
});



