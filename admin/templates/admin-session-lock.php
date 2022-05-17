<?php
session_start();

if (isset($_SESSION['admin'])){
    $adminID = $_SESSION['admin'];
}else{
    header("Location: login");
    exit;
}