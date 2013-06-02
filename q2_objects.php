<?php
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		qt_objects.php
//	SYSTEM:		Network monitoring	
//	AUTHOR:		Mark Addinall
//  DATE:       29/10/2007
//	SYNOPSIS:	The Object definitions for the
//				classes used within the CMS/quicktools
//				system both for data storage
//				and for connectivity establishment
//				and manipulation.
//              This file has seen some major re-use over
//              the years.  Apart from the quicktools suite,
//              this file has been part of the Chameleon CMS
//              and several specific applications, ACCLOUD
//				accounting, What's Mine (Mining industry ERP
//				and assett management) and BetMe, a horce racing
//				statistical data gathering and reporting application
//				to name a few.
//
//				In the latest incarnation of quicktools this application
//				provides a number of different functions:
//
//				1. Machine health test (NOC) in various ways using SNMP and MIB traps.
//				2. An asset register controlling resource an locations
//				3. NOC ticket tracker
//				4. NOC and beyond network diagram browsing
//
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 29/04/2007 | Initial creation Telstra      |  MA
// 12/08/2009 | Complete re-write v2.x own use|  MA
// 18/02/2010 | Re-write CITEC (unfinished)   |  MA
// 12/02/2012 | Re-write v3.x new object model|  MA
//------------+-------------------------------+------------

// 'traits' have recently been incorporated into PHP 5.x
// This file has followed an OOP/OOD paradigm for several
// years, but always had trouble translating true OOD
// structures and techniques due to PHP following the Java
// single inheritance model in the past.  With traits
// being added to the language, a more flexible OOD model
// can be used.
//
// In the objects, Primitive and Base and subsequently application
// specific objects, Suppliers, Machines, Networks etc had a number
// of similar, but not identical methods in the implementation of
// these objects.  This led to the potential error(s) in that data
// structure within the object could be changed, rendering the
// accessor methods in some objects incorrect.  We have now place
// the common data manipulation methods into traits, which can
// be imported into object classes.
//
// Although this gives the impression of improved polymorphism
// through multiple inheritance, the actual operation within
// PHP give no runtime bindings, the 'trait' is just actually
// a big cut and paste job for the token-getter part of the parser
// prior to I code generation.  Still, it looks nifty, and keeps
// the code neater.



//----------------
trait timeModify {
 
	//------------------------------
	function time_modified() {

	// we do NOT let anyone pass a value into this
	// function.  I suppose a clever secret squirrel
	// might figure out how to change the system clock,
	// but, then, other alarms will be a trippin'

		$this->modified = date('c');	// se above re format
	}
}



//-------------
class Primitive {


// This is our entry level object.
// All of the entities contained
// in the database in this CMS
// have these attributes.

private		$id ;			// row num

private		$short_name ;	// computer freindly name
private		$active ;		// is it alive?

private		$created ;		// when created?
	//--------------------
	function Primitive() {
	// constructor
	// it has become trendy to use
	//  __construct(...,,), but I think it is wanky and
	//  belongs in a schoolroom

		$this->created = date('c'); // this is a date-time stamp that
								 	// conforms to the ISO8601 standard
									// 2010-04-17T05:19:21+00:00
									// it removes audit ambiguity
									// only EVER used once, so not extended
									// into a function or trait
	}
} // Primitive



//--------------------------
class Base extends Primitive
{

use timeModify;

// This is our baseline object
// model.  MOST entities in the 
// database contain these attributes

private		$name ;			// what is this called?
private		$description ;  // standard stuff, what am I going to be
private		$information ;  // more blurb, usually use by applications
private		$tags ;			// this used to be called meta-data.
							// an importand field as dynamic, and to
							// an extent, self describing objects
							// within applications miss out on the current
							// partial ontology that is, web 2.0,
							// or, cloudy stuff.  A more practical use
							// is SEO.  Having objects tag themselves
							// as they wander through web space is a lot
							// more versatile than static XML gooballs.
							
private		$modified ;		// and last modified.
							// these are private for security reasons
							// in regards to a data audit
							// we REALLY want to know when one of
							// our database objects changed.

private		$image ;		// textual pointer to an image of the object
							// if applicable
	//-------------	
	function Base()
	{
	// constructor
	// do nothing
	}
} // Base


// Now we start to describe the entities
// used in this incanation of the CMS



//---------------------------------
class Client extends Base
{

