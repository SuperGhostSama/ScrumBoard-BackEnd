<?php

//INCLUDE DATABASE FILE
include 'database.php';

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save'])){
    $title = $_POST['title'];
    $type = $_POST['taskType'];
    $priority = $_POST['taskPriority'];
    $status = $_POST['taskStatus'];
    $date = $_POST['taskDate'];
    $decription = $_POST['taskDescription'];
    saveTask($title,$type,$priority,$status,$date,$decription);
}
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();


function getTasks()
{
    //CODE HERE
    //SQL SELECT

    echo "Fetch all tasks";
}


function saveTask($title,$type,$priority,$status,$date,$decription)
{

    //SQL INSERT
    $query = "INSERT INTO tasks(title, type_id, priority_id, status_id, task_datetime, description) VALUES ('$title','$type','$priority','$status','$date','$decription')";

    global $connection;//to make it visible into the scope of the function 

    mysqli_query($connection, $query);
    
    $_SESSION['message'] = "Task has been added successfully !";
    header('location:index.php');
    
}

function updateTask()
{
    //CODE HERE
    //SQL UPDATE
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
}

function deleteTask()
{
    //CODE HERE
    //SQL DELETE
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}
