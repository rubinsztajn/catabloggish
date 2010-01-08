<?php get_header(); ?>
<div id="container" class="clearfix">

<div id="leftnav">
<?php get_sidebar(); ?>
</div>

<div id="rightnav">
<?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div>


<div id="content">

<?php $posts = query_posts($query_string . '&orderby=title&order=asc&posts_per_page=10'); if (have_posts()) : ?>

   <?php $post = $posts[0]; /* Hack. Set $post so that the_date() works.*/ ?>

   <div class="attr"><?php if ($cat_institution_name = get_option('cat_institution_name')) echo $cat_institution_name = get_option('cat_institution_name');  else  echo 'Institution Name'; ?></div>

<div class="subtitle">
<?php /* If this is a category archive */ if (is_category()) { ?>
<?php echo single_cat_title(); ?> :: <?php echo ''. $wp_query->found_posts; ?> collections

<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<?php the_time('F jS, Y'); ?> :: <?php echo ''. $wp_query->found_posts; ?> collections

<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<?php the_time('F, Y'); ?> :: <?php echo ''. $wp_query->found_posts; ?> collections

<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<?php the_time('Y'); ?> :: <?php echo ''. $wp_query->found_posts; ?> collections

<?php /* If this is a search */ } elseif (is_tag()) { ?>
<?php echo single_tag_title(); ?> :: <?php if ($wp_query->found_posts == 1) echo ''. $wp_query->found_posts . ' collection'; elseif ($wp_query->found_posts > 1) echo ''. $wp_query->found_posts . ' collections'; ?> 

<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h4 class="pagetitle">Author Archive</h4>

<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h4 class="pagetitle">Catablog Entries</h4>

<?php } ?>
</div>


<div class="navigation" id="pageturner">
<div class="alignright"><?php if(function_exists('wp_paginate')) { wp_paginate(); } ?></div>
</div>

<?php while (have_posts()) : the_post(); ?>


<div class="post" id="post-<?php the_ID(); ?>" style="padding-top:0.1em; margin-top:0.1em;">

<div class="posttitle"><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4b1ab79963151b13"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" alt="Bookmark and Share" style="border:0; vertical-align:middle; height:13px; float:right;"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4b1ab79963151b13"></script><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>

<div class="entry">
<?php the_content('') ?>
</div>

<p class="postmetadata">Categories: <?php the_category(', ') ?> :: <?php edit_post_link('[ Edit ]',' ',''); ?> :: <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></p> 

</div>

<?php endwhile; ?>

<div class="navigation">
<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
<div class="alignright"><?php next_posts_link('Next Entries &raquo;') ?></div>
</div>

<div style="clear:both; color:#fefefe;">.</div>
<?php else : ?>
<h4 class="center">Not Found</h4>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
<?php endif; ?>
</div>


<?php get_footer(); ?>

</div>
</body>
</html>