	// The database strategy now is half traditional (on application
	// start, loading major stacks of objects) and AJAXy database
	// updates which obviously do not require a document re-fetch.
	//
	// Mid 2011, this is now being used in Family Law Settlement
	// centres web application.  Modified of course.


    //---------------
    function Client()
    {
	// this object can be created in two different ways.
	// To create and define a brand new object to go into the
	// database, or be created to retrieve an existing object
	// from the database.  As such, the constructor has nothing
	// to do once the memory is allocated.  In the latter
	// case, objects can be PUSHED onto a stack.  And generally are.
	// nothing to do	
	
	}
	

	//---------------------------------
	public function add_client( 	$db,
									$short_name,
									$active,
									$name,
									$description,
		 							$email,
									$url,
									$telephone,
									$telephone_two,
									$safe,
									$address_one,
									$address_two,
									$city,
									$postcode,
									$password )

	{
	// add new client into the database
	// the row nu (id) is auto generated
	// the short_name MUST be unique or the SQL
	// function wil fail.
	// short_name is one of the primary keys into ALL
	// of our tables.
	//
	//	id				int(11)
	//	short_name		varchar(64)
	//	active			tinyint(4)
	//	name			varchar(255)
	//	description		text
	//	tags			varchar(512)
	//	created			datetime
	//	updated			timestamp
	//	email			varchar(255)
	//	url				varchar(255)
	//	telephone		varchar(32)
	//	telephone_two	varchar(32)
	//	safe			tinyint(4)
	//	address_one		varchar(255)
	//	address_two		varchar(255)
	//	city			varchar(255)
	//	postcode		varchar(4)
	//	has_paid		tinyint(4)
	//	balance			decimal
	//  password		varchar(12)


		$tags						=	"new client meta data";
		$description				=	$db->prepare_trusted( $description ) ;	// escape the special characters
        $tags	            		=   $db->prepare_trusted( $tags );			// to make it safe for the DBMS
		$created					=	date('Y-m-d H:i:s');					// this is a DATETIME format	



		$sql = "INSERT INTO clients ( short_name, active, name, description, tags, created, email, url, telephone, telephone_two, safe, address_one, address_two, city, postcode, has_paid, balance, password ) ". 
									"VALUES( '$short_name', ".
											"'$active', ".
											"'$name', ".
											"'$description', ".
											"'$tags', ".
											"'$created',".
		 									"'$email',".
											"'$url',".
											"'$telephone',".
											"'$telephone_two',".
											"'$safe',".
											"'$address_one',".
											"'$address_two',".
											"'$city',".
											"'$postcode',".
											"'0',".
											"'0.0',".
											"'$password' )";


		if ( $db->is_alive() )		// no use trying to add to a database
		{							// that is not turned on!
			$db->execute( $sql ) ;	// doit.., execute has it's own error routines
		}
	} // add_client


	//-----------------------------------------------------
	public function update_safe( $db, $short_name, $value )
	
	{
	$sql = "UPDATE clients set safe = $value where short_name = $short_name";

		if ( $db->is_alive() )		// no use trying to add to a database
		{							// that is not turned on!
			$db->execute( $sql ) ;	// doit.., execute has it's own error routines
		}
	}


	//--------------------------------------------------------
	public function update_balance( $db, $short_name, $value )
	
	{
	$sql = "UPDATE clients set balance = $value where short_name = $short_name";

		if ( $db->is_alive() )		// no use trying to add to a database
		{							// that is not turned on!
			$db->execute( $sql ) ;	// doit.., execute has it's own error routines
		}
	}



	//--------------------------------------------------------
	public function update_paid( $db, $short_name, $value )
	
	{
	$sql = "UPDATE clients set has_paid = $value where short_name = $short_name";

		if ( $db->is_alive() )		// no use trying to add to a database
		{							// that is not turned on!
			$db->execute( $sql ) ;	// doit.., execute has it's own error routines
		}
	}




	//--------------------------------------------	
	public function get_client( $db, $short_name )
	{
	// fetch ONE content entry from the database
	// and return it to calling entity

		$sql = "SELECT * FROM clients WHERE short_name = '$short_name'";

		if ( $db->is_alive() )					// no sense querying a dead database
		{
			$db->execute( $sql ) ;				// do it through the DB object
		}
	
		$row = $db->fetch();
	
		$this->populate( $row ) ;				// fetch returns a ROWTYPE object.
												// we now populate THIS object
												// with the column values from the row returned
	}


