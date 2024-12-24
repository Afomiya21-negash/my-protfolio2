<?php
require_once 'connection/db.php';

// Insert About Content
if (isset($_POST['add_about'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $picture = '';

    // Handle Image Upload
    if (!empty($_FILES['picture']['name'])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $picture = $uploadDir . uniqid() . "-" . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $picture);
    }

    $db->manageAbout('create', null, $title, $description, $picture);
    header("Location: admin.php?section=about&action=success");
    exit;
}

// Update About Content
if (isset($_POST['update_about'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $picture = $_POST['existing_picture'];

    // Handle Image Upload
    if (!empty($_FILES['picture']['name'])) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $picture = $uploadDir . uniqid() . "-" . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $picture);
    }

    $db->manageAbout('update', $id, $title, $description, $picture);
    header("Location: admin.php?section=about&action=update_success");
    exit;
}

// Delete About Content
if (isset($_GET['delete_about'])) {
    $id = $_GET['delete_about'];
    $db->manageAbout('delete', $id);
    header("Location: admin.php?section=about&action=delete_success");
    exit;
}

// Fetch About Content for Display
$aboutContent = $db->manageAbout('read');
?>
