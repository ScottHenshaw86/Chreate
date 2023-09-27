<?php

require_once "./controller/controller.php";

try {

    $action = $_GET['action'] ?? "";
    switch ($action) {
        
        default:
            showHomePage();
            break;
    }
} catch (Exception $e) {
    showErrorPage($e);
}
