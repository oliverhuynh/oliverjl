<?php

define( '_JEXEC', 1 );

define('JPATH_BASE', realpath(dirname(__FILE__) . '/../../../../') );
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

$mainframe = JFactory::getApplication('site');
$mainframe->initialise();

$out = array(
  'token' => JSession::getFormToken(),
);

header('Content-Type: application/json');
print json_encode($out);
