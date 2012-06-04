<span id="info_line">Jana Graf Jewellery <a href="mailto:post@janagraf.com">post@janagraf.com</a> (+49)0221.54813483</span> <span id="info_link"><a href="#" onclick="return slideHideInfo();">Info</a></span>
<div id="info">
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