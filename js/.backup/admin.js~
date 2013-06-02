
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:		admin.js
//	SYSTEM:		KOOLIVOO Generic CMS
//	AUTHOR:		Zann St Pierre, Isis St Pierre, Mark Addinall
//	DATE:		May 7th 2008
//	SYNOPSIS:	Javascript functions for the admin pages
//				to overload choice drop down and to add
//				text into the form's DOM.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
//07/05/2008  |Lifted out of AA into CMS      |   MA
//------------+-------------------------------+------------
//
//

//--------------------------------------
function insertAtCursor(myField, myValue) 
{


  //IE support
  if (document.selection) 
  {
    myField.focus();
    sel = document.selection.createRange();
    sel.text = myValue;
  }
  //MOZILLA/NETSCAPE support
  else if (myField.selectionStart || myField.selectionStart == '0') 
  {
    var startPos = myField.selectionStart;
    var endPos = myField.selectionEnd;
    myField.value = myField.value.substring(0, startPos)
                  + myValue
                  + myField.value.substring(endPos, myField.value.length);
  } else 
  {
    myField.value += myValue;
  }
}



//auto load


// these first six functions are special to the property add
// program.  Man, EVERYTHING on that page has a link!

$(document).ready(function () { 

        $('select[name="flora_link_1"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='florafauna_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#flora_link_1 option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;

					insertAtCursor(document.get_data.summary,linktotal);					
                } 
        });
		
        $('select[name="interest_link_1"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='interest_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#interest_link_1 option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.summary,linktotal);					
                } 
        }); 
		
        $('select[name="flora_link_2"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='florafauna_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#flora_link_2 option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.longer_description,linktotal);					
                } 
        }); 
		
        $('select[name="interest_link_2"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='interest_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#interest_link_2 option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.longer_description,linktotal);					
                } 
        });
		
        $('select[name="flora_link_3"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='florafauna_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#flora_link_3 option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.activities,linktotal);					
                } 
        });
		
        $('select[name="interest_link_3"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='interest_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#interest_link_3 option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.activities,linktotal);					
                } 
        });
	
// these following are more generic through out the system



        $('select[name="add_ff_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='florafauna_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#add_ff_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.longer_description,linktotal);					
                } 
        });
		
        $('select[name="add_interest_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='interest_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#add_interest_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.longer_description,linktotal);					
                } 
        });
	

		
        $('select[name="add_property_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='property_summary.php?name=";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#add_property_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.get_data.longer_description,linktotal);					
                } 
        });
	
		
});
