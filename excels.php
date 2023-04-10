<?php
session_start();?>
<head><meta charset="utf-8"></head><?php
$output=$_SESSION['output'];
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=bdf_ticket_report.xls");
echo $output;?>