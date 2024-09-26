<?php
session_start();
if (isset($_SESSION['usr_id'])) {
    session_destroy();
    header('location: ../../landing/index.php');
    exit();
}
