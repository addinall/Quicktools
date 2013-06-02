<?php
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		quicktools.php       
//	SYSTEM:		Network monitoring 
//	AUTHOR:		Mark Addinall
//	DATE:		29/04/2007
//	SYNOPSIS:	The index file for the Quicktools suite
//				This file has seen some major re-use over
//				the years.  Apart from the quicktools suite,
//				this file has been part of the Chameleon CMS
//				and several specific applications.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 29/04/2007 | Initial creation Telstra      |  MA
// 12/08/2009 | Complete re-write v2.x own use|  MA
// 18/02/2010 | Re-write CITEC (unfinished)   |  MA
// 12/02/2012 | Re-write v3.x new object model|  MA
// 04/03/2010 | Brand new development of a    |
//            | Perl based AJAX server that   |
//            | provide SNMP and MIBII request|
//            | functionality back to the PHP |
//            | parent system.  The VERY first|
//            | Quicktools used a Perl robot  |
//            | and sucked data back from     |
//            | stdout().  This is neater.    |  MA
//------------+-------------------------------+------------
//
//



// the head file include used to provide all that we find in <HEAD></HEAD>
// including Javascript and DOM manipulations, meta data,
// browser title etc.
//
// As of version 3.x all of this function is encapsulated
// into Objects.  About time.  Only took me seven years.
//
// it sets the DOCTYPE to whatever we deem suitable for this implementation.
//

 
require_once('q2_objects.php');


// main - index
//
// this is the starting template for the rest of the
// screens in the application.  not all look this
// pretty as it is an application, and quite a lot
// of the information on screens are dynamic - built
// from various data sources, the CMS, the asset
// register, returns from operating system pipes, and
// the returns from SNMP traps.  Cute hey?

// NOW, it is important NOT to put visual directives
// into ANY of the PHP/XHTML.  To follow the Zen Garden
// development philosophy, ALL visual control goes into
// the CSS control.  I can't FORCE you to do this, but
// please, please do.....
//
// As of V 3.x I CAN force you to play well with other
// kids.

$page = <<< EOP
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<div class="post-bgtop">
							<div class="post-bgbtm">
								<h1 class="title">$head1</h1>
									<h3 class="title">$head2</h3>
								<div class="entry">
								$cms1 
							</div>
						</div>
					</div>
				</div>
			<div class="post">
				<div class="post-bgtop">
					<div class="post-bgbtm">
						<h1 class="title">$head3</h1>
						<div class="entry">
							$cms2
						</div>
						<h3 class="title">$head4</h3>
						<div class="entry">
							$cms3
						</div>
					</div>
				</div>
			</div>
				<div style="clear: both;">&nbsp;
				</div>
		</div>
		<!-- end content -->
EOP;

// isn't that just lovely to look at?; OK, process the page

print $page ;


// the footer contains the SIDE.
// it probably should not.  I will change this
// a little later on.
 
require_once('q2_footer.php');

?>

