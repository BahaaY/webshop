// Fill model 
$(document).ready(function(){
    $("#model").attr("disabled","disabled");
    $("#make").change(function(){
        $("#model").empty();
        var selected_item=$("#make option:selected").text();
        if(selected_item=="Other make"){
            $("#model").attr("disabled","disabled");
            $("#model").append("<option>-- Select Model --</option>");
            return;
        }
        $.ajax({
            url:"php_ajax/fill_model.php",
            type:"POST",
            data:{ 
                make: selected_item,
            },
            success:function(output){
                var obj=JSON.parse(output);
                if(obj.resultat >0){
                    $("#model").removeAttr("disabled");
                    $("#model").append(obj.row);
                }else{
                    $("#model").attr("disabled","disabled");
                }
            }
        });
    });
});