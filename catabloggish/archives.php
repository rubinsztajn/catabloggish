<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
  <div id="container" class="clearfix">
   <div id="leftnav">
	  <?php get_sidebar(); ?>
    </div>
    <div id="rightnav">
	  <?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div>
<div id="content">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<h2>Archives by Month:</h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>

<h2>Archives by Subject:</h2>
  <ul>
     <?php wp_list_cats(); ?>
  </ul>
</div>

<?php get_footer(); ?>
</div>	