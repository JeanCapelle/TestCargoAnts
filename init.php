<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
// Instead of composer autoloading
function classAutoloader ($pClassName) {
    include(__DIR__ . "/Model/" . $pClassName . ".php");
}

spl_autoload_register("classAutoloader");
session_start();




?>