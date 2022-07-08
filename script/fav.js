$(document).ready(function(){
    $("#reload").click(function(){
        location.reload();
    });
});

$(document).ready(function(){
    $("#product_search_fav").change(function(){
        $("#table_body").empty();
        var selected_item=$("#product_search_fav option:selected").text();
        if(selected_item=="Vehicles & motorcycles"){
            product_name="product_vehicle_motorcycle";
        }else if(selected_item=="Apartment"){
            product_name="product_apartment";
        }else if(selected_item=="Electronics & home appliance"){
            product_name="product_electronic_home";
        }else if(selected_item=="Home furnitures"){
            product_name="product_home_furniture";
        }else if(selected_item=="Laptops, Tablets & computers"){
            product_name="product_laptop_tablet_computer";
        }else if(selected_item=="Lands"){
            product_name="product_land";
        }
        $.ajax({
            url:"php_ajax/search_fav.php",
            type:"POST",
            data:{ 
                product_name: product_name,
            },
            success:function(output){
                var obj=JSON.parse(output);
                if(obj.resultat_select >0){
                    $("#table_body").empty();
                    $("#table_body").append(obj.row);
                }else{
                    if(obj.check_all_tr>0){
                        $("#table_body").append(obj.row);
                    }else{
                        $("#table_body_no_item").empty();
                        $("#table_body").append(obj.row);
                    }
                }            
            }
        });
    });
});

function unfav(product_name,id){
    var selected_item=$("#product_search_fav option:selected").val();
    $.ajax({
        url:"php_ajax/remove_fav.php",
        type:"POST",
        data:{
            product_name: product_name,
            id:id,
            s:selected_item,
        },
        success:function(output){
            var obj=JSON.parse(output);
            if(obj.resultat_update >0){
                $("#td_"+product_name+"_"+id).fadeOut(500,function(){
                    if(obj.check_all_tr > 0){
                        $("#table_body").empty();
                        $("#table_body").append(obj.row);
                    }else{
                        $("#table_body").empty();
                        $("#table_body").append(obj.row);
                    }
                });
                
            }
        }                   
    });
}