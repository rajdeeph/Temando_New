<?php
$date = new DateTime ('now', new DateTimeZone('Australia/Brisbane')); 
echo $date->format('Y-m-d H:i:s'). "\n";

