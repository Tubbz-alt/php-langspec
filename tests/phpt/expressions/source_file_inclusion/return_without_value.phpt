--TEST--
PHP Spec test generated from ./expressions/source_file_inclusion/return_without_value.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// return without a value, so when included, NULL is returned

return;
--EXPECT--
