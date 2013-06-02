<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:	    q2_cms.php       
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


// this is a mockup at the moment.  These strings are going to come out of a database.  The CMS is actually driven by the CMS itself.
// spooky hey?

$cms1  = '<p>Quicktools was first written by Mark Addinall sometime in 1996 for Telstra Managed Network Solutions.  That code and this application share no source, nor data, the look and feel is completely different, as is the database and applications on offer!  However, it shares a name and a philosophy.  QuickTools as the suite comprises a collection of machine and network monitoring and management tools, and hopefully, it makes routine tasks over many machines quick.  It was, and still is meant to be HPOpenview sans steroids.  Mark is the sole author at the moment, but thinking of rolling some or all of this into <a href="http://www.ispconfig.org">ISPConfig3</a> in the near future.  This system has an asset register at its base comprising of datacenters, datarooms, networks, machines and customers.  The asset register is created and maintained from within this suite.  The code doing this is actually derived from Chameleon V3, the CMS designed and implemented by Mark.  Reports can be ad-hoc or use a cron-like schedule.  Read the documentation and follow the tutorial by all means!  Took long enough to write, so someone should make use of the work!  However, quickly, Datarooms have customers and networks.  Customers own machines.  This suite has been built from the perspective of a datacenter owner/medium - large ISP/RSP.  Standard reporting functions and SNMP routines are implemented in this release.  TODO (if anyone is interested in helping) is the integration of AAA through RADIUS.  Have fun! </p> ' ;



$cms2 = '<p>It seems that nearly everywhere I work on contract, people ask me to write one of these things.  Sooooo, I figured I would write a generic one, and release it under the <a href="http://www.gnu.org/licenses/gpl.html">GNU License</a> in the open source arena.  Now people can grab it, and implement it for themselves!  I am always happy to help of course, and will maintain a source collection of the various implementations, probably under <a href="http://subversion.apache.org">Subversion</a> tree.</p>' ;


$cms3 = '<p>This software has been design using OOD and implented with the use of OOP.  Some things do not convert well into an OOP paradigm, like most of the UNIX command line options ;-), however by placing a level of abstration and automation over some of the processes, we can present an informative amount of information in an understandable manner to those with perhaps a different skill set than a traditional UNIX systems administators.  There is a tendency for designers of technical administration applications to build in more complexity than is required.  We will try to avoid that in this suite.</p> <p> As the rest of Mark\'s Web applications, CMS, CRMs etc, Quicktools look and feel is completeley driven by CSS following the philosophy learnt from <a href="http://www.csszengarden.com">CSS Zen Garden</a>, so if you do not like the look and feel, grab a CSS guru and change it!  </p>' ;

$nimple = '<p>The application, function or report you have requested has not been implemented yet.  Please be patient, or grab a copy of gVim and write it yourself!</p><p>If you require an ETA on the function then <a href="q2_contact.php">Contact the Administrator</a> for an update.  Thank you.</p>';


$message_list = "A hacker on a roll may be able to produce–in a period of a few months–something that a small development group (say, 7-8 people) would have a hard time getting together over a year.  IBM used to report that certain programmers might be as much as 100 times as productive as other workers, or more.<br>
(Peter Seebach) 
 <br>
The best programmers are not marginally better than merely good ones.  They are an order-of-magnitude better, measured by whatever standard: conceptual creativity, speed, ingenuity of design, or problem-solving ability.<br>
(Randall E. Stross)
<br>
PHP is a minor evil perpetrated and created by incompetent amateurs, whereas Perl is a great and insidious evil perpetrated by skilled but perverted professionals.<br>
(John Ribbens)
<br>
A computer lets you make more mistakes faster than any invention in human history–with the possible exceptions of handguns and tequila.<br>
(Mitch Radcliffe) <br>";


$blog_entry = "<br>This text represents the LATEST BLOG entry posted into the BLOG by any contributer.  The HREF link just above the text will take the interface user to the BLOG application to read in full, or post a reply, or post a new entry.";


