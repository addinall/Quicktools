<?php
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		load_database.php
//	SYSTEM:		Network monitoring	
//	AUTHOR:		Mark Addinall
//	DATE:		20 Mar 2010
//	SYNOPSIS:   Loads the database into memory for the
//	            'add' functions.  As everything is linked
//	            to everthing else, storing the small database
//	            in memory should be OK.  This may be used
//	            in the edit routines and in the front end 
//              later on.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 15/04/2008 |initial creation               | MA
//------------+-------------------------------+------------
//
// :set tabstop=4 for readability


// get the classes into memory


// now, programs to suck up the database
//


require('get_machines.php') ;
require('get_customers.php') ;


//--------------main -----------------------

	// open a pipe



	$database = New Connection( $configuration ) ;


	// that was pretty heh?  :-)


	// SUCK!

	get_machines() ;
	get_customers() ;

	$database->close() ;


?>

