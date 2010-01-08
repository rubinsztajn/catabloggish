<ul id="sidebarleft">
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

 <li id="pages">
<h2>Pages</h2>
<ul>
<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
</ul>
 </li>

 <li id="categories">
 <h2>Categories</h2>
	<ul>
	<?php wp_list_cats(''); ?>
	</ul>
 </li>

 <li id="archives">
      <h2>Archives</h2>
 	<ul>
	 <?php wp_get_archives('type=monthly'); ?>
 	</ul>
 </li>
               
<?php endif; ?>
		</ul>