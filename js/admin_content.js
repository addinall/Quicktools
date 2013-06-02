function insertAtCursor(myField, myValue) {
  //IE support
  if (document.selection) {
    myField.focus();
    sel = document.selection.createRange();
    sel.text = myValue;
  }
  //MOZILLA/NETSCAPE support
  else if (myField.selectionStart || myField.selectionStart == '0') {
    var startPos = myField.selectionStart;
    var endPos = myField.selectionEnd;
    myField.value = myField.value.substring(0, startPos)
                  + myValue
                  + myField.value.substring(endPos, myField.value.length);
  } else {
    myField.value += myValue;
  }
}

function addsafariimg2(url) {
	 $.ajax({
	 type: "POST",
	 url: url
	 });
}	

function addsafariimg(url) {
//$.get(url);
$.get(url,
  function(data){
    alert("loaded");
  });


}

$(document).ready(function () { 
        $('select[name="animal_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../wildlife/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#animal_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        });
		
        $('select[name="accomm_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../accommodation/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#accomm_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        }); 
		
        $('select[name="guide_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../guides/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#guide_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        }); 
		
        $('select[name="park_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../places/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#park_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        }); 
		
        $('select[name="safari_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../safari/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#safari_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        });

        $('select[name="map_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../map/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#map_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        });

        $('select[name="activity_link"]').change(function () { 
				if (this.value) {
					var linkstart = "<a href='../activity/";
					var link = (this.value);
					var linkend = "'>";
					var linkcopy = $('#activity_link option[@selected]').text(); 
					var linkcap = "</a>";
						
					var linktotal;
					 
					linktotal = linkstart + link + linkend + linkcopy + linkcap;
						
					insertAtCursor(document.content.body_text,linktotal);					
                } 
        });

});