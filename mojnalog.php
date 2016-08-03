<?php
include_once('init.inc.php');
include('header.inc.php');

if((!logged_in() && !admin_in())|| is_unactivated() || is_blocked()) header ('Location: index.php');

include('mojnalog.inc.php');
include('footer.inc.php');
?>








