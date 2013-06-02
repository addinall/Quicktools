//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		java_utils.js
//	SYSTEM:		KOOKIVOO generic CMS
//	AUTHOR:		Isis St Pierre, Mark Addinall
//	DATE:           9th Apr 2008
//	SYNOPSIS:	Bits and peices of Javascript
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
//09/04/2008  |Initial creation               |    MA
//10/04/2009  |Modify for Brafit              |    MA
//------------+-------------------------------+------------
//
//



function checkForm()
{
   // the variables below are assigned to each
   // form input 
   var gname, gemail, gurl, gmessage;

   with(window.document.entry_form)
   {
      gname    = object_name ;
      gemail   = email;
      gurl     = url;
      gmessage = message;
   }

   // if name is empty alert the visitor
   if(trim(gname.value) == '')
   {
      alert('Please enter your name');
      gname.focus();
      return false;
   }
   // alert the visitor if email is empty or 
   // if the format is not correct 
   else if(trim(gemail.value) != '' && !isEmail(trim(gemail.value)))
   {
      alert('Please enter a valid email address or leave it blank');
      gemail.focus();
      return false;
   }
   // alert the visitor if message is empty
   else if(trim(gmessage.value) == '')
   {
      alert('Please enter your message');
      gmessage.focus();
      return false;
   }
   else
   {
      // when all input are correct 
      // return true so the form will submit 
      return true;
   }
}

/*
Strip whitespace from the beginning and end of a string
*/
function trim(str)
{
   return str.replace(/^\s+|\s+$/g,'');
}

/*
   Check if a string is in valid email format. 
*/
function isEmail(str)
{
return true;
}

 




//------------------
function clearForms()
{
  var i;
  for (i = 0; (i < document.forms.length); i++)
  {
    document.forms[i].reset();
  }
}


//--------------------
function refresh()
{
//	window.location.reload(true) ;
}


//--------------------
function start_this()
{
//    if( history.previous != history.current )
//	{
//		window.location.reload(true);

//	window.location.href = window.location.href; 

}

