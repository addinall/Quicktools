<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       admin_build_pulldows.php
//  SYSTEM:     Network monitoring  
//  AUTHOR:     Mark Addinall
//  DATE:       29th Apr 2010
//  SYNOPSIS:   All of the drop down menus in the system
//              are dynamic. This is the build file.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
//29/04/2008  |Initial creation               | MA
//------------+-------------------------------+------------
//
//


//--------------------------------------
function build_machine_options( $mode )
{
    // build a drop down list of special interests
    // mode can be 'ADD' or 'DISPLAY'

    // get access to a global stack of objects

    
    global $machines ;

    // reset the variable spave where we are going 
    // to build the menu choice structure
    
    $pull_down = '<option value = "">MACHINES</option>' ;

    // dope how namy objects in the array
    
    $size = count( $machines ) ;
    // and process each one
    
    for (   $counter = 0 ;
        $counter < $size ;
            $counter++ )
    {
        if ( $machines[ $counter ]->active )
        // no sense offering de-activated options
        {
            $pull_down = $pull_down . '<option value = "'
                . $machines[ $counter ]->short_name 
                . '">'
                . $machines[ $counter ]->name 
                . '</option>' ;


        } // if
    } // for

    $pull_down = $pull_down . '<option value = "Mark Addinall">Mark Addinall</option>' ;

    return $pull_down ;

} // function


?>


