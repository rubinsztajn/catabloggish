<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="searchform" />
<input type="submit" class="searchformbutton" id="searchsubmit" value="Search" />
</form>
