<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		q2_customer_edit.php
//	SYSTEM:	 	Network monitoring	
//	DATE:		30 Nov 2010	
//	SYNOPSIS:	Data collection form for the purpose of
//				editing or adding a customer entry into the
//				asset management system database.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 30/11/2010 | Created                       |   MA
//------------+-------------------------------+------------
//
//
//


require_once('q2_header.php');				// DOCTYPE, <HEAD></HEAD>, menu etc.
require_once('q2_config.php') ;				// our environment information
require_once('q2_objects.php') ;			// application objects
require_once('q2_db.php') ;					// base level database connect

// the options with in pulldown are all dynamic

// require_once('q2_build_pulldowns.php') ;


// as are all of the select boxes

// require_once('q2_build_checkboxes.php') ;

// now build all of our dynamic strings for the
// form input.  This might look like a sad
// way to go about it, but the add many to many
// provisos create a need to do it this way.

// now get our subject

$short_name = $_REQUEST['short_name'];
$mode = $_REQUEST['mode'] ;

if ( $mode != 'ADD' )
{
	$sql = "SELECT * from customers where short_name = '$short_name'";

	// this will return one only as they are unique

	$handle = $database->execute( $sql ) ;

	// object will probably have killed us already, but.....
	//
	if (! $handle)
	{
		die('could not execute   :   ' . $sql . mysql_error()) ;

	}


	// fetch the sucker

	$row = $database->fetch($handle) ;

	// create a new object
	
	$customer = New Customer() ;

	// self populate from the database

	$customer->populate($row);

	$name = $customer->name ;

	// get the current status of the check boxes
	// into memory for THIS object.

}


// now build all of our dynamic strings for the
// form input.  This might look like a sad
// way to go about it, but the edit many to many
// provisos create a need to do it this way.

// $machine_options 	= build_machine_options('ADD') ;

// Now we get a little tricky.
// The requirement in this system
// was to allow ANYTHING to have an interest database association
// with ANYTHING else at all.  One to one.  One to many.  Balanced
// many to many, an unbalanced many to many.  This nearly
// unbalanced me!  ;-)
// Checkboxes return nothing (neither a name nor a value) if unchecked. 
// If checked, a checkbox returns the content of the value attribute if 
// one is present. A checkbox with no value attribute returns the value 
// "on" if checked. If a checkbox is not checked, the corresponding 
// element of $_POST or $_GET will not be defined. Assigning an undefined 
// array element to a variable creates a variable with the type and value NULL.
//
// To accomplish this feat of computational dexterity, we created a many to
// many associative link by creating a lookup table as so:
//
//		id				(just an integer, not important)
//		major_category	(the major category being examined,
//					 	in this case, Special Interests)
//		minor_category	(which one of the Special Interests?
//						ie.   Special Interests[ Wildlife ]



$active_on		= '' ;
$active_off		= '' ;


if ( $customer->active == 1 ) {
	$active_on = 'checked' ;
}
else {
	$active_off = 'checked' ;
}


      //<fieldset class="inlineLabels">
	  // after Customer information

	  // before button holder
      // </fieldset>
require_once('q2_cms.php');					// presentation data

$page = <<< EOP
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<div class="post-bgtop">
					<div class="post-bgbtm">
						<h1 class="title">$head6</h1>
						<div class="entry">
							$customer_input_form 
						</div>
					</div>
				</div>
			</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end content -->
EOP;

print $page ;


// the footer contains the SIDE.
// it probably should not.  I will change this
// a little later on.
 
require_once('q2_footer.php');

?>


?>

