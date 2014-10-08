--TEST--
PHP Spec test generated from ./arrays/arrays.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

echo "================= array of zero elements is possible =================\n";

$v = array();
var_dump($v);
$v = [];
var_dump($v);

echo "================= array of 1 element is possible =================\n";

$v = array(TRUE);
var_dump($v);
$v = [TRUE];
var_dump($v);
$v = array(0 => TRUE);	// specify explicit key
var_dump($v);
$v = [0 => TRUE];
var_dump($v);

echo "================= array of 2 elements each having the same type =================\n";

$v = array(123, -56);
var_dump($v);
$v = [123, -56];
var_dump($v);
$v = array(0 => 123, 1 => -56);	// specify explicit keys
var_dump($v);
$v = [0 => 123, 1 => -56];
var_dump($v);

$pos = 1;
$v = array(0 => 123, $pos => -56);	// specify explicit keys
var_dump($v);
$v = [0 => 123, $pos => -56];		// key can be a variable
var_dump($v);

$i = 10;
$v = array(0 => 123, $pos => -56);	// specify explicit keys
var_dump($v);
$v = [$i - 10 => 123, $i - 9 => -56];	// key can be a runtime expression
var_dump($v);

echo "================= array of 5 elements each having different type =================\n";

$v = array(NULL, FALSE, 123, 34e12, "Hello");
var_dump($v);
$v = [NULL, FALSE, 123, 34e12, "Hello"];
var_dump($v);
$v = array(0 => NULL, 1 => FALSE, 2 => 123, 3 => 34e12, 4 => "Hello");
var_dump($v);
$v = [0 => NULL, 1 => FALSE, 2 => 123, 3 => 34e12, 4 => "Hello"];
var_dump($v);
$v = array(NULL, 1 => FALSE, 123, 3 => 34e12, "Hello");	// some keys default, others not
var_dump($v);
$v = [NULL, 1 => FALSE, 123, 3 => 34e12, "Hello"];
var_dump($v);

echo "================= trailing comma permitted if list has at least one entry =================\n";

// $v = array(,);	// error
// $v = [,];		// error

$v = array(TRUE,);
var_dump($v);
$v = [TRUE,];
var_dump($v);
$v = array(0 => TRUE,);
var_dump($v);
$v = [0 => TRUE,];
var_dump($v);

$v = array(123, -56,);
var_dump($v);
$v = [123, -56,];
var_dump($v);
$v = array(0 => 123, 1 => -56,);
var_dump($v);
$v = [0 => 123, 1 => -56,];
var_dump($v);

echo "================= specify keys in arbitrary order, initial values of runtime expressions, leave gaps =================\n";

$i = 6;
$j = 12;
$v = array(7 => 123, 3 => $i, 6 => ++$j);
var_dump($v);

$i = 6;
$j = 12;
$v = [7 => 123, 3 => $i, 6 => ++$j];
var_dump($v);

foreach($v as $e)	// only has 3 elements ([3], [6], and [7]), not 8 ([0]-[7])
{
	echo $e.' ';
}
echo "\n";

echo "\$v[1] is >".$v[1]."<\n"; var_dump($v1[1]); // access non-existant element
echo "\$v[4] is >".$v[4]."<\n"; var_dump($v1[4]); // access non-existant element

$v[1] = TRUE;		// increases array to 4 elements
$v[4] = 99;			// increases array to 5 elements
var_dump($v);
foreach($v as $e)		// now has 5 elements
{
	echo $e.' ';
}
echo "\n";

echo "================= duplicate keys allowed, but lexically final one used =================\n";

$v = array(2 => 23, 1 => 10, 2 => 46, 1.9 => 6);	// key 1.9 is truncated to key 1
var_dump($v);

echo "================= string keys can be expressions too =================\n";

$s1 = "color";
$s2 = "shape";
$v = array($s1 => "red", $s2 => "square");
var_dump($v);

echo "================= can mix int and string keys =================\n";

