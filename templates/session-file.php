<?php
session_start();

if (isset($_SESSION['user'])){
    $userID = $_SESSION['user'];
}