	//---------------------------------------------
	public function get_all_clients( $encode, $db )
	{
	// this loads ALL the content records into the 
	// array $contents.  In PLAIN text format,  This will
	// be suitable for transfers in and out of the CMS,
	// or in JSON encoded format, which is suitable for
	// the Javascript display routines.

		$sql = "SELECT * FROM content ORDER BY short_name" ;

		if ( $db->is_alive() )												// no sense querying a dead database
		{
			$db->execute( $sql ) ;											// do it through the DB object
		}
	
		while ( $row = $db->fetch() )										// do until row is empty
		{
			$my_client = New Client() ;										// instance a new object
			$my_client->populate( $row ) ;									// populate the object from the database %ROWTYPE
			if ( $encode )													// are we encoding this for Javascript?
			{																// if yes
				$my_client->description =									// pull the plain HTML out of description,
					trim( $my_client->description ) ;						// trim it, encode it, and pop it back in!
			}																// neat hey?  :-)
			$this->clients[ '$my_clients->short_name' ] =					// now push it on the stack indexed by
				$my_client ;												// the friendly name ie: clients['help_page'];
		}																	// end while
	}																		// get all clients



    //-----------------------------
	public function populate( $row )
    {
    // get a data base row and populate
    // the object
	//
	//	id				int(11)
	//	short_name		varchar(64)
	//	active			tinyint(4)
	//	name			varchar(255)
	//	description		text
	//	tags			varchar(512)
	//	created			datetime
	//	updated			timestamp
	//	email			varchar(255)
	//	url				varchar(255)
	//	telephone		varchar(32)
	//	telephone_two	varchar(32)
	//	safe			tinyint(4)
	//	address_one		varchar(255)
	//	address_two		varchar(255)
	//	city			varchar(255)
	//	postcode		varchar(4)
	//	has_paid		tinyint(4)
	//	balance			decimal


        $this->id                       =   $row[ 'id' ] ;
        $this->short_name               =   $row[ 'short_name' ] ;
        $this->active                   =   $row[ 'active' ] ;
        $this->name              		=   $row[ 'name' ] ;
		$this->description				=	$row[ 'description' ] ;
        $this->tags	            		=   $row[ 'tags' ] ;
		$this->created					=	$row[ 'created'] ;
        $this->updated	           		=   $row[ 'updated' ] ;
		$this->email		           	=   $row[ 'email' ] ;
		$this->url			           	=   $row[ 'url' ] ;
		$this->telephone		       	=   $row[ 'telephone' ] ;
		$this->telephone_two	       	=   $row[ 'telephone_two' ] ;
		$this->safe			           	=   $row[ '' ] ;
		$this->address_one		       	=   $row[ '' ] ;
		$this->address_two	           	=   $row[ '' ] ;
		$this->city		           		=   $row[ '' ] ;
		$this->postcode	           		=   $row[ '' ] ;
		$this->has_paid	           		=   $row[ '' ] ;
		$this->balance	           		=   $row[ '' ] ;
		
    }

} // Client 




//---------------------------------
class Content extends Base
{
	// 2011 - This object has been used in several versions of
	// chameleon.  Now being used in eHealth.  I left the
	// above commenents in for MY historical purpose.
	//
	// The database strategy now is half traditional (on application
	// start, loading major stacks of objects) and AJAXy database
	// updates which obviously do not require a document re-fetch.
	//
	// Mid 2011, this is now being used in Family Law Settlement
	// centres web application.  Modified of course.

public $contents				= array() ;

    //---------------
    function Content()

	// this object can be created in two different ways.
	// To create and define a brand new object to go into the
	// database, or be created to retrieve an existing object
	// from the database.  As such, the constructor has nothing
	// to do once the memory is allocated.  In the latter
	// case, objects can be PUSHED onto a stack.  And generally are.

    {
	// nothing to do	
	
	}

	//---------------------------------
	private function add_content( $db )
	{
	// add new web content into the database
	// the row nu (id) is auto generated
	// the short_name MUST be unique or the SQL
	// function wil fail.
	// short_name is one of the primary keys into ALL
	// of our tables.


		$sql = "INSERT INTO content ( short_name, active, name, description, tags, created ) ". 
									"VALUES( '$this->short_name', ".
											"'$this->active', ".
											"'$this->name', ".
											"'$this->description', ".
											"'$this->tags', ".
											"'$this->created' )";

		if ( $db->is_alive() )		// no use trying to add to a database
		{							// that is not turned on!
			$db->execute( $sql ) ;	// doit.., execute has it's own error routines
		}
	} // add_content


