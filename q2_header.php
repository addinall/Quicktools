<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:	    q2_header.php
//	SYSTEM:     Quicktools 2 
//	AUTHOR:     Network monitoring 
//	DATE:       21/10/2010
//	SYNOPSIS:   This file is included in any part of the application that
//	            requires a visual output.  I fires up the database by
//	            default as every application that displays uses
//	            SOMETHING from the database.  I could have built
//	            more granularity into the load, but for the sake
//	            of keeping the applications (and the template)
//	            simple, it sucks most of it in here.  The CMS uses
//	            exactly the same file (and routine) as does the
//	            front side web pages.  Cuts down on code complexity.
//	            As an aside, I had another go at MVC models this week.
//	            This time I tried Cake and RoR.  I don't understand
//	            how they can be considered RAPID, structured or
//	            Object Oriented.  They are still a mess, so back
//	            to my libraries.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
//21/10/2010  | Initial coding                |  MA
//------------+-------------------------------+------------
//
//




$head = <<< EOH
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>QuickTools version Two</title>

<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/uni-form.css" media="all" rel="stylesheet"/> 
<link href="css/default.uni-form.css" media="all" rel="stylesheet"/>
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="js/uni-form.jquery.js" type="text/javascript"></script> 

</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo">
            <h1>Quicktools</h1>
            <p> by addinall  - That's IT QLD</p>
        </div>
    </div>
    <!-- end #header -->
    <div id="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="q2_nimple.php">Blog</a></li>
            <li><a href="q2_nimple.php">Links</a></li>
            <li><a href="q2_nimple.php">Contact</a></li>
        </ul>
    </div>
    <!-- end #menu -->
EOH;

print $head ;

?>




