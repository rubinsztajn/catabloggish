
<div id="footwrap">

<a href="<?php if ($cat_institution_link = get_option('cat_institution_link')) echo $cat_institution_link = get_option('cat_institution_link'); else echo 'http://example.com/institution/homepage'; ?>"><img src="<?php if ($cat_institution_icon = get_option('cat_institution_icon')) echo $cat_institution_icon = get_option('cat_institution_icon'); ?>" alt="" style="float:left; vertical-align:bottom; position:relative; top:-20px;" /></a>
<div class="footertext">
<?php if ($cat_institution_name = get_option('cat_institution_name') && $cat_institution_link = get_option('cat_institution_link')) {
?>
<span class="repository_footer"><a href="<?php echo $cat_institution_link; ?>" title="<?php echo $cat_institution_name = get_option('cat_institution_name'); ?>"><?php echo $cat_institution_name = get_option('cat_institution_name'); ?></a></span>
<?php }elseif($cat_institution_name = get_option('cat_institution_name')) {?>
<span class="repository_footer"><?php echo $cat_institution_name = get_option('cat_institution_name'); ?></span>
<?php }else { ?>
<span class="repository_footer"><a href="http://example.com/institution/homepage" title="Institution Name">Institution Name</a></span>
   <?php } ?>      	    
               <span class="addressline_footer"></span> &copy; <?php echo date('Y'); ?><div style="text-align:right; margin-right:4.5em;"><a href="http://www.wordpress.org">Wordpress</a></div>
</div>
</div>




<?php wp_footer(); ?>