	//----------------------------------------	
	public function get_content( $short_name, $db )
	{
	// fetch ONE content entry from the database
	// and return it to calling entity

		$sql = "SELECT * FROM content WHERE short_name = '$short_name'";

		if ( $db->is_alive() )					// no sense querying a dead database
		{
			$db->execute( $sql ) ;				// do it through the DB object
		}
	
		$this->populate( $db->fetch() ) ;		// fetch returns a ROWTYPE object.
												// we now populate THIS object
												// with the column values from the row returned
	}


	//---------------------------------------------
	public function get_all_content( $encode, $db )
	{
	// this loads ALL the content records into the 
	// array $contents.  In PLAIN text format,  This will
	// be suitable for transfers in and out of the CMS,
	// or in JSON encoded format, which is suitable for
	// the Javascript display routines.

		$sql = "SELECT * FROM content ORDER BY short_name" ;

		if ( $db->is_alive() )												// no sense querying a dead database
		{
			$db->execute( $sql ) ;											// do it through the DB object
		}
	
		while ( $row = $db->fetch() )										// do until row is empty
		{
			$get_content = New Content() ;									// instance a new object
			$get_content->populate( $row ) ;									// populate the object from the database %ROWTYPE
			if ( $encode )													// are we encoding this for Javascript?
			{																// if yes
				$get_content->description =									// pull the plain HTML out of description,
					json_encode( array( utf8_encode( $get_content->description ) ) ) ;		// trim it, encode it, and pop it back in!
			}																// neat hey?  :-)
			$this->contents[ "$get_content->short_name" ] =					// now push it on the stack indexed by
				$get_content ;												// the friendly name ie: contents['help_page'];
		}																	// end while
	}																		// get all content


	//------------------------------------
	public function build_new(	$short_name, 
								$name, 
								$description, 
								$tags,
								$db)
	{
	// this function populates a new content object
	// after a call lke $c = New Content();
	// this function populates it with relevant values.


        $this->short_name               =   $short_name ;
        $this->active                   =   '1' ;									// make it active
        $this->name              		=   $name ;
		$this->description				=	$db->prepare_trusted( $description ) ;	// escape the special characters
        $this->tags	            		=   $db->prepare_trusted( $tags );			// to make it safe for the DBMS
		$this->created					=	date('Y-m-d H:i:s');					// this is a DATETIME format	

		$this->add_content( $db );		// chuck it in the database
	} 


    //-----------------------------
	public function populate( $row )
    {
        // get a data base row and populate
        // the object

        $this->id                       =   $row[ 'id' ] ;
        $this->short_name               =   $row[ 'short_name' ] ;
        $this->active                   =   $row[ 'active' ] ;
        $this->name              		=   $row[ 'name' ] ;
		$this->description				=	$row[ 'description' ] ;
        $this->tags	            		=   $row[ 'tags' ] ;
		$this->created					=	$row[ 'created'] ;
        $this->updated	           		=   $row[ 'updated' ] ;
		
    }

} // Content 




//---------------------------
class Datacenter extends Base
{

    //--------------------
    function Datacenter()
    {
        // constructor, do nothing
    }

    //------------------------------
    public function populate( $row )
    {
        // get a data base row and populate
        // the object

    }
} 


//-------------------------
class Dataroom extends Base
{

    //-----------------
    function Dataroom()
    {
        // constructor, do nothing
    }

    //-----------------------------
    public function populate( $row )
    {
        // get a data base row and populate
        // the object

    }
} 

//------------------------
class Network extends Base
{

    //---------------
    function Network()
    {
        // constructor, do nothing
    }

    //-----------------------------
    public function populate( $row )
    {
        // get a data base row and populate
        // the object

    }
} 


//------------------------
class Machine extends Base
{

    //---------------
    function Machine()
    {
        // constructor, do nothing
    }

    //-----------------------------
    public function populate( $row )
    {
        // get a data base row and populate
        // the object

    }
} 


//---------------------------------
class Blog extends Base
{

    //---------------
    function Blog()
    {
        // constructor, do nothing
    }

    //-----------------------------
    public function populate( $row )
    {
        // get a data base row and populate
        // the object

    }
} 


//---------------------------------
class Customer extends Base
{
//    private $password = '' ;

