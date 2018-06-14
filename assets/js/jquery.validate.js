//VALIDATION
//Name Validation
var val_error=0;
var val_err_txt = new Array();
$(document).ready(function(e) {
    var email = $("#inquiry_name");
    $('#send_inquiry_to_client').click(function(ev) {
        if (validateEmail()) {
            return true;
        } else {
            return false;			
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt.push("Please Enter Your Name");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
    } 
});
// E-Mail Validation
$(document).ready(function(e) {
    var email = $("#inquiry_email");
    $('#send_inquiry_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        }
		else {
            return false;
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt.push("Please Enter Your Email");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
        var a = email.val(); 
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-zA-Z0-9]{2,4}$/;
        if (filter.test(a)) {
			email.css({
                    "border": "",
                    "background": ""
                });
            return true;
        }
        else {
            email.focus();
            val_err_txt.push("Please Enter Valid Email");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
            return false;
        }
    }
});
//Phone
$(document).ready(function(e){
    var email = $("#inquiry_phone");
    $('#send_inquiry_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        } else {
            return false;
        } 
    });
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt.push("Please Enter Phone Number");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
            return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
    } 
});
//Service
$(document).ready(function(e) {
var email = $("#inquiry_service");
    $('#send_inquiry_to_client').click(function(e) {
       if (validateEmail()) {
            return true;
        } else {
            return false;
        } 
    });
    function validateEmail() {
        if (email.val() === "") {
            val_err_txt.push("Please Select anyone Service");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
            return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
			return true;
        }
  
    }
});
//City
$(document).ready(function(e) {
var email = $("#inquiry_city");
    $('#send_inquiry_to_client').click(function(e) {
       if (validateEmail()) {
            return true;
        } else {
            return false;
        } 
    });
    function validateEmail() {
        if (email.val() === "") {
            val_err_txt.push("Please Select Anyone City");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
            return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
			return true;
        }
  
    }
});
//PINCODE
$(document).ready(function(e){
    var email = $("#inquiry_pincode");
    $('#send_inquiry_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        } else {
            return false;
        } 
    });
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt.push("Please Enter Pincode");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
            return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
        var a = email.val(); 
        var filter = /^\d{6}$/;
        if (filter.test(a)) {
			email.css({
                    "border": "",
                    "background": ""
                });		
            return true;
        }
        else {
			email.focus();
            val_err_txt.push("Please Enter Valid Pincode");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
            return false;
        }
    } 
});
//Address
$(document).ready(function(e) { 
    var email = $("#inquiry_address");
    $('#send_inquiry_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        } else {
            return false;			
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt.push("Please enter your Address");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
			return true;
        }        
    } 
});

//Message
$(document).ready(function(e) { 
    var email = $("#inquiry_message");
    $('#send_inquiry_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        } else {
            return false;			
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt.push("Please enter your Query");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
			return true;
        }        
    } 
});

//FInal
$(document).ready(function(e) { 
    var email = $("#inquiry_message");
    var emailInfo = $("#send_inquiry_error");
    $('#send_inquiry_to_client').click(function(e) {
        
        if(val_error){
        	emailInfo.html(val_err_txt.join("<br/>"));
        	val_err_txt = [];
        	val_error=0;
        	emailInfo.removeClass('alert-success').addClass('alert-danger');
        	emailInfo.addClass("error");
        	emailInfo.css({
                    "display": "block"
                });
        	return false;
        } else {
            newConnection();
        	emailInfo.removeClass("error");
        	emailInfo.css({
                    "display": "none"
                });
        	return false;
        }
        
    });
});

function newConnection(){
    var send_inquiry_error = $("#send_inquiry_error");
    $.ajax({url: "/new-connection-submission",
    type: "POST",
    data: $("#View_inquiry_popup_form").serialize(),
    success: function(result){
        //var obj = JSON.parse(result);
        if(result.code && result.code===200){
        send_inquiry_error.removeClass('alert-danger').addClass('alert-success');
        send_inquiry_error.css({"display": "block"});
        send_inquiry_error.html(result.message);
        }else{
        send_inquiry_error.removeClass('alert-success').addClass('alert-danger');
        send_inquiry_error.css({"display": "block"});
        send_inquiry_error.html(result.message);
        }
    },
    error: function(xhr){
            send_inquiry_error.css({"display": "block"});
            send_inquiry_error.html("An error occured: " + xhr.status + " " + xhr.statusText);
        }
        
    });
}
 
