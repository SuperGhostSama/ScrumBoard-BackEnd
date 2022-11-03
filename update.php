<?php 
include 'database.php';
include 'scripts.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="SELECT * from tasks WHERE id='$id'";
//SQL SELECT
global $connection;//to make it visible into the scope of the function 
$result=mysqli_query($connection, $query);
$task=mysqli_fetch_assoc($result);

}


if (isset($_POST['update']))
        unset($_POST['update']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	
	<!-- ================== BEGIN core-css ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
    <title>Document</title>
</head>
<body>
			<div class="modal-content">
				<form action="" method="POST" id="form-task">
					<div class="modal-header">
						<h5 class="modal-title">Add Task</h5>
						<a href="index.php" class="btn-close"></a>
					</div>
					<div class="modal-body">
							<!-- This Input Allows Storing Task Index  -->
							<input type="hidden" id="task-id">
							<div class="mb-3">
								<label class="form-label" >Title</label>
								<input name="title" type="text" class="form-control" id="task-title" value="<?= $task['title']; ?>" required/>
							</div>
							<div class="mb-3">
								<label class="form-label">Type</label>
								<div class="ms-3">
									<div class="form-check mb-1">
										<input class="form-check-input" name="taskType" <?= $task['type_id']=='1' ? 'checked' : ''?> type="radio"  value="1" id="task-type-feature"/>
										<label class="form-check-label" for="task-type-feature">Feature</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" name="taskType" <?= $task['type_id']=='2' ? 'checked' : ''?> type="radio" value="2" id="task-type-bug"/>
										<label class="form-check-label" for="task-type-bug">Bug</label>
									</div>
								</div>
								
							</div>
							<div class="mb-3">
								<label class="form-label">Priority</label>
								<select class="form-select" id="task-priority" name="taskPriority" required>
									<option selected disabled value="">Please select</option>
									<option <?= $task['priority_id']=='1' ? 'selected' : ''?> value="1">Low</option>
									<option <?= $task['priority_id']=='2' ? 'selected' : ''?> value="2">Medium</option>
									<option <?= $task['priority_id']=='3' ? 'selected' : ''?> value="3">High</option>
									<option <?= $task['priority_id']=='4' ? 'selected' : ''?> value="4">Critical</option>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Status</label>
								<select class="form-select" id="task-status" name="taskStatus"required>
									<option selected disabled value="">Please select</option>
									<option <?= $task['status_id']=='1' ? 'selected' : ''?> value="1">To Do</option>
									<option <?= $task['status_id']=='2' ? 'selected' : ''?> value="2">In Progress</option>
									<option <?= $task['status_id']=='3' ? 'selected' : ''?> value="3">Done</option>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Date</label>
								<input type="date" class="form-control" value="<?= $task['task_datetime']; ?>" id="task-date" name="taskDate" required/>
							</div>
							<div class="mb-0">
								<label class="form-label">Description</label>
								<textarea class="form-control" rows="10"  id="task-description" name="taskDescription" required><?= $task['description']; ?></textarea>
							</div>
						
					</div>
					<div class="modal-footer">
						<a href="index.php" class="btn btn-white" >Cancel</a>
						<button type="submit" name="delete" class="btn btn-danger task-action-btn" id="task-delete-btn">Delete</button>
						<button type="submit" name="update" class="btn btn-warning task-action-btn" id="task-update-btn">Update</button>
					</div>
				</form>
			</div>

</body>
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->
</html>