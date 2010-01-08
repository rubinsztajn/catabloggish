<?php

/* Register sidebars */

if ( function_exists('register_sidebars') )
    register_sidebars(2);

require_once('ead/ead.php');

/* Theme Options Page */

/* Set theme information and options here */
$themename = "Catabloggish";
$shortname = "cat";
$options = array (

        array(	"name" => "Custom header image",
			"type" => "heading"),

	array(	"name" => "Path to custom header image",
			"desc" => "Enter the path to your custom header image.  Header image should be 950 x 130px.",
			"id" => $shortname."_header_image",
	                "std" => "http://www.library.umass.edu/spcoll/images/waugh244_950.jpg", 
			"type" => "text"),

	array(	"name" => "Institution information",
			"type" => "heading"),

	array(	"name" => "Institution Name",
			"desc" => "Add institution name to the header",
			"id" => $shortname."_institution_name",
	                "std" => "Institution Name", 
			"type" => "text"),

        array( "name" => "Institution Icon",
	               "desc" => "Enter the path to your institution's icon",
			"id" => $shortname."_institution_icon",
	                "std" => "http://www.library.umass.edu/spcoll/images/sealumass50.gif",
			"type" => "text"),

	array(	"name" => "Institution Home Page",
			"desc" => "Link your institution name to your institution's home page",
			"id" => $shortname."_institution_link",
	                "std" => "http://example.com/institution/homepage",
			"type" => "text"),
   	
);

/* Create theme options page */
function cat_add_admin() {
	global $themename, $shortname, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
	  if ( 'save' == $_REQUEST['action'] ) {
	    foreach ($options as $value) {
	      update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
	    }
	    foreach ($options as $value) {
	      if( isset( $_REQUEST[ $value['id'] ] ) ) { 
		update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
	      } else { 
		delete_option( $value['id'] ); 
	      } 
	    }
	    header("Location: themes.php?page=functions.php&saved=true");
	    die;
	  } else if( 'reset' == $_REQUEST['action'] ) {
	    foreach ($options as $value) {
	      delete_option( $value['id'] ); 
	    }
       
	    header("Location: themes.php?page=functions.php&reset=true");
	    die;
	  }
	}
	add_theme_page($themename." Options", $themename." Options", 'edit_themes', basename(__FILE__), 'cat_admin');
}

/* Define layout for options page */
function cat_admin() {
  global $themename, $shortname, $options;

  if ( $_REQUEST['saved'] ) {
    echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
  }  
  if ( $_REQUEST['reset'] ) {
    echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
  }
  
?>
<div class="form-wrap">
  <h2><?php echo $themename; ?> settings</h2>
  <form method="post">
      <?php 
    foreach ($options as $value) {
      if ($value['type'] == "text") {

	/* Text Box */
      ?>

    <div class="form-field">
      <label for="<?php echo $value['id'] ?>"><?php echo $value['name']; ?>:</label>
      <input style="width:500px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
      <p><?php echo $value['desc']; ?></p>
    </div>  
    
     <?php } elseif ($value['type'] == "textarea") {  

      /* Textarea */
     ?>


    <div class="form-field">
      <label for="<?php echo $value['id'] ?>"><?php echo $value['name']; ?>:</label>
      <textarea style="width:500px;height:100px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" ><?php
	if( get_option($value['id']) != "") {
	  echo stripslashes(get_option($value['id']));
	} else {
	  echo $value['std'];
	}?></textarea>
      <p><?php echo $value['desc']; ?></p>
    </div>  

    <?php } elseif ($value['type'] == "checkbox") {  

      /* Checkbox */  
    ?>
	
    <div class="form-field">
      <label for="<?php echo $value['id'] ?>"><?php echo $value['name']; ?>:</label>
      <?php if(get_option($value['id'])){
                 $checked = "checked=\"checked\"";
	    } else {
		 $checked = "";
	    }
      ?>
      <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
      <p><?php echo $value['desc']; ?></p>
    </div>  

     <?php } elseif ($value['type'] == "radio") {
      /* Radio button */
      ?>
      <div class="form-field">
        <label for="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></label>
        <?php if(get_option($value['id'])){
                 $checked = "checked=\"checked\"";
	    } else {
		 $checked = "";
	    }
         ?> 
         <input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
       </div>  

     <?php } elseif ($value['type'] == "heading") { 
      
      /* Option category heading */
     ?>
      <h3><?php echo $value['name']; ?></h3>
 

<?php
      }
}
?>
<br />

<p class="submit">
  <input name="save" type="submit" value="Save changes" />
  <input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
  <p class="submit">
    <input name="reset" type="submit" value="Reset" />
    <input type="hidden" name="action" value="reset" />
  </p>
</form>
</div>
<?php
}
add_action('admin_menu', 'cat_add_admin');

/* Contact widget */

add_action('widgets_init', 'contact_load_widgets');

function contact_load_widgets() {
  register_widget('Contact_Widget');
}
 
class Contact_Widget extends WP_Widget {
  
  function Contact_Widget() {
    /* Widget settings */
    $widget_ops = array('classname' => 'contact',
		  'description' => 'Displays an archive\'s contact information.',
		  );

    /* Widget control settings */
    $control_ops = array('width' => 300,
		         'height' => 350,
		         'id_base' => 'contact-widget',
		   );

    /* Create widget */
    $this->WP_Widget('contact-widget', 'Contact', $widget_ops, $control_opts);

  }

