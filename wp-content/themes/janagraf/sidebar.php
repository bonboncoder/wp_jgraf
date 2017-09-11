<span id="info-line"><?php bloginfo( 'name' ); ?> <span id="m">postatjanagrafcom</span> (+49)0221.26062401</span> <span id="info-link"><a href="#" onclick="return slideHideInfo();">Info</a></span>
<div id="info">
	<h4>If you are interested in a product drop me a line!</h4>
<?php
	$galerie_post = get_posts('category=21&numberposts=1');
	foreach ($galerie_post as $gal) : setup_postdata($gal);
		the_content();
	endforeach;
?>
	<h1>Jana Graf</h1>
	<h3>born 1986</h3>
<?php
	$info_post = get_posts('category=11&numberposts=1');
	foreach ($info_post as $info) : setup_postdata($info);
		the_content();
	endforeach;
?>
	<h2>Exhibitions:</h2>
<?php
	$exhi_post = get_posts('category=12&numberposts=1');
	foreach ($exhi_post as $exhi) : setup_postdata($exhi);
		the_content();
	endforeach;
?>
</div>
