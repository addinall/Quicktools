<?php
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		admin_build_checkboxes.php
//	SYSTEM:	 	Network monitoring	
//	AUTHOR:		Mark Addinall
//	DATE:		29th Apr 2010
//	SYNOPSIS:	All of the check box menus in the system
//				are dynamic. This is the build file.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
//29/04/2008  |Initial creation               | MA
//------------+-------------------------------+------------
//
//

// some arrays to store the current
// values of the stored checkboxes
// in the case of and EDIT mode

$current_machine		= array() ;
$current_custermer		= array() ;



//------------------------------------
function build_current_arrays( $whom )
{

	// Creating these check boxes an happen in
	// one of two modes, add or edit.  Adding is
	// pretty easy as we have all blnk checkboxes.
	// Edit mode is less easy.  The current owner object
	// will already have selected some 'links'.
	// As the many_to_many file is deleted (the owners)
	// selected links have to be maintained.  As the
	// number of links available will probably have changed,
	// we need to load the new array of available links and merge
	// the selected links into it.


global 		$current_machine,
			$current_customer  ;

global	$configuration ;

	// wake up the database

	$database = New Connection( $configuration ) ;

	// the object kills the process, so if we are here,
	// we have connected OK

	// get an instance of a Linker

	$current_link = New Link() ;

	// start ripping through the lookup table and populate the
	// currently selected checkbox arrays


	$current_product 		= $current_link->build_list( 'product', 	$whom ) ;
	$current_category  		= $current_link->build_list( 'category', 	$whom ) ;



}


//--------------------------------------
function build_product_checkbox( $mode )
{
	// mode can be 'ADD' or 'EDIT'

	// get access to a global stack of objects
	
	global $products,
	   	   $current_product ;

	// reset the variable spave where we are going 
	// to build the menu choice structure
	
	$check_box = '' ;

	// dope how many objects in the arrays

	$existing_checkbox	=	count( $current_products ) ;	
	$size 				= 	count( $products ) ;
	
	// and process each one
	
	for ( 	$counter = 0 ;
			$counter < $size ;
			$counter++ )
	{
		if ( $products[ $counter ]->active       )

			 // no sense offering de-activated options
			 // The properties are all stored in the one
			 // giant stack.  This is so the EDIT functions
			 // can list the lot as as list.  However, the
			 // check boxes have ended up being seperated
			 // into elite properties, private properties
			 // and general scumbag properties.  This was based on
			 // screen real estate issues.
		{
			$checked = '' ;

			$check_box = $check_box  
				. '<input type = "checkbox" name = "product_checkbox[]" value = "'
				. $products[ $counter ]->object_name .'"' ;
			if ( ( $mode == 'EDIT' ) && ( $existing_checkbox > 0 ) )
			{
				for ( $count = 0; $count < $existing_checkbox; $count++ )
				{	
					if ( $current_product[ $count ] ==
						$products[ $counter ]->object_name )
					{
						$checked = '   CHECKED  ' ;
					}
				}
			}
			$check_box 	.=  $checked . '>'  
						. $products[ $counter ]->object_name 
						. '<BR>' ;

		} // if
	} // for

	return $check_box ;

} // function

//--------------------------------------
function build_category_checkbox( $mode )
{
	// mode can be 'ADD' or 'EDIT'

	// get access to a global stack of objects
	
	global $categories,
	   	   $current_category ;

	// reset the variable where we are going 
	// to build the menu choice structure
	
	$check_box = '' ;
	return 0 ;

	// dope how many objects in the arrays

	$existing_checkbox	=	count( $current_category ) ;	
	$size 				= 	count( $categories ) ;
	
	// and process each one
	
	for ( 	$counter = 0 ;
			$counter < $size ;
			$counter++ )
	{
		if ( $categories[ $counter ]->active )
	 	// no sense offering de-activated options
		{
			$checked = '' ;

			$check_box = $check_box  
				. '<input type = "checkbox" name = "category_checkbox[]" value = "'
				. $categories[ $counter ]->object_name . '"' ;
			if ( ( $mode == 'EDIT' ) && ( $existing_checkbox > 0 ) )
			{
				for ( $count = 0; $count < $existing_checkbox; $count++ )
				{	
					if ( $current_category[ $count ] ==
						$categories[ $counter ]->object_name )
					{
						$checked = '   CHECKED  ' ;
					}
				}
			}
			$check_box 	.= '"    ' .$checked . '>'  
						. $categories[ $counter ]->object_name 
						. '<BR>' ;

		} // if
	} // for

	return $check_box ;

} // function



//--------------------------------------
function build_staff_checkbox( $mode )
{
	// build a check box list of staff
	// mode can be 'ADD' or 'EDIT'

	// get access to a global stack of objects
	
	global 	$staffs,
	   		$current_staff	;

	// reset the variable spave where we are going 
	// to build the menu choice structure
	
	$check_box = '' ;

	// dope how many objects in the array
	
	$size = count( $staffs ) ;


	$existing_checkbox	=	count( $current_staff ) ;	


	// and process each one
	
	for ( 	$counter = 0 ;
			$counter < $size ;
			$counter++ )
	{
		if ( $staffs[ $counter ]->active )
		// no sense offering de-activated options
		{

			$checked = '' ;

			$check_box = $check_box  
				. '<input type = "checkbox" name = "staff_checkbox[]" value = "'
				. $staffs[ $counter ]->object_name . '"' ;
			if ( ( $mode == 'EDIT' ) && ( $existing_checkbox > 0 ) )
			{
				for ( $count = 0; $count < $existing_checkbox; $count++ )
				{	
					if ( $current_staff[ $count ] ==
						$staffs[ $counter ]->object_name )
					{
						$checked = '   CHECKED  ' ;
					}
				}
			}
			$check_box 	.= $checked  
						. '>' . $staffs[ $counter ]->object_name 
						. '<BR>' ;
			// Mark Addinall<input type = "checkbox" name = "interest"
			//                 value = "Mark Addinall"><BR>

		} // if
	} // for

	return $check_box ;

} // function



?>


