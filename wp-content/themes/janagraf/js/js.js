jQuery(document).ready(function() {
    jQuery('#info').hide();
});

function slideHideInfo() {
	var iHeight = jQuery('#info').height();
	if (jQuery('#info').is(':hidden')) {		
		jQuery('#info').slideDown(1000);
		jQuery('#ct2').animate({
			top: '+=' + iHeight
		}, 1000);
		jQuery('#cc2').animate({
			top: '+=' + iHeight
		}, 1000);
		jQuery('#ct3').animate({
			top: '+=' + iHeight
		}, 1000);
		jQuery('#cc3').animate({
			top: '+=' + iHeight 
		}, 1000);
	} else {
		jQuery('#info').slideUp(1000);
		jQuery('#ct2').animate({
			top: '-=' + iHeight
		}, 1000);
		jQuery('#cc2').animate({
			top: '-=' + iHeight
		}, 1000);
		jQuery('#ct3').animate({
			top: '-=' + iHeight
		}, 1000);
		jQuery('#cc3').animate({
			top: '-=' + iHeight 
		}, 1000);
	}
	return false;
} 

function enlargeImg(id, src, tWidth, tHeight, medWidth, medHeight) {
	//swap img src to src of medium sized img
	jQuery('#' + id).find('img').attr('src', src).load(function() {
		//animate img resize to medium dimensions
		jQuery('#' + id).find('img').animate({
			height: medHeight,
			width: medWidth
		}, 1000);
		//add new onclick function to reset the img size to thumb
		jQuery('#' + id).attr('onclick', 'return resetImg(\'' + id + '\', \'' + tWidth + '\', \'' + tHeight + '\', \'' + medWidth + '\', \'' + medHeight + '\');');

/*	// test for repositioning neighbors	
		jQuery('*[id*=img]').find('img').each(function() {
			if ((jQuery(this).offset().top >= jQuery('#' + id).offset().top
					|| (jQuery(this).offset().top + jQuery(this).height() >= jQuery('#' + id).offset().top))
					&& jQuery(this).offset().left >= jQuery('#' + id).offset().left + parseInt(tWidth)) {
				jQuery(this).hide();
			}
	    });
*/	
	
	
	});
	return false;
}

function resetImg(id, tWidth, tHeight, medWidth, medHeight) {
	var src = jQuery('#' + id).find('img').attr('src');
	//add new onclick function to enlarge the img
	jQuery('#' + id).attr('onclick', 'return enlargeImg(\'' + id + '\', \'' + src + '\', \'' + tWidth + '\', \'' + tHeight + '\', \'' + medWidth + '\', \'' + medHeight + '\');');
	//animate img resize to thumb dimension
	jQuery('#' + id).find('img').animate({
		height: tHeight,
		width: tWidth
	}, 1000);
	return false;
}