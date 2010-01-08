<?php
/*
Template Name: Links
*/
?>
  <div id="container" class="clearfix">

	  <?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div>
<div id="content">

<h2>Links:</h2>
<ul>
<?php get_links_list(); ?>
</ul>

</div>	
<div id="rightnav">
	  <?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div>
    <div id="leftnav">
	  <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
</body>
</html>