//For regiter and login
function ShowHidePass() {
    var x = document.getElementById("input_password");
    var y= document.getElementById("i_eye1");
    var z= document.getElementById("i_eye2");
    if (x.type === "password") {
        x.type = "text";
        y.style.display="none";
        z.style.display="block";

    } else {
        x.type = "password";
        y.style.display="block";
        z.style.display="none";
    }
}

function ShowHideConfPass() {
    var x = document.getElementById("input_confirm_password");
    var y= document.getElementById("i_eye3");
    var z= document.getElementById("i_eye4");
    if (x.type === "password") {
        x.type = "text";
        y.style.display="none";
        z.style.display="block";

    } else {
        x.type = "password";
        y.style.display="block";
        z.style.display="none";
    }
}

//For update profile
function ShowHideCurrentPass() {
    var x = document.getElementById("input_current_password");
    var y= document.getElementById("i_eye1");
    var z= document.getElementById("i_eye2");
    if (x.type === "password") {
        x.type = "text";
        y.style.display="none";
        z.style.display="block";

    } else {
        x.type = "password";
        y.style.display="block";
        z.style.display="none";
    }
}
function ShowHideNewPass() {
    var x = document.getElementById("input_new_password");
    var y= document.getElementById("i_eye3");
    var z= document.getElementById("i_eye4");
    if (x.type === "password") {
        x.type = "text";
        y.style.display="none";
        z.style.display="block";

    } else {
        x.type = "password";
        y.style.display="block";
        z.style.display="none";
    }
}
function ShowHideRetypeNewPass() {
    var x = document.getElementById("input_retype_new_password");
    var y= document.getElementById("i_eye5");
    var z= document.getElementById("i_eye6");
    if (x.type === "password") {
        x.type = "text";
        y.style.display="none";
        z.style.display="block";

    } else {
        x.type = "password";
        y.style.display="block";
        z.style.display="none";
    }
}