#!/usr/bin/env php
<?php
echo $_SERVER['SCRIPT_FILENAME'] . "\n";
echo dirname($_SERVER['SCRIPT_FILENAME']) . "\n\n";
echo  __FILE__  . "\n";
echo dirname(__FILE__) . "\n\n";
echo dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "\n";