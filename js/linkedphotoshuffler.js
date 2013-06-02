
  //
  // CSS Linked Photo Shuffler v1.1 by
  //   Carl Camera
  //   http://iamacamera.org 
  //
  // SetOpacity Function and inpiration from Photo Fade by
  //   Richard Rutter
  //   http://clagnut.com
  //
  // License: Creative Commons Attribution 2.5  License
  //   http://creativecommons.org/licenses/by/2.5/
  //

  // Customize your photo shuffle settings
  // 
  // * Surround the target <img /> with an anchor <a> and <div>. 
  //   specify unique id= in all three
  // * The first and final photo displayed is in the html <img> tag
  // * The image array contains paths to photos you want in the rotation. 
  //   If you want the first photo in the rotation, then it's best to
  //   put it as the final array image.  All photos must be same dimension
  // * The Href array contains the link you want associated with each image
  //   each image must have a corresponding link.
  // * The rotations variable specifies how many times to repeat array.
  //   images. zero is a valid rotation value.

  var gblPhotoShufflerDivId = "photodiv";
  var gblPhotoShufflerImgId = "photoimg";
  var gblPhotoShufflerAnchorId = "photoanchor";
  var gblImg = new Array(
    "http://static.flickr.com/44/110860008_3086e0bce5.jpg?v=0",
    "http://static.flickr.com/53/149069166_3311afe82d.jpg?v=0",
    "http://static.flickr.com/44/149069119_1080dfd3ef.jpg?v=0"
    );
  var gblHref = new Array(
    "http://google.com",
    "javascript:alert('long way down');",
    "http://iamacamera.org"
    );
  var gblPauseSeconds = 7.25;
  var gblFadeSeconds = .85;
  var gblRotations = 1;

  // End Customization section
  
  var gblDeckSize = gblImg.length;
  var gblOpacity = 100;
  var gblOnDeck = 0;
  var gblStartImg;
  var gblStartHref;
  var gblImageRotations = gblDeckSize * (gblRotations+1);

  window.onload = photoShufflerLaunch;
  
  function photoShufflerLaunch()
  {
  	var theimg = document.getElementById(gblPhotoShufflerImgId);
        gblStartImg = theimg.src; // save away to show as final image
  	var theanchor = document.getElementById(gblPhotoShufflerAnchorId);
        gblStartHref = theimg.href; // save away to show as final image

	document.getElementById(gblPhotoShufflerDivId).style.backgroundImage='url(' + gblImg[gblOnDeck] + ')';
	setTimeout("photoShufflerFade()",gblPauseSeconds*1000);
  }

  function photoShufflerFade()
  {
  	var theimg = document.getElementById(gblPhotoShufflerImgId);
	
  	// determine delta based on number of fade seconds
	// the slower the fade the more increments needed
        var fadeDelta = 100 / (30 * gblFadeSeconds);

	// fade top out to reveal bottom image
	if (gblOpacity < 2*fadeDelta ) 
	{
	  gblOpacity = 100;
	  // stop the rotation if we're done
	  if (gblImageRotations < 1) return;
	  photoShufflerShuffle();
	  // pause before next fade
          setTimeout("photoShufflerFade()",gblPauseSeconds*1000);
	}
	else
	{
	  gblOpacity -= fadeDelta;
	  setOpacity(theimg,gblOpacity);
	  setTimeout("photoShufflerFade()",30);  // 1/30th of a second
	}
  }

  function photoShufflerShuffle()
  {
	var thediv = document.getElementById(gblPhotoShufflerDivId);
	var theimg = document.getElementById(gblPhotoShufflerImgId);
	var theanchor = document.getElementById(gblPhotoShufflerAnchorId);
	
	// copy div background-image to img.src
	theimg.src = gblImg[gblOnDeck];
	theanchor.href = gblHref[gblOnDeck];
	window.status = gblHref[gblOnDeck]; // updates status bar (optional)
	// set img opacity to 100
	setOpacity(theimg,100);

        // shuffle the deck
	gblOnDeck = ++gblOnDeck % gblDeckSize;
	// decrement rotation counter
	if (--gblImageRotations < 1)
	{
	  // insert start/final image if we're done
	  gblImg[gblOnDeck] = gblStartImg;
	  gblHref[gblOnDeck] = gblStartHref;
	}

	// slide next image underneath
	thediv.style.backgroundImage='url(' + gblImg[gblOnDeck] + ')';
  }

function setOpacity(obj, opacity) {
  opacity = (opacity == 100)?99.999:opacity;
  
  // IE/Win
  obj.style.filter = "alpha(opacity:"+opacity+")";
  
  // Safari<1.2, Konqueror
  obj.style.KHTMLOpacity = opacity/100;

  // Older Mozilla and Firefox
  obj.style.MozOpacity = opacity/100;

  // Safari 1.2, newer Firefox and Mozilla, CSS3
  obj.style.opacity = opacity/100;
}


