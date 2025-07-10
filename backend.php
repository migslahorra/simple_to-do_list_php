<?php

require "database.php";

if(isset($_POST['submit'])) {
    $task = $_POST['task'];

// Using MYSQLi prepared statement
    $input = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $input->bind_param("s", $task);
    $input->execute();

    header("Location: index.php");
    exit();
}

// Deletion
elseif (isset($_POST['delete']))
{ 
    $id = $_POST['id'];
    $input = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $input->bind_param('i', $id);
    $input->execute();

    header("Location: index.php");
    exit();
}

// Update
elseif (isset($_POST['complete']))
{
    $id = $_POST['id'];
    $input = $conn->prepare("UPDATE tasks SET complete = 1 where id = ? ");
    $input->bind_param('i', $id);
    $input->execute();

    header("Location: index.php");
    exit();
}