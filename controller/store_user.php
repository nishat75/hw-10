<?php

session_start();
include "../inc/env.php";

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['number'];
$password=$_REQUEST['password'];
$confirm_password=$_REQUEST['confirm_password'];

$errors=[];


if(empty($name)){
    $errors['name_error']="please enter your name";
}

if(empty($email)){

    $errors['email_error']="please enter your email";

}else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
    $errors['email_error']="please enter your valid email";
}

if((strlen($phone))!=11){
    $errors['number_error']="enter a valid number";
}

if(empty($password)){

    $errors['password_error']="please enter your password";

}else if(strlen($password)<8){
    $errors['password_error']="please enter strong password";

}
if(empty($confirm_password)){

    $errors['con_password_error']="please enter your confirm password";

}else if($password!=$confirm_password){
    $errors['con_password_error']="confirm password did not match";
}

if(count($errors)>0){
    $_SESSION['error']=$errors;
    header("location:../register.php");
}else{
    $query="INSERT INTO users(name, email, phone, password) VALUES ('$name','$email','$phone','$password')";
    $response=mysqli_query($conn,$query);
    var_dump($response);
}

