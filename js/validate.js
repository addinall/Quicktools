
<script language="JavaScript" type="text/javascript">

//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		validate.js
//	SYSTEM:		KOOLIVOO generic CMS
//	AUTHOR:		Mark Addinall
//	DATE:		2nd Apr 2008
//	SYNOPSIS: 	This validates the data in the CMS input new and
// 				edit forms.
// 
// 				Since I normalised the database, the Primitive and the Base
// 				classes of entities form the basis for EVERY object in
// 				the system, we can use a generic for validation routine
//
// 				The radio buttons in the system will always contain
// 				a pre-load value, so we don't care.  Checkboxes in
// 				the system are prely optional.
//
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
//02/04/2005  |Initial creation               |    MA
//------------+-------------------------------+------------
//
//
	// the form name in every input PHP program is the same
	// define an instance of our validator class and encapsulate
	// the address of the form DOM
	
    var frmvalidator  = new Validator("get_data");
	
	// Every entity needs a name.  A primary data base key
    frmvalidator.addValidation("name","req","Please enter a value in the Name field");

	// Every entity needs an alia. A secondary data base key
    frmvalidator.addValidation("alias","req","Please enter a value in the Alias field");

	// Every entity needs at least one meta entry
    frmvalidator.addValidation("meta_keywords","req","Please enter a value in the meta keywords field");

</script>



