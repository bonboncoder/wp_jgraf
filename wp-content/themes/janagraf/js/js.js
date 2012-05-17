function swapImg(id, src, width, height)
{
	jQuery('#' + id).find('img').attr('src', src);
	jQuery('#' + id).find('img').attr('width', width);
	jQuery('#' + id).find('img').attr('height', height);
	return false;
}
