<?php
require_once('vendor/autoload.php');
require_once(__DIR__ . '/vendor/codeigniter4/codeigniter4/system/Test/bootstrap.php');

use ci4lang\Ci4lang;

$ci4lang = new Ci4lang\Ci4langClass('ko'); // ko change
echo $ci4lang->check();
