<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<?php wp_get_archives('type=monthly&format=link'); ?>

<?php wp_head(); ?>


<script src="http://www.library.umass.edu/spcoll/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="http://cdn.jquerytools.org/1.1.1/jquery.tools.min.js" type="text/javascript"></script>


<script type="text/javascript">
// perform JavaScript after the document is scriptable.
$(function() {
// setup ul.tabs to work as tabs for each div directly under div.panes
$("ul.tabs").tabs("div.panes > div");
});
</script>

</head>
<body>

<script type="text/javascript" src="http://static.delicious.com/js/playtagger.js"></script>

<div class="arise">
<?php if(is_home()) { ?>
<div id="blogmasthead" class="headerimage_home" style="background-image:url(<?php if ($cat_header_image = get_option('cat_header_image')) echo $cat_header_image = get_option('cat_header_image'); else echo 'http://www.library.umass.edu/spcoll/images/waugh423_950.jpg'; ?>);background-repeat:no-repeat;"></div>
<? }elseif(is_archive()) { ?>
<div id="blogmasthead" class="headerimage_archive" style="background-image:url(<?php if ($cat_header_image = get_option('cat_header_image')) echo $cat_header_image = get_option('cat_header_image'); else echo 'http://www.library.umass.edu/spcoll/images/waugh423_950.jpg'; ?>);background-repeat:no-repeat;"></div>
<? }elseif(is_single()) { ?>
<div id="blogmasthead" class="headerimage_single" style="background-image:url(<?php if ($cat_header_image = get_option('cat_header_image')) echo $cat_header_image = get_option('cat_header_image'); else echo 'http://www.library.umass.edu/spcoll/images/waugh423_950.jpg'; ?>);background-repeat:no-repeat;"></div>
<? }elseif(is_page()) { ?>
<div id="blogmasthead" class="headerimage_page" style="background-image:url(<?php if ($cat_header_image = get_option('cat_header_image')) echo $cat_header_image = get_option('cat_header_image'); else echo 'http://www.library.umass.edu/spcoll/images/waugh423_950.jpg'; ?>);background-repeat:no-repeat;"></div>
<? }elseif(is_search()) { ?>
<div id="blogmasthead" class="headerimage_searchresults" style="background-image:url(<?php if ($cat_header_image = get_option('cat_header_image')) echo $cat_header_image = get_option('cat_header_image'); else echo 'http://www.library.umass.edu/spcoll/images/waugh423_950.jpg'; ?>);background-repeat:no-repeat;"></div>
<? }else{ ?>
<div id="blogmasthead" class="headerimage_default" style="background-image:url(<?php if ($cat_header_image = get_option('cat_header_image')) echo $cat_header_image = get_option('cat_header_image'); else echo 'http://www.library.umass.edu/spcoll/images/waugh423_950.jpg'; ?>);background-repeat:no-repeat;"></div>
<? } //endif ?>
</div>

<div id="bluepanel">
<div class="blogname"><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a>
<?php if ($cat_institution_name = get_option('cat_institution_name') && $cat_institution_link = get_option('cat_institution_link')) {
?>
<span style="font-size:75%;"><a href="<?php echo $cat_institution_link; ?>">(<?php echo $cat_institution_name = get_option('cat_institution_name'); ?>)</a></span></div>
   <?php }elseif($cat_institution_name = get_option('cat_institution_name')) {?>
<span style="font-size:75%;">(<?php echo $cat_institution_name ; ?>)</span></div>
   <?php }else{ ?>
<span style="font-size:75%;"><a href="http://example.com/institution/homepage/">My Institution</a></span></div>
   <?php } bloginfo('description'); ?>
</div>


