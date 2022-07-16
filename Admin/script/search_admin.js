function view_ads(uid){
    window.location.href="View_ads.php?uid="+uid;
}
function block_unblock(uid){
    $("#block_unblock_"+uid).val('Loading...');
    $.ajax({
        url:"php_ajax/block_unblock.php",
        type:"POST",
        data:{ 
            uid: uid,
        },
        success:function(output){
            var obj=JSON.parse(output);
            if(obj.result == 1){
                $("#block_unblock_"+uid).val('Unblock user');
            }else if(obj.result == 0){
                $("#block_unblock_"+uid).val('Block user');
            } 
        }
    });
}
$(document).ready(function(){
    $("#input_search").keyup(function(){
        $("#table_body").empty();
        $.ajax({
            url:"php_ajax/search_admin.php",
            type:"POST",
            data:{ 
                text: $("#input_search").val()
            },
            success:function(output){
                var obj = JSON.parse(output);
                if(obj.resultat_select>0){
                    $("#table_body").empty();
                    $("#table_body").append(obj.row);
                }else{
                    $("#table_body").empty();
                    $("#table_body").append(obj.row);
                }
            }
        });
    });
});