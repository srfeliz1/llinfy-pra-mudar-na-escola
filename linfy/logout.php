<?
require 'db.php';
session_start();
session_destroy();
header("Location: localhost/linfy/front-end/linfy");
?>