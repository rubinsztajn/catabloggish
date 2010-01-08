<?php get_header(); ?>
<div id="container" class="clearfix">

<div id="leftnav">
<?php get_sidebar(); ?>
</div>
<div id="rightnav">
<?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div>


<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
   <div class="attr"><?php if ($cat_institution_name = get_option('cat_institution_name')) echo $cat_institution_name = get_option('cat_institution_name'); else echo 'Institution Name'; ?></div><div class="subtitle"><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4b1ab79963151b13"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" alt="Bookmark and Share" style="border:0; vertical-align:middle; height:13px; float:right;"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4b1ab79963151b13"></script><?php the_title(); ?></div>

<div class="entry">
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
</div>
</div>

<?php endwhile; endif; ?>

<div style="float:right; clear:both;"><?php edit_post_link('[ Edit ]', '<p>', '</p>'); ?></div>

<?php comments_template(); ?>
</div>


<?php get_footer(); ?>
</div>

</body>
</html>