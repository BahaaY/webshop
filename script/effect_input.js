//Change color input
$(document).ready(function(){

    input = [
        //For navbar
        "#input_search",
        //For product
        "#input_price_lb","#input_price_usd","#input_title","#input_description","#input_location","#input_size",
        //For login and register
        "#input_first_name","#input_last_name","#input_username","#input_phone_number","#input_email","#input_password","#input_confirm_password",
        //For update password
        "#input_current_password","#input_new_password","#input_retype_new_password",
        //For search from / to
        "#input_price_lb_from1","#input_price_lb_to1","#input_price_usd_from1","#input_price_usd_to1",
        "#input_price_lb_from2","#input_price_lb_to2","#input_price_usd_from2","#input_price_usd_to2",
        "#input_price_lb_from3","#input_price_lb_to3","#input_price_usd_from3","#input_price_usd_to3",
        "#input_price_lb_from4","#input_price_lb_to4","#input_price_usd_from4","#input_price_usd_to4",
        "#input_price_lb_from5","#input_price_lb_to5","#input_price_usd_from5","#input_price_usd_to5",
        "#input_price_lb_from6","#input_price_lb_to6","#input_price_usd_from6","#input_price_usd_to6",
    ];
        
    label = [
        //For navbar
        "#label_search",
        //For product
        "#label_price_lb","#label_price_usd","#label_title","#label_description","#label_location","#label_size",
        //For login and register
        "#label_first_name","#label_last_name","#label_username","#label_phone_number","#label_email","#label_password","#label_confirm_password",
        //For update password
        "#label_current_password","#label_new_password","#label_retype_new_password",
        //For search from / to
        "#label_price_lb_from1","#label_price_lb_to1","#label_price_usd_from1","#label_price_usd_to1",
        "#label_price_lb_from2","#label_price_lb_to2","#label_price_usd_from2","#label_price_usd_to2",
        "#label_price_lb_from3","#label_price_lb_to3","#label_price_usd_from3","#label_price_usd_to3",
        "#label_price_lb_from4","#label_price_lb_to4","#label_price_usd_from4","#label_price_usd_to4",
        "#label_price_lb_from5","#label_price_lb_to5","#label_price_usd_from5","#label_price_usd_to5",
        "#label_price_lb_from6","#label_price_lb_to6","#label_price_usd_from6","#label_price_usd_to6",
    ];

    for (let i = 0; i < input.length; i++) {
        change_color_input_label(input[i],label[i]);
    }

    for (let i = 0; i < input.length; i++) {
        $(input[i]).on({
            focusin:function(){
                var text = $(input[i]).val();
                if(text==""){
                    change_to_skyBlue(input[i],label[i]);
                }
            },
            focusout:function(){
                change_color_input_label(input[i],label[i]);
            },
        });
    }
    
    //Function for change style input
    function change_color_input_label(input,label){
        var text = $(input).val();
        if(text!=""){
            change_to_skyBlue(input,label);
        }else{
            change_to_white_bottom(input,label);
        }
    }
    
    function change_to_white_bottom(input,label){
        $(input).css({
            "border-color": "white",
        });
        $(label).css({
            "top": "-30px",
            "color":"white"
        });
    }
    
    function change_to_skyBlue(input,label){
        $(input).css({
            "border-color": "skyblue",
        });
        $(label).css({
            "top": "-50px",
            "color":"skyblue"
        });
    }
    
});