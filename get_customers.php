<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       get_customers.php
//  SYSTEM:     quicktools version 2 
//  AUTHOR:     Mark Addinall
//  DATE:       14th Nov 2010
//  SYNOPSIS:   Load the customers into a stack
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 14/10/2010 | Creation                      |  MA
//------------+-------------------------------+------------
//
//



//-----------------------
function get_customers()
{
    // load all the customers into memory

    global $database ;                          // current live database
    global $customers ;                  

    $sql =<<<EOT

    SELECT * FROM customers 
            ORDER BY name
EOT;


    $handle = $database->execute( $sql ) 
        or die("Execute failure   :" . mysql_error());

    if ( $handle )
    {
        while ( $row = $database->fetch( $handle ) )
        {
            $customer = New Customer() ;
            $customer->populate( $row ) ;
            $customers[] = $customer ;
        }   
    }
    else
    {
    echo "No database handle returned <BR>" ;
    }
}

?>