//CONTACT FORM
var val_error_con=0;
var val_err_txt_con = new Array();
$(document).ready(function(e) {
    var email = $("#contact_us_name");
    $('#send_contact_us_to_client').click(function(ev) {
        if (validateEmail()) {
            return true;
        } else {
            return false;			
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt_con.push("Please Enter Your Name");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_con++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
    } 
});
// E-Mail Validation
$(document).ready(function(e) {
    var email = $("#contact_us_email");
    $('#send_contact_us_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        }
		else {
            return false;
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt_con.push("Please Enter Your Email");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_con++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
        var a = email.val(); 
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-zA-Z0-9]{2,4}$/;
        if (filter.test(a)) {
			email.css({
                    "border": "",
                    "background": ""
                });
            return true;
        }
        else {
            email.focus();
            val_err_txt_con.push("Please Enter Valid Email");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_con++;
            return false;
        }
    }
});
//Phone
$(document).ready(function(e){
    var email = $("#contact_us_phone");
    $('#send_contact_us_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        } else {
            return false;
        } 
    });
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt_con.push("Please Enter Phone Number");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_con++;
            return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
    } 
});
//City
$(document).ready(function(e) {
var email = $("#contact_us_city");
    $('#send_contact_us_to_client').click(function(e) {
       if (validateEmail()) {
            return true;
        } else {
            return false;
        } 
    });
    function validateEmail() {
        if (email.val() === "") {
            val_err_txt_con.push("Please Select Anyone City");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_con++;
            return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
			return true;
        }
  
    }
});

//Message
$(document).ready(function(e) { 
    var email = $("#contact_us_message");
    $('#send_contact_us_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        } else {
            return false;			
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt_con.push("Please enter your Query");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_con++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
			return true;
        }        
    } 
});

//FInal
$(document).ready(function(e) {
    var emailInfo = $("#send_contact_us_error");
    $('#send_contact_us_to_client').click(function(e) {
        
        if(val_error_con){
        	emailInfo.html(val_err_txt_con.join("<br/>"));
        	val_err_txt_con = [];
        	val_error_con=0;
        	emailInfo.removeClass('alert-success').addClass('alert-danger');
        	emailInfo.css({
                    "display": "block"
                });
        	return false;
        } else {
            newContact();
        	emailInfo.css({
                    "display": "none"
                });
        	return false;
        }
        
    });
});


function newContact(){
    var send_inquiry_error = $("#send_contact_us_error");
    $.ajax({url: "/contact-home-submission",
    type: "POST",
    data: $("#View_contact_us_popup_form").serialize(),
    success: function(result){
        //var obj = JSON.parse(result);
        if(result.code && result.code==200){
        send_inquiry_error.removeClass('alert-danger').addClass('alert-success');
        send_inquiry_error.css({"display": "block"});
        send_inquiry_error.html(result.message);
        }else{
        send_inquiry_error.removeClass('alert-success').addClass('alert-danger');
        send_inquiry_error.css({"display": "block"});
        send_inquiry_error.html(result.message);
        }
    },
    error: function(xhr){
        send_inquiry_error.css({"display": "block"});
            send_inquiry_error.html("An error occured: " + xhr.status + " " + xhr.statusText);
        }
        
    });
}



var val_error_log=0;
var val_err_txt_log = new Array();
//USER NAME
$(document).ready(function(e) {
    var email = $("#user_name");
    $('#login_to_client').click(function(ev) {
        if (validateEmail()) {
            return true;
        } else {
            return false;			
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt_log.push("Please Enter User Name");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_log++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
 
    }
});
//Password Validation
$(document).ready(function(e) {
    var email = $("#user_password");
    $('#login_to_client').click(function(e) {
        if (validateEmail()) {
            return true;
        }
		else {
            return false;
        } 
    });	
    function validateEmail() {
        if (email.val() == "") {
            val_err_txt_log.push("Please Enter Password");
			email.css({
                    "border": "1px solid #da0000",
                    "background": "#FFCECE"
                });
                val_error_log++;
			return false;
        } else {
			email.css({
                    "border": "",
                    "background": ""
                });
        }
    }
});

//FInal
$(document).ready(function(e) {
    var emailInfo = $("#send_login_error");
    $('#login_to_client').click(function(e) {
        
        if(val_error_log){
        	emailInfo.html(val_err_txt_log.join("<br/>"));
        	val_err_txt_log = [];
        	val_error_log=0;
        	emailInfo.removeClass('alert-success').addClass('alert-danger');
        	emailInfo.css({
                    "display": "block"
                });
        	return false;
        } else {
            newLogin();
        	emailInfo.css({
                    "display": "none"
                });
        	return false;
        }
        
    });
});

function newLogin(){
    var send_inquiry_error = $("#send_login_error");
    $.ajax({url: "/login-submission",
    type: "POST",
    data: $("#View_login_popup_form").serialize(),
    success: function(result){
        //var obj = JSON.parse(result);
        if(result.code && result.code==200){
        send_inquiry_error.removeClass('alert-danger').addClass('alert-success');
        send_inquiry_error.css({"display": "block"});
        send_inquiry_error.html(result.message);
        setTimeout(function(){ window.location = "/my-account"; }, 2000);
        }else{
        send_inquiry_error.removeClass('alert-success').addClass('alert-danger');
        send_inquiry_error.css({"display": "block"});
        send_inquiry_error.html(result.message);
        }
    },
    error: function(xhr){
        send_inquiry_error.css({"display": "block"});
            send_inquiry_error.html("An error occured: " + xhr.status + " " + xhr.statusText);
        }
        
    });
}