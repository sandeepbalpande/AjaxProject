<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="jquery.cookie.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
width: 100%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
}

button {
background-color: #4CAF50;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
cursor: pointer;
width: 100%;
}

button:hover {
opacity: 0.8;
}

.imgcontainer {
text-align: center;
margin: 24px 0 12px 0;
}

img.avatar {
width: 40%;
border-radius: 50%;
}

.container {
padding: 16px;
}

span.psw {
float: right;
padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
span.psw {
display: block;
float: none;
}

}
</style>

<script>
$(document).ready(function(){
$(".login_details").click(function(){
var email=	$("#email").val().trim();
var password=	$("#password").val().trim();

email_length=email.length
password_length=password.length

var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
valid_email= emailReg.test(email);

if(valid_email==false){

alert("Please enter valid email id")
$("#email").val("")

return
}
if(email=="" || email_length==0){

alert("Please enter email id")
$("#email").val("")
return

}
if(password== "" || password_length==0)
{
alert("please enter Password")
return false
}
$.ajax({
url: 'login.php',
type: 'post',
data: "email=" + email + "&password="+ password,
success: function(response){
response = JSON.parse(response);

if(response.success!=0 || response.success!="")
{
$.cookie("user_id", response.success[0].id);
if(response.success[0].id==1)
{
	window.location.href="dashboard.php";
}else{
	window.location.href="getLogisticInfoBasedOnUser.php";
}

}else{
alert("Invalid email and password")
location.reload()
}



}
});

});


$(".signup").click(function(){

window.location.href="add_users_details.php";


});

});
</script>
</head>
<body>

<div class="imgcontainer">
<h4>Login Form</h4>
</div>

<div class="container">
<label for="email"><b>Email</b></label>
<input type="text" placeholder="Enter email" id="email" required>

<label for="password"><b>Password</b></label>
<input type="password" placeholder="Enter Password" id="password" required>
<p>&nbsp;</p>
<button type="button" class="btn btn-success login_details">Login</button>
<button type="button" class="btn btn-primary signup">Sign up</button>
</div>






</body>
</html>