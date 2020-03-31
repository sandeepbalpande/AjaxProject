
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="jquery.cookie.js"></script>

<script>

$(document).ready(function(){

user_id=$.cookie("user_id");

if(user_id===undefined)
{
	window.location.href="index.php";
}

$.ajax({
url: 'get_user_details.php',
type: 'post',

success: function(response){
response = JSON.parse(response);
total_data=response.length
var row="";
for(i=0;i<total_data;i++){

j=i+1;


row=row+'<tr><td>'+j+'</td><td>'+response[i].username+'</td><td>'+response[i].mobile+'</td><td>'+response[i].email+'</td><td>'+response[i].address+'</td>';

if(response[i].is_allowed==1)
{
	row=row+'<td><input type="button" onclick="is_allowed('+response[i].id+','+response[i].is_allowed+')" value="Allowed"> </td>';
}else if(response[i].is_allowed==0)
{
	row=row+'<td><input type="button" onclick="is_allowed('+response[i].id+','+response[i].is_allowed+')" value="Not Allowed"> </td>'
}

row=row+'</tr>';

}



$(".user_details").html(row)

}
});

$(".logout").click(function(){
$.removeCookie('user_id');

window.location.href="index.php";


});

});

</script>
<script>
function is_allowed(id, allowed_status)
{


var is_allowed=0

if(allowed_status==1)
{
is_allowed=0;
}else if(allowed_status==0){
is_allowed=1;
}

var status_confirm=confirm("Do you want to revoked access ?")

if(status_confirm)
{

$.ajax({
url: 'update_allow_status.php',
type: 'post',
data: "id=" + id + "&is_allowed=" +  is_allowed,
success: function(response){

if(response.success!=0 || response.success!="")
{
if(is_allowed==1)
{
alert("Access allowed")
}else if(is_allowed==0){
alert("Access has been revoked")
}

location.reload();

}else{
alert("Failed to allowed Access")
location.reload()
}

}
});

}else{
location.reload();
}



}
</script>
</head>
<body>

<div class="container">
<p>&nbsp;</p>

<div class="pull-right">
<button class="btn btn-danger logout" href="">Log Out</button> 
</div>
<p>&nbsp;</p>
<h2>User Details</h2> 
<a href="get_all_logistics_details.php" class="btn btn-primary pull-center">View Logistic Details</a>
<a href="add_logistics_details.php" class="btn btn-primary pull-right">Add Logistic</a>
<p>&nbsp;</p>


<table class="table">
<thead>
<tr>
<th>Sno.</th>
<th>User Name</th>
<th>Mobile</th>
<th>Email</th>
<th>Address</th>
<th>Is Allowed</th>
</tr>
</thead>
<tbody class="user_details">

</tbody>
</table>
</div>

</body>
</html>
<?php


?>