    //---------------
    function Customer()
    {
        // constructor, do nothing
    }

    //----------------------------
    public function get_password()
    {
        // return a password
    }


    //-------------------------------------------------------
    public function set_password( $password = "NOT DEFINED" )
    {
        // encrypt and  set the password
    }

    //-----------------------------
    public function populate( $row )
    {
        // get a data base row and populate
        // the object

        
    }
} // Client 


//-------
class Link
{
    // This object is quite different from the
    // other database entities.
    // It is what forms the 'glue' on the
    // many to many relationships within this
    // system.  It allows multi-way unbalanced
    // relations.

    public  $major_category ;
    public  $minor_category ;
    public  $link_from ;
    public  $link_to ;
	public  $updated ;

	public	$list = array() ;


	//-----------
	function Link()
	{
		// do nothing, constructer
	}


	//-----------------------------
	function add( 	$major,
					$minor,
					$link_from,
					$link_to,
					$update = '' 
				)


    {

		// firstly populate the object as
		// it will be itself populating a stack
		// in the outside world

		if ( $update == '' )
		{
			$update = date( 'Y-m-d' ) ;
		}


    	$this->major_category	=	$major ;
    	$this->minor_category	=	$minor ;
    	$this->link_from		=	$link_from  ;
    	$this->link_to			=	$link_to ;
		$this->updated			=	$update ;


		// Now build the database EXEC statement

		$sql  = 	"INSERT INTO many_to_many " ;
		$sql .= 	"(	major_category, "  ;
		$sql .= 	"	minor_category, "  ;
		$sql .= 	"	link_from, "  ;
		$sql .= 	"	link_to, "  ;
		$sql .= 	"	updated ) "  ;
		$sql .= 	"VALUES "  ;
		$sql .= 	"(	'$this->major_category', "  ;
		$sql .= 	"	'$this->minor_category', "  ;
		$sql .= 	"	'$this->link_from', "  ;
		$sql .= 	"	'$this->link_to', "  ;
		$sql .= 	"	'$this->updated' )"  ;

		if ( $database->alive )
		{
			$database->execute( $sql ) ;
		} // if
	} // add

	//--------------------------------
	function delete( $who )
	{

		global $database ;

		$sql = "DELETE FROM many_to_many WHERE link_from  = '$who'" ;
		
		$database->execute( $sql ) ;
	} // delete


	//--------------------------
	function create( $parent, $name )
	{

	global	$customer_checkbox,
			$machine_checkbox	;

	global 	$database ;


		$size = count( $customer_checkbox ) ;
		if ($size)
		{
			for(	$count = 0 ;
					$count < $size ;
					$count++ )
			{
				$this->add(	"customer",
							"$parent",
							"$name",
							"{$customer_checkbox[ $count ]}",
							date( 'Y-m-d' ) ) ;
			}
		}

		$size = count( $machine_checkbox ) ;
		if ($size)
		{
			for(	$count = 0 ;
					$count < $size ;
					$count++ )
			{
				$this->add(	"machine",
							"$parent",
							"$name",
							"{$machine_checkbox[ $count ]}",
							date( 'Y-m-d' ) ) ;
			}
		}
	}
	//-----------------------------------------
	function build_list( $what_type, $for_whom )

	{
		global $database ;

		// build a list of reference from the many to many
		// link file of a specific type ie properties
		// for a specific Object 'Mark Addinall the Guide'

		// clean out the list

		$this->list = '' ;

		$sql = "SELECT * from many_to_many " ;
		$sql .= "      WHERE major_category = '$what_type'  " ;
		$sql .= "      AND   link_from = '$for_whom' " ;

		$handle = $database->execute( $sql ) ;
		if ( $handle )
		{
			while ( $row = $database->fetch( $handle ) )
			{
				$this->list[] = $row['link_to'] ;
			}
		}

		return( $this->list ) ;
	}	

} // Link



//--------------
class Database

// This object opens, closes, manages, manipulates
// and reports on our database.  This is pointed
// only at mySQL at the moment.  
// This level of abstraction will allow us to use 
// ORACLE, DB2, MSql and Postgress drivers easily
// by the application programmers.
//
// Two classes of methods are contained in this class.
// 1.  Methods for accessing local or network attached
// database (hard drive for small machines, NAS or SAN
// for larger installations), and,
// 2. The AJaX routines for retreiving and storing
// data.


