<?php

//INCLUDE DATABASE FILE
include 'database.php';

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save'])){       saveTask($title,$type,$priority,$status,$date,$description);
}
if (isset($_POST['update']))      updateTask($id,$title,$type,$priority,$status,$date,$description);
if (isset($_POST['delete']))      deleteTask();

                //counters
function counterToDo(){
    $query="SELECT COUNT(id) as compteur FROM `tasks` WHERE status_id = 1";
    global $connection;//to make it visible into the scope of the function 
    $result=mysqli_query($connection, $query);
    $result= mysqli_fetch_assoc($result);
    return $result['compteur'];
}
function counterInProgress(){
    $query="SELECT COUNT(id) as compteur FROM `tasks` WHERE status_id = 2";
    global $connection;//to make it visible into the scope of the function 
    $result=mysqli_query($connection, $query);
    $result= mysqli_fetch_assoc($result);
    return $result['compteur'];
}
function counterDone(){
    $query="SELECT COUNT(id) as compteur FROM `tasks` WHERE status_id = 3";
    global $connection;//to make it visible into the scope of the function 
    $result=mysqli_query($connection, $query);
    $result= mysqli_fetch_assoc($result);
    return $result['compteur'];
}




//DISPLAY FUNCTION
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
    //SQL SELECT
    global $connection;//to make it visible into the scope of the function 
    $result=mysqli_query($connection, $query);
    
    return $result;
}

//SAVE FUNCTION
function saveTask($title,$type,$priority,$status,$date,$description)
{
    $title = $_POST['title'];
    $type = $_POST['taskType'];
    $priority = $_POST['taskPriority'];
    $status = $_POST['taskStatus'];
    $date = $_POST['taskDate'];
    $description = $_POST['taskDescription'];
    //SQL INSERT
    $query = "INSERT INTO tasks(title, type_id, priority_id, status_id, task_datetime, description) VALUES ('$title','$type','$priority','$status','$date','$description')";

    global $connection;//to make it visible into the scope of the function 

    mysqli_query($connection, $query);
    
    $_SESSION['message'] = "Task has been added successfully !";
    header('location:index.php');
    
}
//UPDATE FUNCTION
function updateTask()
{
    $title = $_POST['title'];
    $type = $_POST['taskType'];
    $priority = $_POST['taskPriority'];
    $status = $_POST['taskStatus'];
    $date = $_POST['taskDate'];
    $description = $_POST['taskDescription'];
    $id = $_GET['id'];
    //CODE HERE 
    $query= "UPDATE tasks 
            SET title='$title', description='$description',type_id='$type', priority_id ='$priority', status_id='$status', task_datetime='$date'
            WHERE id='$id'";
            
    global $connection;
    mysqli_query($connection, $query);

    //SQL UPDATE
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
}

//DELETE FUNCTION
function deleteTask()
{
    //CODE HERE
    $id = $_GET['id'];
    //SQL DELETE
    $query = "DELETE FROM tasks WHERE id='$id'";

    global $connection;
    mysqli_query($connection, $query);
    
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}

