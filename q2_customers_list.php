<?php
//
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:       q2_customer_list
//	SYSTEM:     Network monitoring	
//	AUTHOR:     Mark Addinall
//	DATE:       29/10/2010
//	SYNOPSIS:   The customers page - Create/edit/delete
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 29/10/2010 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//


require_once('q2_header.php');				// DOCTYPE, <HEAD></HEAD>, menu etc.
require_once('q2_config.php') ;				// our environment information
require_once('q2_objects.php') ;			// application objects
require_once('q2_db.php') ;					// base level database connect
require_once('get_customers.php') ;			// re-load customers
require_once('q2_cms.php');					// presentation data


//-------------------------
function list_customers() {

// this function accesses a global stack of customers in memory
// cycles through this stack and builds a list of customers to be
// presented in a phpMyAdmin type of BROWSE/EDIT/DELETE type
// of list for processing.

    // get access to a global stack of customers 
	// loaded by get_customers

    global $customers;


	// set the XHTML to empty
	$customer_list = '' ;

    // dope the number of stack items
    $size = count( $customers ) ;


    // list all the customers available

    for ( $counter = 0 ; $counter < $size; $counter++ ) {
        // this line changes the class, and therefore the colour
        // of alternate lines.  The mod() function works as well,
        // but the bitwise and is much, much faster

        $class = ( $counter & 1 ) ? 'oddfield' : 'evenfield' ;

        // we test to see if this is the last item.  The
        // last field has it's own class.  It has a completed
        // box described in the css file.  Use two colours
        // as the normal lists
        
        if ( $counter == ( $size - 1 ) ) {   
        	$class = ( $counter & 1 ) ? 'oddlastfield' : 'lastfield' ;
        }

        // output the require css

        $customer_list = $customer_list . "	<div class=$class> <div class=listtext>" ;

        // and the customer name

        $customer_list = $customer_list . $customers[ $counter ]->name ;

        // set up the rest of the HTML to accompany this
        // property entry.  Icons for various functions
        // to act upon the chosen object

        $rest_of_list =<<<EOT
			<div class="iconsright">
                <a href="qt_machines_list.php?mode=PARTIAL&short_name={$customers[$counter]->short_name}">
                <img src="images/admin_icon_review.png" title="Managed Machines"/></a>
                <a href="qt_networks_list.php?mode=PARTIAL&short_name={$customers[$counter]->short_name}">
                <img src="images/admin_icon_review.png" title="Managed Networks"/></a>
                <a href="admin_customer_edit.php?short_name={$customers[ $counter ]->short_name}&mode=EDIT">
                <img src="images/admin_icon_edit.png" title="edit" /></a>
				<a onclick="return confirm('Are you sure you wish to DELETE this item?')"
					href="admin_db_customer.php?short_name={$customers[ $counter ]->short_name}&mode=DELETE">
				<img src="images/admin_icon_delete.png" title="delete" /></a>			
			</div>
EOT;

        $customer_list = $customer_list . $rest_of_list;
    } // for

	if ($customer_list == '') {
		$customer_list = '<h2 class="title">No entries in Database</h2>';
	}

	return $customer_list;

} // list customers 




// -------------- main() ------------
//
// Connect to the database given the
// information stored in the configuration
// array

$database = New Connection($configuration) 
	or die( "Database connection failure    :" . mysql_error()) ;

// load the customers stack

get_customers() ;

// release RDBMS resource

$database->close() ;

// now build the screen

$customer_list = list_customers();

$page = <<< EOP
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<div class="post-bgtop">
					<div class="post-bgbtm">
						<h1 class="title">$customer_list_title</h1>
						<div class="entry">
							$customer_button_form 
						</div>
						<div class="entry">
							$customer_list
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
