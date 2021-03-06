function count_img_ads(product_name_id){
    array = product_name_id.split("/");
    product = array[0];
    id = array[1];
    var files=$("#input_image")[0].files;
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
}

function update(product,id){
    formData = new FormData();
    formData.append('check_button','update');
    if(product=="product_vehicle_motorcycle"){
        p="product_vehicle_motorcycle";
        var totalfiles = $("#input_image")[0].files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append("img[]", $("#input_image")[0].files[index]);
        }
        formData.append('product',p);
        formData.append('id',id);
        formData.append('price_lb',$("#input_price_lb").val());
        formData.append('price_usd', $("#input_price_usd").val());
        formData.append('title',$("#input_title").val());
        formData.append('description',$("#input_description").val());
        formData.append('location',$("#input_location").val());
        formData.append('condition',$("#condition option:selected").text());
        formData.append('year',$("#year option:selected").text());
        formData.append('kilometeres',$("#kilometeres option:selected").text());
        formData.append('transmission',$("#transmission option:selected").text());
        formData.append('color',$("#color option:selected").text());
        formData.append('body',$("#body option:selected").text());
    }else if(product=="product_apartment"){
        p="product_apartment";
        var totalfiles = $("#input_image")[0].files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append("img[]", $("#input_image")[0].files[index]);
        }
        formData.append('product',p);
        formData.append('id',id);
        formData.append('price_lb',$("#input_price_lb").val());
        formData.append('price_usd', $("#input_price_usd").val());
        formData.append('title',$("#input_title").val());
        formData.append('description',$("#input_description").val());
        formData.append('location',$("#input_location").val());
        formData.append('condition',$("#condition option:selected").text());
        formData.append('size',$("#input_size").val());
        formData.append('bedroom_nb',$("#bedroom_nb option:selected").text());
        formData.append('bethroom_nb',$("#bethroom_nb option:selected").text());
        formData.append('floor_nb',$("#floor_nb option:selected").text());
        formData.append('payment',$("#payment option:selected").text());
    }else if(product=="product_electronic_home" || product=="product_home_furniture" || product=="product_laptop_tablet_computer"){
        if(product=="product_electronic_home"){
            p="product_electronic_home";
        }else if(product=="product_home_furniture"){
            p="product_home_furniture";
        }else if(product=="product_laptop_tablet_computer"){
            p="product_laptop_tablet_computer";
        }
        var totalfiles = $("#input_image")[0].files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append("img[]", $("#input_image")[0].files[index]);
        }
        formData.append('product',p);
        formData.append('id',id);
        formData.append('price_lb',$("#input_price_lb").val());
        formData.append('price_usd', $("#input_price_usd").val());
        formData.append('title',$("#input_title").val());
        formData.append('description',$("#input_description").val());
        formData.append('location',$("#input_location").val());
        formData.append('condition',$("#condition option:selected").text());
    }else if(product=="product_land"){
        p="product_land";
        var totalfiles = $("#input_image")[0].files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append("img[]", $("#input_image")[0].files[index]);
        }
        formData.append('product',p);
        formData.append('id',id);
        formData.append('price_lb',$("#input_price_lb").val());
        formData.append('price_usd', $("#input_price_usd").val());
        formData.append('title',$("#input_title").val());
        formData.append('description',$("#input_description").val());
        formData.append('location',$("#input_location").val());
        formData.append('size',$("#input_size").val());
    }
    $.ajax({
        url:"php_ajax/update_remove_ads.php",
        type:"POST",
        data:formData,
        contentType: false, 
        processData: false,
        success:function(output){
            var obj = JSON.parse(output);
            $("#div_error_price_lb").html("");
            $("#div_error_price_usd").html("");
            $("#div_error_title").html("");
            $("#div_error_description").html("");
            $("#div_error_location").html("");
            $("#div_error_size").html("");

            $("#div_error_price_lb").append(obj.error_price_lb);
            $("#div_error_price_usd").append(obj.error_price_usd);
            $("#div_error_title").append(obj.error_title);
            $("#div_error_description").append(obj.error_description);
            $("#div_error_location").append(obj.error_location);
            $("#div_error_size").append(obj.error_size);
            if(obj.status == 1){
                if(obj.check_img==1){
                    $("#img").empty();
                    $("#img").html(obj.row_img); 
                }
                alert("Product updated successfully.");
            }else if(obj.status == 0){
                alert("Please make change to update product.");
            }
            $("#input_image").val('');
            $("#num_image").html('No image chosen. ');
        }
    });  
}

function remove(product,id){
    var selected_item=$("#product_search_ads option:selected").val();
    formData=new FormData();
    formData.append('check_button','remove');
    formData.append('product',product);
    formData.append('id',id);
    formData.append('s',selected_item);
    $.ajax({
        url:"php_ajax/update_remove_ads.php",
        type:"POST",
        data:formData,
        contentType: false, 
        processData: false,
        success:function(output){
            var obj = JSON.parse(output);   
            if(selected_item=="null"){
                if(obj.status==1){
                    $("#td_"+product+"_"+id).hide(500,function(){     
                        if(obj.check_all_tr==0){
                            $("#tr_no_item_in_sell").show(200);
                        }else{
                            $("#table_body").empty();
                            $("#table_body").append(obj.row);
                        }
                    });
                }
            }else{
                if(obj.status==1){
                    $("#td_"+product+"_"+id).hide(500,function(){    
                        if(obj.check_all == 0 ){
                            if(obj.check_all_tr==0){
                                $("#tr_no_item_in_sell").show(200);
                            }else{
                                $("#table_body").empty();
                                $("#table_body").append(obj.row);
                            }
                        }else{
                            $("#table_body").empty();
                            $("#table_body").append(obj.row);
                        }
                    });
                }
            }
        }
    });
}

$(document).ready(function(){
    $("#product_search_ads").change(function(){
        $("#table_body").empty();
        var selected_item=$("#product_search_ads option:selected").text();
        var selected_item2=$("#product_search_ads option:selected").val();
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
                s:selected_item2,
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
                        $("#table_body_no_item").show(200);
                        
                    }
                }            
            }
        });
    });
});