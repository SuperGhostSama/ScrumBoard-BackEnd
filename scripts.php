<?php

//INCLUDE DATABASE FILE
include 'database.php';

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();


function getTasks()
{
    //CODE HERE
    //SQL SELECT
    echo "Fetch all tasks";
}


function saveTask()
{
    $title = $_POST['title'];
    $type = $_POST['taskType'];
    $priority = $_POST['taskPriority'];
    $status = $_POST['taskStatus'];
    $date = $_POST['taskDate'];
    $decription = $_POST['taskDescription'];

    echo $connection . '<br>';
    echo $title . '<br>';
    echo $type . '<br>';
    echo $priority . '<br>';
    echo $status . '<br>';
    echo $date . '<br>';
    echo $decription . '<br>';

    if (isset($title) && isset($type) && isset($priority) && isset($status) && isset($date) && isset($decription)) {
        //SQL INSERT
        $query = "INSERT INTO `tasks` VALUES ('$title',$type,$priority,$status,$date,'$decription')";
        $result = mysqli_query($connection, $query);
        echo 'here';
        if ($result) {
            $_SESSION['message'] = "Task has been added successfully !";
            header('location:index.php');
        } else {
            die(mysqli_error($connection));
        }
    }
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
