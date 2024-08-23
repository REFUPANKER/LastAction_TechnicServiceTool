<?php
if (session_status()==PHP_SESSION_NONE) {
    header("location:./?p=".basename($_SERVER["SCRIPT_FILENAME"],".php"));
    exit;
}