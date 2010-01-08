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

<div class="posttitle"><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4b1ab79963151b13"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" alt="Bookmark and Share" style="border:0; vertical-align:middle; height:13px; float:right;"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4b1ab79963151b13"></script><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></div>

<div class="entry">
<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
</div>
</div>

<p class="postmetadata alt">

<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Both Comments and Pings are open ?>
You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> from your own site.

<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Only Pings are Open ?>
Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.

<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Comments are open, Pings are not ?>
You can skip to the end and leave a response. Pinging is currently not allowed.

<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Neither Comments, nor Pings are open ?>
Both comments and pings are currently closed.

<?php } edit_post_link('[ Edit ]','',''); ?></p>

<div class="navigation" style="padding-bottom:20px;">.</div>

<?php comments_template(); ?>

<?php endwhile; else: ?>

<p>Sorry, no posts matched your criteria.</p>

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
