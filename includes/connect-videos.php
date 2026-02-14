<?php
declare(strict_types=1);

$servername = "vdb1a.pair.com";
$username   = "working_54_r";
$password   = "rUnnER#69";
$dbname     = "working_videos";

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) die("Connection failed: " . mysqli_connect_error());
$db = mysqli_select_db($conn, $dbname);
if (!$db) die("Connection failed: " . mysqli_connect_error());
