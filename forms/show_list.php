<?php
$blockList = file_get_contents("../Palo_Alto/dynamic_blocklist.txt");
echo nl2br($blockList);
?>