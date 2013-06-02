/*
	imagegallery.js for mootools v1.2
	by Devin Ross (http://www.tutorialdog.com) - MIT-style license
*/

window.addEvent('domready', function()
{
	var drop = $('large');
	var dropFx = drop.effect('background-color', {wait: false}); // wait is needed so that to toggle the effect
	var fx = drop.effects({duration:300, transition: Fx.Transitions.linear});
	 
	$$('.item').each(function(item)
	{
		item.addEvent('click', function(e)
		{
			drop.removeEvents();
			drop.empty();
			var a = item.clone();
			
			fx.start({ 'opacity' : 0 // Fade out large view
					}).chain(function(){
						a.inject(drop);
						// Fade in new image										
						this.start.delay(0, this, {
							'opacity': 1
						});
					
					});			
		});
	 
	});
});