<?php
session_start();

require 'config.php';
require 'class.db.php';
require 'functions.php';
$arrCustomerType = getCustomerType($strRootP);
