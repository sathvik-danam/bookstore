<?php

session_start();
    
if(isset($_POST['Logout']))
{
    session_destroy();
    header("location: login.php");
}

if(!isset($_SESSION['UserUsername']))
{
    header("location: login.php");
}
require_once("theconnection.php");

//This adds new book
if(isset($_POST['addbook']))
{
    
    $stmt = $Conn->prepare('INSERT INTO books (category_id, title, description)
    VALUES (:category_id, :title, :description)');
    $stmt->execute(array('category_id'=>$_POST['dropdown'],'title'=>$_POST['title'],'description'=>$_POST['description']));
    
    if($stmt){
        echo 'success';
        
        
    }else{
        echo 'Might be exustss';
               
    }
    // header("location: userpanel.php?msg=".$msg);
}



?>