$(document).ready(function(){
    $("#reload").click(function(){
        location.reload();
    });
    $("#product_search_ads").change(function(){
        $("#table_body").empty();
        uid=$("#uid").val();
        var selected_item=$("#product_search_ads option:selected").text();
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
            url:"php_ajax/search_ads.php",
            type:"POST",
            data:{ 
                product_name: product_name,
                uid:uid
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
                        $("#tr_no_item_in_sell").show(200);
                        
                    }
                } 
                 
            }
        });
    });
});