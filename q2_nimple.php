<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:	    q2_nimple.php       
//	SYSTEM:     Network monitoring 
//	AUTHOR:     Mark Addinall
//	DATE:       29/10/2010
//	SYNOPSIS:
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 29/04/2010 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//



// the head file include all that we find in <HEAD></HEAD>
// including Javascript and DOM manipulations, meta data,
// browser title etc.
//
// it sets the DOCTYPE to whatever we deem suitable for this implementation.
//
// It also include the Logo SPLASH and the menu.  Perhaps
// it should not.

 
require_once('q2_header.php');


// OK.  This CMS is actually driven by the CMS.  As my guitar
// teacher sez, "I hope that makes sense"
// This allows the owner (or implementer) of this system
// to change the welcome information AS WELL as the Zen
// look and feel.

require_once('q2_cms.php');


// nimple
// the function you have chosen has not been
// implemented YET....


$page = <<< EOP
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<div class="post-bgtop">
							<div class="post-bgbtm">
								<h1 class="title">$head5</h1>
								<div class="entry">
									$nimple 
								</div>
							</div>
						</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
			</div>
		<!-- end content -->
EOP;

print $page ;

require_once('q2_footer.php');

?>