{

private		$configuration ;
private		$alive ;
private		$result ;


	//-----------------
	function Database()
	{
	// constructor

	require("config.php");  // text file with db info

    // first populate our internal configuration
    // from the array argument passed in

    $this->configuration = $config ;   // this is an array containing database variables (globalish) ;

    // and try to connect to the database
    // this level of abstraction will allow for
    // ORACLE, Postgres of DB2 databases

	$this->connect() ;

	} // constructor

	//-------------------------------------
	private function connect()
	{
	// connect to the RDMS first 

			$this->alive = FALSE ;										// start out dead
			if ($this->configuration[ 'db' ] == 'mySQL')				// cater for several types of database
			{
				$this->configuration[ 'stream' ] =						// he stream is in effect a socket
				mysql_connect(	$this->configuration['hostname'],		// hostname or LUN
								$this->configuration['user'],			// username
								$this->configuration['password'] ) 		// password in plain.  must look into this
					or die('Database not started :    '.mysql_error()) ;// fail?  die with the error

																		// now connect to the database required

				mysql_select_db( 	$this->configuration[ 'database' ],	// this is the database name ie. ehealth
									$this->configuration[ 'stream' ] )	// this is a binary stream (socket())
					or die('Database   :  '. 
							$this->configuration[ 'database' ] .		// in this instance we can connect to
							  '   not in Mysql Namespace' . 			// the RDBMS but not to the namespace
							  			mysql_error() ) ;				// database name spelled wrong in the
																		// config or the database is off-line
			}															// end of mySQL
																		// -----------------------------------
			else if ($this->configuration[ 'db' ] == 'ORACLE')			// cater for several types of database
			{
				$this->configuration[ 'stream' ] = 						// tell ORACLE we want a permanent connection
				oci_pconnect( 	$this->configuration['user'],			// username
								$this->configuration['password'],  		// password in plain.  must look into this
								$this->configuration['hostname'] ) 		// 
					or die('Database not started :    ' ) ;				// fail? 
			}															// end of ORACLE
																		// -------------------------------------
			else if ($this->configuration[ 'db' ] == 'DB2')				// The IBM offering.  This is important
																		// as mainframes haven't gone away.
																		// IBM has Linux and DB2 running native
																		// in the zEnterprize models and implementing
																		// dozens to tens of thousands virtual
																		// hosts on the mainframe.
			{
				$this->configuration[ 'stream' ] = 					
				odbc_pconnect( 	$this->configuration['database'],		// DB2 is a little weird, this is sort of a namespace 
								$this->configuration['user'],  			// user in catalog 
								$this->configuration['password'] ) 		// password in plain again
					or die('Database not started :    ' .				// fail? 
							$this->configuration[ 'database' ] .		// in this instance we can connect to
							  '   not in DB2 Catalog' . 				// the RDBMS but not to the namespace
							  			odbc_errormsg( $this->configuration['stream']) ) ;				
																		// database name spelled wrong in the
																		// config or the database is off-line
			}															// end of DB2
																		// -------------------------------------
			$this->alive = TRUE ;

	} // connect


	//------------------------------------
	public function prepare_trusted( $str )
	{
	// two types of user can insert or update into our database.
	// Adinistrators who will add content and functionality
	// and clients/end user staff, who wil add data via input forms
	// that are externally pointing.
	// Tenable security and reliable data storage, the SQL string
	// have to be treated in two different ways.
	// When storing SQL one must take into account that special
	// characters need to be retained, such as:
	//
	// <a href="www.anyweb.com.au?stuff=NOW" onMouseOver='do_hover("my_stuff"); return true;'>stuff</a>
	//
	// The SQL engine (any one) will spit when trying to store this string so
	// we need to escape it with:
	//
	// my_sql_real_escape_sting( $str )
	//
	// This preserves all of the special characters in our HTML code.
	//
	// See below for the opposite treatment on non trusted injections.

		return mysql_real_escape_string( $str );

	} // prepare_trusted 


	//----------------------------------------
	public function prepare_non_trusted( $str )
	{
	// two types of user can insert or update into our database.
	// Adinistrators who will add content and functionality
	// and clients/end user staff, who wil add data via input forms
	// that are externally pointing.
	// Tenable security and reliable data storage, the SQL string
	// have to be treated in two different ways.
	//
	// htmlspecialchars( $str) will replace any HTML or SCRIPT
	// characters into a representation.  '>' becomes &gt; etc.
	// This goes to guard against SQL injection attacks, followed by
	// my_sql_real_escape_sting( $str )
	// to futher qualify the string with escapes.
	// 
	//
	// See below for the similar treatment on non trusted injections.

		return mysql_real_escape_string( htmlspecialchars( $str ) ) ;

	} // prepare_non_trusted



	//--------------------------------------
	public function execute( $sql ) 
    {
	// just execute IMMEDIATELY a pre-formed SQL Statement

		if ($this->configuration[ 'db' ] == 'mySQL')
		{
        	$this->result = mysql_query( 	$sql, 
            								$this->configuration['stream']) ;
        	if (! $this->result )
        	{
            	die('SQL Failure:   ' . mysql_error() . '<BR>') ;
        	}
        return $this->result ;
		}
		else if ($this->configuration[ 'db' ] == 'ORACLE')
		{
		// TO DO

		}
		else if ($this->configuration[ 'db' ] == 'DB2')
		{
		// TO DO

		}
    } // execute 


    //---------------------
	public function fetch() 
    {
	// fetch the TOP row array from the returned SELECT
	// call.
	// this is normally called when only SELECTing one
	// element from the database ie: one particular client,
	// or can be inside a LOOP construct to get multiple records.

        $row = mysql_fetch_array( $this->result ) ;		// $this->result is a data stream
														// returned by the execute statement

        return $row ;

    } //  fetch


	//--------------------------------------
	public function close() 
    {
        mysql_close( $this->configuration['stream']) ;
		$this->alive = 0 ;

	} // close	

	
	//------------------------	
	public function is_alive()
	{
	// NUMBER FIVE IS ALIVE!!!
	
		return $this->alive ;
	}

} // class Database 




