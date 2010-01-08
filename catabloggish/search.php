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

   <div class="attr"><?php if ($cat_institution_name = get_option('cat_institution_name')) echo $cat_institution_name = get_option('cat_institution_name'); else echo 'Institution Name'; ?></div><div class="subtitle">Search results for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' :: '); echo $count . ' '; _e('collections'); wp_reset_query(); ?></div>

<div class="navigation" id="pageturner">
<div class="alignright"><?php if(function_exists('wp_paginate')) { wp_paginate(); } ?></div>
</div>


<?php while (have_posts()) : the_post(); ?>

<div class="post">
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

<?php else : ?>

<p class="pagetitle">Sorry, your search came up empty.  Please try again:</p>

<p><?php include (TEMPLATEPATH . '/searchform.php'); ?></p>


<div style="margin-left:8em; color:#554e2f;"><?php if ( function_exists('spell_suggest') ) { spell_suggest(); } ?></div>

<?php endif; ?>

</div>

<?php get_footer(); ?>

</div>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl."
: "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-10132735-1");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
