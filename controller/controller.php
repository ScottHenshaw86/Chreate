<?php
require_once "./model/model.php";

function showErrorPage($e) {
    include "./view/errorPage.php";
}

function showHomePage() {
    include "./view/indexView.php";
}