// "4" as key is taken as key 4
// 9.2 as key is truncated to key 9
// "12.8" as key is treated as key with that string, NOT truncated and made int 12
// NULL as key becomes key ""

$v = array("red" => 10, "4" => 3, 9.2 => 5, "12.8" => 111, NULL => 1);
var_dump($v);

$v = array(FALSE => -4);	// FALSE as key becomes key 0
var_dump($v);
$v = array("" => -3);
var_dump($v);
$v = array(INF => 21);	// INF as key becomes key 0/IntMin/0 (imp-def?)
var_dump($v);
$v = array(-INF => -1);	// -INF as key becomes key 0/IntMin/IntMin (imp-def?)
var_dump($v);
$v = array(NAN => 123);	// NAN as key becomes key of IntMin/IntMin/IntMin (imp-def?)
var_dump($v);

echo "================= arrays some of whose elements are arrays, and so on =================\n";

$c = array("red", "white", "blue");
$v = array(10, $c, NULL, array(FALSE, NULL, $c));
var_dump($v);

$v = [[2,4,6,8], [5,10], [100,200,300]];
var_dump($v);

echo "================= see if int keys can be specified in any base. =================\n";

$v = [12 => 10, 0x10 => 16, 010 => 8, 0b11 => 2];
var_dump($v);

echo "================= what about int-looking strings? It appears not. =================\n";

$v = ["12" => 10, "0x10" => 16, "010" => 8, "0b11" => 2];
var_dump($v);

echo "================= iterate using foreach and compare with for loop =================\n";

$v = array(2 => TRUE, 0 => 123, 1 => 34.5, -1 => "red");
var_dump($v);
foreach($v as $e)
{
	echo $e.' ';
}
echo "\n";
for ($i = -1; $i <= 2; ++$i)
{
	echo $v[$i].' ';
}
echo "\n";

echo "================= remove some elements from an array =================\n";

$v = array("red" => TRUE, 123, 9 => 34e12, "Hello");
var_dump($v);
unset($v[0], $v["red"]);
var_dump($v);
--EXPECTF--
================= array of zero elements is possible =================
array(0) {
}
array(0) {
}
================= array of 1 element is possible =================
array(1) {
  [0]=>
  bool(true)
}
array(1) {
  [0]=>
  bool(true)
}
array(1) {
  [0]=>
  bool(true)
}
array(1) {
  [0]=>
  bool(true)
}
================= array of 2 elements each having the same type =================
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
================= array of 5 elements each having different type =================
array(5) {
  [0]=>
  NULL
  [1]=>
  bool(false)
  [2]=>
  int(123)
  [3]=>
  float(34000000000000)
  [4]=>
  string(5) "Hello"
}
array(5) {
  [0]=>
  NULL
  [1]=>
  bool(false)
  [2]=>
  int(123)
  [3]=>
  float(34000000000000)
  [4]=>
  string(5) "Hello"
}
array(5) {
  [0]=>
  NULL
  [1]=>
  bool(false)
  [2]=>
  int(123)
  [3]=>
  float(34000000000000)
  [4]=>
  string(5) "Hello"
}
array(5) {
  [0]=>
  NULL
  [1]=>
  bool(false)
  [2]=>
  int(123)
  [3]=>
  float(34000000000000)
  [4]=>
  string(5) "Hello"
}
array(5) {
  [0]=>
  NULL
  [1]=>
  bool(false)
  [2]=>
  int(123)
  [3]=>
  float(34000000000000)
  [4]=>
  string(5) "Hello"
}
array(5) {
  [0]=>
  NULL
  [1]=>
  bool(false)
  [2]=>
  int(123)
  [3]=>
  float(34000000000000)
  [4]=>
  string(5) "Hello"
}
================= trailing comma permitted if list has at least one entry =================
array(1) {
  [0]=>
  bool(true)
}
array(1) {
  [0]=>
  bool(true)
}
array(1) {
  [0]=>
  bool(true)
}
array(1) {
  [0]=>
  bool(true)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(-56)
}
================= specify keys in arbitrary order, initial values of runtime expressions, leave gaps =================
array(3) {
  [7]=>
  int(123)
  [3]=>
  int(6)
  [6]=>
  int(13)
}
array(3) {
  [7]=>
  int(123)
  [3]=>
  int(6)
  [6]=>
  int(13)
}
123 6 13 

