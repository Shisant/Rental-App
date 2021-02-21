<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
 $db = getDbInstance();

// Delete a property using id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $db->where('id', $del_id);
    $stat = $db->delete('houses');
    if ($stat) {
        $_SESSION['info'] = "Properties deleted successfully!";
        header('location: properties.php');
        exit;
    }
}