<?php

//INCLUDE DATABASE FILE
include 'database.php';

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//getting all tasks to print them on index page
// $allTasks = getTasks();

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


function getTasks($selector)
{
    //CODE HERE
                $query="SELECT
                    tasks.id ,tasks.title ,tasks.type_id ,tasks.priority_id ,tasks.status_id ,tasks.task_datetime ,tasks.description ,
                    types.name AS typeName,
                    priorities.name AS priorityName,
                    statuses.name AS statusName
                    FROM tasks
                    INNER JOIN types
                    ON types.id = tasks.type_id
                    INNER JOIN priorities
                    ON priorities.id = tasks.priority_id
                    INNER JOIN statuses
                    ON statuses.id = tasks.status_id WHERE statuses.name='$selector'
                    ";
    // $query="SELECT tasks.id ,title ,tasks.type_id,tasks.priority_id ,tasks.status_id ,tasks.task_datetime ,tasks.description , types.name ,priorities.name , statuses.name FROM statuses , tasks,priorities WHERE tasks.type_id=types.id AND tasks.priority_id=priorities.id AND statuses.id = tasks.status_id ";

    //SQL SELECT
    global $connection;//to make it visible into the scope of the function 
    $result=mysqli_query($connection, $query);
    
    return $result;
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
