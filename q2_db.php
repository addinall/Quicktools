<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:       q2_db.php
//	SYSTEM:    	quicktools version 2 
//	AUTHOR:     Mark Addinall
//	DATE:       27/04/2010
//	SYNOPSIS:   Fire up a database
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 27/04/2010 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//


error_reporting(E_ALL) ;

// contains information that will be used
// to connect to a database system

$database = New Connection( $configuration ) ;

?>

