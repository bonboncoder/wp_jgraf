<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php
$metaPage = get_page_by_title('meta');
$metaPageId = $metaPage->ID;
$metaDescriptions = get_post_custom_values('description', $metaPageId);
$metaDescription = '';
if (count($metaDescriptions) != 0) {
    foreach ($metaDescriptions as $keys => $values) {
        $metaDescription .= $values;
    }
}
$metaKeywords = get_post_custom_values('keywords', $metaPageId);
$metaKeyword = '';
if (count($metaKeywords) != 0) {
    foreach ($metaKeywords as $keys => $values) {
        $metaKeyword .= $values;
    }
}
?>
<meta name="description" content="<?php echo $metaDescription ?>" />
<meta name="keywords" content="<?php echo $metaKeyword ?>" />
<meta name="author" content="coder@bonbonbuero.de" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_enqueue_script('jquery'); ?>

<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/js.js"></script>

</head>
<body <?php body_class(); ?>>

    <noscript class="gg"><?php echo $metaDescription ?></noscript>

    <div id="page">
 
<!-- end header.php -->