Notice: Undefined %s: 1 in %s/arrays/arrays.php on line 108
$v[1] is ><

Notice: Undefined variable: v1 in %s/arrays/arrays.php on line 108
NULL

Notice: Undefined %s: 4 in %s/arrays/arrays.php on line 109
$v[4] is ><

Notice: Undefined variable: v1 in %s/arrays/arrays.php on line 109
NULL
array(5) {
  [7]=>
  int(123)
  [3]=>
  int(6)
  [6]=>
  int(13)
  [1]=>
  bool(true)
  [4]=>
  int(99)
}
123 6 13 1 99 
================= duplicate keys allowed, but lexically final one used =================
array(2) {
  [2]=>
  int(46)
  [1]=>
  int(6)
}
================= string keys can be expressions too =================
array(2) {
  ["color"]=>
  string(3) "red"
  ["shape"]=>
  string(6) "square"
}
================= can mix int and string keys =================
array(5) {
  ["red"]=>
  int(10)
  [4]=>
  int(3)
  [9]=>
  int(5)
  ["12.8"]=>
  int(111)
  [""]=>
  int(1)
}
array(1) {
  [0]=>
  int(-4)
}
array(1) {
  [""]=>
  int(-3)
}
array(1) {
  [%i]=>
  int(21)
}
array(1) {
  [-9223372036854775808]=>
  int(-1)
}
array(1) {
  [-9223372036854775808]=>
  int(123)
}
================= arrays some of whose elements are arrays, and so on =================
array(4) {
  [0]=>
  int(10)
  [1]=>
  array(3) {
    [0]=>
    string(3) "red"
    [1]=>
    string(5) "white"
    [2]=>
    string(4) "blue"
  }
  [2]=>
  NULL
  [3]=>
  array(3) {
    [0]=>
    bool(false)
    [1]=>
    NULL
    [2]=>
    array(3) {
      [0]=>
      string(3) "red"
      [1]=>
      string(5) "white"
      [2]=>
      string(4) "blue"
    }
  }
}
array(3) {
  [0]=>
  array(4) {
    [0]=>
    int(2)
    [1]=>
    int(4)
    [2]=>
    int(6)
    [3]=>
    int(8)
  }
  [1]=>
  array(2) {
    [0]=>
    int(5)
    [1]=>
    int(10)
  }
  [2]=>
  array(3) {
    [0]=>
    int(100)
    [1]=>
    int(200)
    [2]=>
    int(300)
  }
}
================= see if int keys can be specified in any base. =================
array(4) {
  [12]=>
  int(10)
  [16]=>
  int(16)
  [8]=>
  int(8)
  [3]=>
  int(2)
}
================= what about int-looking strings? It appears not. =================
array(4) {
  [12]=>
  int(10)
  ["0x10"]=>
  int(16)
  ["010"]=>
  int(8)
  ["0b11"]=>
  int(2)
}
================= iterate using foreach and compare with for loop =================
array(4) {
  [2]=>
  bool(true)
  [0]=>
  int(123)
  [1]=>
  float(34.5)
  [-1]=>
  string(3) "red"
}
1 123 34.5 red 
red 123 34.5 1 
================= remove some elements from an array =================
array(4) {
  ["red"]=>
  bool(true)
  [0]=>
  int(123)
  [9]=>
  float(34000000000000)
  [10]=>
  string(5) "Hello"
}
array(2) {
  [9]=>
  float(34000000000000)
  [10]=>
  string(5) "Hello"
}