  function widget($args, $instance) {
    extract($args);
    
    /* User settings */
    $title = apply_filters('widget-title', $instance['title']);
    $institution_name = $instance['institution_name'];
    $addr1 = $instance['addr1'];
    $addr2 = $instance['addr2'];
    $addr3 = $instance['addr3'];
    $city = $instance['city'];
    $state = $instance['state'];
    $zip = $instance['zip'];
    $phone = $instance['phone'];
    $fax = $instance['fax'];
    $email = $instance['email'];

    /* Defined by themes */
    echo $before_widget;


    /* Widget layout */
    if ($title)
      echo $before_title . $title . $after_title;

    if ($institution_name)

?>
    <div style="border-top: 1px solid rgb(187, 187, 187); border-bottom: 1px solid rgb(187, 187, 187); clear: both; color: rgb(69, 39, 34); font-size: 107%; margin-left: 1em; padding-left: 5px; padding-top: 3px; padding-bottom: 5px;"><?php echo $institution_name; ?></div>

<?php 
    $addr = array($addr1, $addr2, $addr3);

    if ($addr) 
      ?>
       <div style="margin-left: 1.5em; font-size: 92%; color: rgb(71, 73, 68); padding-top: 4px; clear: both;">
      <?php
       foreach ($addr as $addr_line) {
	 if ($addr_line) 
	   echo $addr_line . '<br />';
       
      }
      
    if ($city && $state && $zip)
      echo $city . ', ' . $state . ' ' . $zip;
    ?>
    <div style="margin-left: 1.5em; padding-top: 5px; padding-bottom: 6px;">
    <?php
    if ($phone) 
      echo 'Ph: ' . $phone . '<br />';
    
    if ($fax) 
      echo 'Fax: ' . $fax;
    
    if ($email)
      ?>
      <p style="padding-top: 4px;"><a href="mailto:<?php echo $email; ?>">EMAIL</a></p></div></div>
    <?php
    /* After widget -- defined by theme */
    echo $after_widget;
		  
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    
    /* Strip html and update settings */
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['institution_name'] = strip_tags($new_instance['institution_name']);
    $instance['addr1'] = strip_tags($new_instance['addr1']);
    $instance['addr2'] = strip_tags($new_instance['addr2']);
    $instance['addr3'] = strip_tags($new_instance['addr3']);
    $instance['city'] = strip_tags($new_instance['city']);
    $instance['state'] = strip_tags($new_instance['state']);
    $instance['zip'] = strip_tags($new_instance['zip']);
    $instance['phone'] = strip_tags($new_instance['phone']);
    $instance['fax'] = strip_tags($new_instance['fax']);
    $instance['email'] = strip_tags($new_instance['email']);
				    
    return $instance;
  }

  function form($instance) {

    $defaults = array('title' => 'Contact',
                'institution_name' => 'Institution Name',
		'addr1' => 'Address 1',
		'addr2' => 'Address 2',
		'addr3' => 'Address 3',
		'city' => 'City',
		'state' => 'AL',
		'zip' => 'Zipcode',
		'phone' => 'Phone number',
		'fax' => 'Fax number',
		'email' => 'Email address',
		);

    $instance = wp_parse_args((array) $instance, $defaults);
?>

<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'institution_name' ); ?>">Institution Name:</label>
    <input id="<?php echo $this->get_field_id( 'institution_name' ); ?>" name="<?php echo $this->get_field_name( 'institution_name' ); ?>" value="<?php echo $instance['institution_name']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'addr1' ); ?>">Address 1:</label>
    <input id="<?php echo $this->get_field_id( 'addr1' ); ?>" name="<?php echo $this->get_field_name( 'addr1' ); ?>" value="<?php echo $instance['addr1']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'addr2' ); ?>">Address 2:</label>
    <input id="<?php echo $this->get_field_id( 'addr2' ); ?>" name="<?php echo $this->get_field_name( 'addr2' ); ?>" value="<?php echo $instance['addr2']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'addr3' ); ?>">Address 3:</label>
    <input id="<?php echo $this->get_field_id( 'addr3' ); ?>" name="<?php echo $this->get_field_name( 'addr3' ); ?>" value="<?php echo $instance['addr3']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'city' ); ?>">City:</label>
    <input id="<?php echo $this->get_field_id( 'city' ); ?>" name="<?php echo $this->get_field_name( 'city' ); ?>" value="<?php echo $instance['city']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'state' ); ?>">State:</label>
    <input id="<?php echo $this->get_field_id( 'state' ); ?>" name="<?php echo $this->get_field_name( 'state' ); ?>" value="<?php echo $instance['state']; ?>" size="2" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'zip' ); ?>">Zipcode:</label>
    <input id="<?php echo $this->get_field_id( 'zip' ); ?>" name="<?php echo $this->get_field_name( 'zip' ); ?>" value="<?php echo $instance['zip']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'phone' ); ?>">Phone:</label>
    <input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'fax' ); ?>">Fax:</label>
    <input id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
    <input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
</p>

<?php
  }
}
?>