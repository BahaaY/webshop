//For navbar product
$(document).ready(function(){

    var vehicle_motorcycle=$("#div_vehicle_motorcycle");
    var apartment=$("#div_apartment");
    var electronic_home_appliance=$("#div_electronic_home_appliance");
    var home_furniture=$("#div_home_furniture");
    var laptop_tablet_computer=$("#div_laptop_tablet_computer");
    var land=$("#div_land");
    
    $("#product").change(function(){

        var selected_item=$("#product option:selected").text();
        if(selected_item!="null"){
            $("#div_container").css({
                "top": "0px"
            });
        }

        if(selected_item=="Vehicles & motorcycles"){
            vehicle_motorcycle.slideDown(700);
            apartment.slideUp(300);
            electronic_home_appliance.slideUp(300);
            home_furniture.slideUp(300);
            laptop_tablet_computer.slideUp(300);
            land.slideUp(300);
        }else if(selected_item=="Apartment"){
            vehicle_motorcycle.slideUp(300);
            apartment.slideDown(700);
            electronic_home_appliance.slideUp(300);
            home_furniture.slideUp(300);
            laptop_tablet_computer.slideUp(300);
            land.slideUp(300);
        }else if(selected_item=="Electronics & home appliance"){
            vehicle_motorcycle.slideUp(300);
            apartment.slideUp(300);
            electronic_home_appliance.slideDown(700);
            home_furniture.slideUp(300);
            laptop_tablet_computer.slideUp(300);
            land.slideUp(300);
        }else if(selected_item=="Home furnitures"){
            vehicle_motorcycle.slideUp(300);
            apartment.slideUp(300);
            electronic_home_appliance.slideUp(300);
            home_furniture.slideDown(700);
            laptop_tablet_computer.slideUp(300);
            land.slideUp(300);
        }else if(selected_item=="Laptops, Tablets & computers"){
            vehicle_motorcycle.slideUp(300);
            apartment.slideUp(300);
            electronic_home_appliance.slideUp(300);
            home_furniture.slideUp(300);
            laptop_tablet_computer.slideDown(700);
            land.slideUp(300);
        }else if(selected_item=="Lands"){
            vehicle_motorcycle.slideUp(300);
            apartment.slideUp(300);
            electronic_home_appliance.slideUp(300);
            home_furniture.slideUp(300);
            laptop_tablet_computer.slideUp(300);
            land.slideDown(700);
        }
    });

    $("#btn_close_vehicle").click(function(){
        close_div(vehicle_motorcycle);
    });
    $("#btn_close_apartment").click(function(){
        close_div(apartment);
    });
    $("#btn_close_electronic").click(function(){
        close_div(electronic_home_appliance);
    });
    $("#btn_close_home").click(function(){
        close_div(home_furniture);
    });
    $("#btn_close_laptop").click(function(){
        close_div(laptop_tablet_computer);
    });
    $("#btn_close_land").click(function(){
        close_div(land);
    });

//Funcion for close div product
    function close_div(div){
        div.slideUp(300);
        $('#product').val("null");
        $("#div_container").css({
            "top": "35%"
        });
    }
    
});

$(document).ready(function(){

    width=$(window).outerWidth();
    if(width<=1230){
        $("#navbar_left").hide();   
        $("#bars_open").show();  
        $("#bars_close").hide(); 
        $("#div_container_items").css({
            "transform": "translate(-50%, -50%)"
        });
        $("#fa_fa_refresh").css({
            "left": "10px"
        });
    }else{
        $("#navbar_left").show();
        $("#bars_open").hide();  
        $("#bars_close").hide();
        $("#div_container_items").css({
            "transform": "translate(-40%, -50%)"
        });
        $("#fa_fa_refresh").css({
            "left": "330px"
        });
    }

    
    $(window).resize(function(){
        var width=$(window).outerWidth();
        if(width<=1230){
            $("#navbar_left").hide();   
            $("#bars_open").show();  
            $("#bars_close").hide(); 
            $("#div_container_items").css({
                "transform": "translate(-50%, -50%)"
            });
            $("#fa_fa_refresh").css({
                "left": "10px"
            });
        }else{
            $("#navbar_left").show();
            $("#bars_open").hide();  
            $("#bars_close").hide();
            $("#div_container_items").css({
                "transform": "translate(-40%, -50%)"
            });
            $("#fa_fa_refresh").css({
                "left": "330px"
            });
        }

    });

    $("#bars_open").click(function(){
        $("#div_container_items").hide();
        $("#bars_open").hide();
        $("#bars_close").show();
        $("#navbar_left").slideDown(100); 
        $("#navbar_left").css({
            "min-width":"100%",
            "top":"140px",
        }); 
    });

    $("#bars_close").click(function(){
        $("#div_container_items").show();
        $("#bars_close").hide();
        $("#bars_open").show();
        $("#navbar_left").slideUp(100); 
        $("#navbar_left").css({
            "min-width":"320px",
            "top":"70px",
        }); 
    });
});