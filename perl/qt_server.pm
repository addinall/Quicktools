=begin HEADER
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:       qt_server.pm
//	SYSTEM:   	Quicktools V3.x 
//	AUTHOR:     Mark Addinall
//	DATE:       04/03/2012
//	SYNOPSIS:	The Perl in v3.x implements a RESFful client
//				server (Representational State Transfer) architecture
//				to catch the SNMP requests, and return the data
//				back to the PHP elements of the system.
//
//				I wanted to implement an AJAX type of transaction
//				between a persistent server and a PHP transaction.
//
//				I may be guilty of re-inventing the wheel here,
//				I googled CERNed and PEARed and could not find
//				a library that did what I wanted.  I was also keen
//				to keep a solid OOD/OOP model so in Perl I am using
//				my favourite use Moose
//				and in the PHP, my own Object Framework (everyone
//				who is anyone on this Planet knows what I think
//				about stupid MVC frameworks for baby spaghetti
//				coders).
//				
//				Moose makes Perl look a LOT like PL/SQL or Ada.
//				It is very, very pretty.
//
//				The parts of a REST transaction are:
//
//				NOUN 	- 	an identifier, generally a URL
//				VERB 	- 	CRUD (Create, Read, Update and Delete).
//							In this context we use the HTTP request
//							methods viz:
//							GET 	- GET request to READ
//							POST	- POST request to perform CREATE
//							PUT		- PUT request to perform an UPDATE
//							DELETE	- DELETE performs a DELETE!!!
//
//				CONTENT	-	In this system, as we are talking to the
//							RESTful client that is PHP and Javascript,
//							our content type between CLIENT and SERVER
//							will be JSON.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 04/03/2012 | Initial creation              |    MA
//------------+-------------------------------+------------
//
//
=end HEADER
=cut

# my $snmp_server = SNMP_server->new;

package SNMP_server;

	has 'pid'		=> (is => 'ro'. isa => 'Str');
	has 'active'	=> (is => 'ro'. isa => 'Int');


no Moose;

__PACKAGE__;

1;

=begin FOOTER

// This is the end of the implementation of the Perl
// RESTful SNMP server

=end FOOTER
=cut

