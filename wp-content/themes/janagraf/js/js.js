var dur = 100;

jQuery(document).ready(function() {
    jQuery('#info').hide();
});

function slideHideInfo() {
	var iHeight = jQuery('#info').height();
	if (jQuery('#info').is(':hidden')) {		
		jQuery('#info').slideDown(dur);
		jQuery('#ct3').animate({
			top: '+=' + iHeight
		}, dur);
		jQuery('#cc3').animate({
			top: '+=' + iHeight 
		}, dur);
		jQuery('#ct4').animate({
			top: '+=' + iHeight
		}, dur);
		jQuery('#cc4').animate({
			top: '+=' + iHeight
		}, dur);
	} else {
		jQuery('#info').slideUp(dur);
		jQuery('#ct3').animate({
			top: '-=' + iHeight
		}, dur);
		jQuery('#cc3').animate({
			top: '-=' + iHeight 
		}, dur);
		jQuery('#ct4').animate({
			top: '-=' + iHeight
		}, dur);
		jQuery('#cc4').animate({
			top: '-=' + iHeight
		}, dur);
	}
	return false;
} 

function enlargeImg(id, medSrc, tWidth, tHeight, medWidth, medHeight, loaded) {
	//swap img src to src of medium sized img
	if (loaded) { //go here if medium image is already loaded
		//animate img resize to medium dimensions
		jQuery('#' + id).find('img').animate({
			height: medHeight,
			width: medWidth
		}, dur);
		//add new onclick function to reset the img size to thumb
		jQuery('#' + id).attr('onclick', 'return resetImg(\'' + id + '\', \'' + tWidth + '\', \'' + tHeight + '\', \'' + medWidth + '\', \'' + medHeight + '\');');
	} else { //go here on first enlargement and wait till medium img is loaded
		jQuery('#' + id).find('img').attr('src', medSrc).load(function() {
			jQuery('#' + id).find('img').animate({
				height: medHeight,
				width: medWidth
			}, dur);
			jQuery('#' + id).attr('onclick', 'return resetImg(\'' + id + '\', \'' + tWidth + '\', \'' + tHeight + '\', \'' + medWidth + '\', \'' + medHeight + '\');');
		});
	}
	return false;
}

function resetImg(id, tWidth, tHeight, medWidth, medHeight) {
	var medSrc = jQuery('#' + id).find('img').attr('src');
	//animate img resize to thumb dimension
	jQuery('#' + id).find('img').animate({
		height: tHeight,
		width: tWidth
	}, dur);
	//add new onclick function to enlarge the img
	jQuery('#' + id).attr('onclick', 'return enlargeImg(\'' + id + '\', \'' + medSrc + '\', \'' + tWidth + '\', \'' + tHeight + '\', \'' + medWidth + '\', \'' + medHeight + '\', true);');
	return false;
}