//----------
class Mailer
{

	// a small class that allows the various function points
	// in the system to send mail.


	//---------------
	function Mailer()
	{
	// constructer
	// nothing to do
	}

	//-------------------------------------------------------------------------------------------------------------
	public function send_mail($filename, $path, $mailto, $from_mail, $from_name, $replyto, $cc, $subject, $message) 
	{

		// this function dresses up the mail pacjage as a MIME
		// multi part mesage allowing file attachments

    	$file 			= $path.$filename ;													// concatenate PATH and FILENAME
    	$file_size 		= filesize( $file ) ;												// dope the size in BYTES
    	$handle 		= fopen( $file, "r" ) ;												// open the file for READ access
    	$content 		= fread( $handle, $file_size ) ;									// and suck it in

    	fclose( $handle ) ;																	// shut the file (nice and tidy)

    	$content = chunk_split( base64_encode( $content ) ) ;								// first encode the binary file into
																							// base64 7 bit format, so no matter
																							// what mailer we go through, file file
																							// will be delivered	

    	$uid 			= md5( uniqid( time() ) ) ;											// build an unique ID for the mail ackage
    	$name 			= basename( $file )	;												// probably not required	


    	$header 		= "From: ".$from_name." <".$from_mail.">\r\n" ;						// Add the pretty <Mark Addinall> bit
    	$header 		.= "Reply-To: ".$replyto."\r\n" ;									// mail back
    	$header 		.= "Cc: ".$cc."\r\n" ;												// cc to whome?

    	$header 		.= "MIME-Version: 1.0\r\n" ;										// now set up the encoding information
    	$header 		.= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    	$header 		.= "This is a multi-part message in MIME format.\r\n";
    	$header 		.= "--".$uid."\r\n";
    	$header 		.= "Content-type:text/plain; charset=iso-8859-1\r\n" ;				// Now for the text message
    	$header 		.= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    	$header 		.= $message."\r\n\r\n";
    	$header 		.= "--".$uid."\r\n";
    	$header 		.= "Content-Type: application/octet-stream; name=\"".				// and for the attachment
														$filename."\"\r\n" ;				// you can use different content types here
    	$header 		.= "Content-Transfer-Encoding: base64\r\n";
    	$header 		.= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    	$header 		.= $content."\r\n\r\n";
    	$header 		.= "--".$uid."--" ;													// end the headers

    	return( mail( $mailto, $subject, "", $header ) ) ;									// OUT!  Damn SPOT!
    }
	

	//-------------------------------------------------------------------------------------------------------------
	public function send_simple_mail($mailto, $subject, $body, $headers) 
	{

		// much like the above but with no attachments and/or encoding.


    	return(mail($mailto, $subject, $body, $headers));

    }
}  // class Mailer



?>

