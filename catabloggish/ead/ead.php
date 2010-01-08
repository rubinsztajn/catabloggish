<?php

/** 
Import EAD files, save them to the uploads folder, and insert html content into a post 
**/

add_action('admin_menu', 'ead_menu');


// Retrieve and process options.
function ead_menu() {
    if ( $_GET['page'] ==  'ead') {
	  if ( 'save' == $_REQUEST['action'] ) {
	    if ($_FILES) {
	      $f = ead_upload_file($_FILES);
	      if ( $f['error'] ) {
		update_option( 'ead-error', $f['error'] );
		header("Location: edit.php?page=ead.php&error=true");
		die;
	      } else {
	         update_option( 'ead-title', $_REQUEST['ead-title' ] );
		 update_option( 'ead-file', $f['file' ] );
		 header("Location: edit.php?page=ead.php&saved=true");
		 die;
	      }
	    }
	  }
  } 
  add_posts_page('Import EAD', 'Import EAD', 'manage_options', 'ead', 'ead_options');
}

add_filter('upload_mimes', 'ead_xml_mime');

// Add text/xml mime type to list of allowable uploads
function ead_xml_mime() {
  $mimes['xml'] = 'text/xml';
  return $mimes;
}

// Upload file
function ead_upload_file($fileinfo) {
  if ($fileinfo['ead-file']['name'] != '') {
    $file = file_get_contents($fileinfo['ead-file']['tmp_name']);
    $uploadinfo = wp_upload_bits($fileinfo['ead-file']['name'], null, $file);
    return $uploadinfo;
  }
}

// Layout options page
function ead_options() {
  
  if ( $_REQUEST['error'] ) {
    echo '<div id="message" class="error"><p><strong>' . get_option('ead-error') . '</strong></p></div>';
  } elseif ( $_REQUEST['saved'] ) {
    $id = ead_create_post();
    if ( $id ) {
      $view_url = get_bloginfo('url') . '/?p=' . $id;
      $edit_url = get_bloginfo('url') . '/wp-admin/post.php?action=edit&post=' . $id;
      echo '<div id="message" class="updated fade"><p><strong>Collection posted&nbsp;  <a href="' . $view_url . '">View</a> :: <a href="' . $edit_url . '">Edit</a></strong></p></div>';
    } else {
      echo '<div id="message" class="updated fade"><p><strong>Oops... Something went wrong when creating the post</strong></p></div>';
    }
  }

  ?>
  <div class="wrap">
  <div id="icon-edit" class="icon32">
    <br />
  </div>

  <h2>Import EAD File</h2>

  <div class="form-wrap">

  <form method="post" enctype="multipart/form-data">
  
    <div class="form-field">
      <label for="ead-title">Collection title:</label>
      <input style="width:500px;" name="ead-title" id="ead-title" type="text" />
      <p>Enter a title for your collection.</p>
    </div>

    <div class="form-field">
      <div id="upload">
      <label for="ead-file">Upload EAD/XML file:</label>
      <input id="ead-upload" type="file" name="ead-file" id="ead-file" />
      <p>Browse to an EAD/XML file to upload.  Must be valid EAD with an ".xml" extension.  A copy of the original EAD file will be saved to your uploads folder.</p>
     </div>
    </div>
    <p class="submit">
      <input name="save" type="submit" value="Post" />
      <input type="hidden" name="action" value="save" />
    </p>
</form>
</div>
</div>
<?php
}



// Create post from xslt output
function ead_create_post() {

  $filepath = get_option('ead-file');
  $title = get_option('ead-title');

  // Post object
  $my_post = array();
  $my_post['post_title'] = $title;
  $my_post['post_content'] = ead_transform($filepath) ;
  $my_post['post_status'] = 'publish';

  // Insert the post into the database
  $id = wp_insert_post( $my_post );
  return $id;
}


// Transform EAD/XML to WordPress post HTML
function ead_transform($file) {

  $xml_file = simplexml_load_file($file);
  $ead = $xml_file->asXML();
  $xslt = new XSLTProcessor();
  $xsl = new DOMDocument;
  $xslt_path = TEMPLATEPATH . '/ead/xslt/catablog_ead.xsl';
  $xsl->load($xslt_path);
  $xslt->importStyleSheet($xsl);
 
  $xml = new DOMDocument;
  $xml->loadXML($ead);
  $result = $xslt->transformToXML($xml);
  
  return $result;
}



?>