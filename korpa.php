<?php
include_once 'init.inc.php';
include('header.inc.php');

if(is_unactivated() || is_blocked()) header ('Location: index.php');

if(admin_in()) header ('Location: administracija.php'); //na primer :)

include('korpa.inc.php');
include('footer.inc.php');






?>