$head1 = 'Welcome to Quicktools';
$head2 = 'This is Quicktools Utility Bench';
$head3 = 'Why develop?';
$head4 = 'Design Considerations.';
$head5 = 'Quicktools - Not Implemented';
$head6 = 'Quicktools - ADD/EDIT Customers';

$customer_input_form = '
    <form action="#" class="uniForm">
        
        <h3>Customer Information</h3>
        
        <div class="ctrlHolder">
          <label for="name">Customer name</label>
          <input name="name" id="name" value="Mark Addinall" size="50" maxlength="128" type="text" class="textInput large"/>
          <p class="formHint">Name in regular English. Maximum 128 characters.  Can be empty (not recommended).  The name acts as one of the indices into the database.  In the past, some customers have wanted to fill this in later, and do a speed data entry only using the short_name data field.</p>
        </div>
        
        <div class="ctrlHolder">
          <label for="short_name">Short name</label>
          <input name="short_name" id="short_name" value="addinall" size="50" maxlength="128" type="text" class="textInput large"/>
          <p class="formHint">Computer friendly name.  Underscores, no spaces. Maximum 64 characters.  Can NOT be empty.  This data field acts as one of the primary indices of the database.  It must be valid.  No spaces or punctuation.  And this value MUST be UNIQUE to this customer.</p>
        </div>
        
        
        <div class="ctrlHolder">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="auto" rows="5" cols="40"></textarea>
          <p class="formHint">Customer description.  This is the description generally displayed on screens that produce reports and listings within the asset system via the content management system.  You can enter any free form data you like.  You can enter XHTML if you want, and that can include links.  But remember, a LOT of information here may make some of your report screens look rather chunky.</p>
        </div>
        
        <div class="ctrlHolder">
          <label for="information">Information</label>
          <textarea name="information" id="information" class="auto" rows="5" cols="40"></textarea>
          <p class="formHint">Additional information.  Here is a place where you can store reams of data about a customer.  It is generally not displayed in the asset management system unless you define a custom report to do so.  It will show up in your SQL window, and it is available for sophisticated searches.</p>
        </div>
        
        
        <div class="ctrlHolder">
          <label for="tags">Cloud Tags</label>
          <textarea name="tags" id="tags" class="auto" rows="5" cols="40"></textarea>
          <p class="formHint">Any format, XML, JSON, spaced, comma, or XHTML etc.  It is not going to generate a tag cloud per object, but can do so per table, per datacenter, percustomer and per network.  This meta-data is also included along with the object when dynamic web pages are produced.  This enables web spiders to pick up on your meta-data increasing SEO (if required of course).</p>
        </div>
        

        <div class="ctrlHolder">
          <p class="label">
             Asset system associations
          </p>
          <ul class="alternate">
            <li><label for="">Datacenter <select id="" name="Datacenter"><option value="Brisbane">Brisbane</option></select></label></li>
            <li><label for="">Dataroom <select id="" name="Dataroom"><option value="L2 Creek">L2 Creek</option></select></label></li>
            <li><label for="">Primary Network <select id="" name="Network"><option value="192.168.1.1 NAT">192.168.1.1 NAT</option></select></label></li>
          </ul>
          <p class="formHint">Select customer associations.</p>
        </div>
        
        
        <div class="ctrlHolder">
          <label for="">Image file upload</label>
          <input type="file" id="image" name="image" size="50" class="fileUpload" />
          <p class="formHint">Select an image for the customer.</p>
        </div>


        <div class="ctrlHolder noLabel">
          <ul>
            <li><label for=""><input id="" name="" value="" type="checkbox"/> Activate this customer?</label></li>
          </ul>
          <p class="formHint">Check to make the customer active in the asset database.</p>
        </div>
        

      <div class="buttonHolder">
        <button type="submit" class="primaryAction">Submit</button>
      </div>

    </form>
    ';


$customer_button_form =<<< EOF
<p>
	<form name="addnew" action="q2_customers_edit.php?mode='ADD'" method="POST">
		<div align="right">
			<h3 class="title">Add a New entry</h3>
			<input type="image" src="images/blue.png" name="Add" width="40" height="40">
		</div>
	</form>
</p>
EOF;

$customer_list_title = "Quicktools Customer List";
    
?>

