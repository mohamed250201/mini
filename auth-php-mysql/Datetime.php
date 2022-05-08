<?php
$week_start = new DateTime();
$week_start->setISODate($year,$week_no);
echo $week_start->format('d-M-Y');

?>