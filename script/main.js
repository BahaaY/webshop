function refresh(){
    $.ajax({
        url:"php_ajax/refresh_main.php",
        type:"POST",
        success:function(output){
            $("#table_body").empty();
            var obj = JSON.parse(output);
            if(obj.resultat_select>0){
                
                $("#table_body").append(obj.row);
            }
        }
    });
}

function reset(product_name,nb){
    if(product_name=="product_vehicle_motorcycle"){
        $("#make option:first").prop("selected", "selected");
        $("#model option:first").prop("selected", "selected");
        $("#year option:first").prop("selected", "selected");
    }else{
        $("#type"+nb+" option:first").prop("selected", "selected");
    }
}
function select_search(product_name,nb){
    $("#table_body").empty();
    if(product_name=="product_vehicle_motorcycle"){
        $.ajax({
            url:"php_ajax/select_search_main.php",
            type:"POST",
            data:{ 
                product_name:product_name,
                make:$("#make option:selected").val(),
                model:$("#model option:selected").val(),
                year:$("#year option:selected").val(),
            },
            success:function(output){
                var obj = JSON.parse(output);
                if(obj.resultat_select>0){
                    $("#table_body").append(obj.row);
                }else{
                    if(obj.resultat_select2>0){
                        
                    }else{
                        $("#table_body").append(obj.row);
                    }
                }
            }
        });
    }else{
        $.ajax({
            url:"php_ajax/select_search_main.php",
            type:"POST",
            data:{ 
                product_name:product_name,
                type:$("#type"+nb+" option:selected").val(),
            },
            success:function(output){
                var obj = JSON.parse(output);
                if(obj.resultat_select>0){
                    $("#table_body").append(obj.row);
                }else{
                    if(obj.resultat_select2>0){
                        
                    }else{
                        $("#table_body").append(obj.row);
                    }
                }
            }
        });
    }


}

function fav(product_name,id){
    $.ajax({
        url:"php_ajax/fav_unfav_main.php",
        type:"POST",
        data:{ 
            product_name:product_name,
            id:id,
        },
        success:function(output){
            var obj = JSON.parse(output);
            if(obj.resultat_query>0){
                $("#fav_"+product_name+"_"+id).css({
                    "color": "white",
                });
            }else{
                $("#fav_"+product_name+"_"+id).css({
                    "color": "red",
                });
            }
            //alert(output);
        }
    });
}

$(document).ready(function(){
    $("#input_search").keyup(function(){
        $("#table_body").empty();
        $.ajax({
            url:"php_ajax/search_main.php",
            type:"POST",
            data:{ 
                text: $("#input_search").val()
            },
            success:function(output){
                var obj = JSON.parse(output);
                if(obj.resultat_select>0){
                    $("#table_body").empty();
                    $("#table_body").append(obj.row);
                }
            }
        });
    });
});