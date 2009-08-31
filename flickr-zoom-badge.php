<?php
/*
Plugin Name: Flickr Zoom Badge
Plugin URI: http://www.mfd-consult.dk/flickr-zoom-badge/
Description: Show photos from Flickr based on user and/or tag(s), with zoom effect without using Flash.
Version: 1.0
Author: Morten Høybye Frederiksen
Author URI: http://www.wasab.dk/morten/
License: GPL
*/

define('flickr_zoom_badge_size', 63);
define('flickr_zoom_badge_count', 3);

function flickr_zoom_badge_header() {
	echo '
<style type="text/css">
.flickr_zoom_badge { width: ' . ((flickr_zoom_badge_size + 1) * flickr_zoom_badge_count) . 'px;}
.flickr_badge_image { float: left; padding: 0; margin: 0; overflow: visible; position: relative; top: 0; left: 0; height: '.(flickr_zoom_badge_size+1).'px; width: '.(flickr_zoom_badge_size+1).'px }
.flickr_badge_image img { padding: 0; margin: 0; border: none; position: relative; top: 0px; left: 0px }
</style>

<script type="text/javascript">

var small = '.flickr_zoom_badge_size.';
var sidesize = '.flickr_zoom_badge_count.';

var large = small * 2 + 1;
var step = Math.ceil(small/50);
var image = null;
	
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != "function") {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

function flickr_animate_init() {
	if (!(wrapper=document.getElementById("flickr_badge_uber_wrapper")))
		return;
	wrapper.style.width = ((small + 1) * sidesize) + "px";
  for (i=1; i<=(sidesize*sidesize); i++) {
		if (!(div=document.getElementById("flickr_badge_image" + i)))
			return;
		div.style.width = small + 1;
		div.style.height = small + 1;
		div.style.zIndex = 1;
		if (!(img = div.firstChild.firstChild))
			return;
		img.width = small;
		img.height = small;
	}
  setTimeout(flickr_animate_begin, 1000);
}

function flickr_animate_begin() {
	// Select a random image
	i = Math.ceil(Math.random() * sidesize * sidesize);
	if (!(div=document.getElementById("flickr_badge_image" + i)))
		return;
	if (!(img = div.firstChild.firstChild))
		return;
	// Bring div to foreground, make larger...
	div.style.zIndex = 2;
	image = i;
	size = small;
  setTimeout(flickr_animate_larger, 1);
}

function flickr_animate_larger() {
	if (size < large) {
		size = size + step;
		flickr_animate_set();
	  setTimeout(flickr_animate_larger, 40);
		return;
	}
	size = large;
	flickr_animate_set();
  setTimeout(flickr_animate_smaller, 500);
}

function flickr_animate_smaller() {
	if (size > small + 3) {
		size = size - 3;
		flickr_animate_set();
	  setTimeout(flickr_animate_smaller, 0);
		return;
	}
	div.style.zIndex = 1;
	size = small;
	flickr_animate_set();
  setTimeout(flickr_animate_begin, 1000);
}

function flickr_animate_set() {
	if (!image)
		return;
	if (!(div=document.getElementById("flickr_badge_image" + image)))
		return;
	if (!(img = div.firstChild.firstChild))
		return;
	if (image==sidesize || image==(sidesize*2) || image==(sidesize*3) || image==(sidesize*4)) {
		img.style.left = (0 - size + small) + "px";
	}
	if (image>(sidesize*(sidesize-1))) {
		img.style.top = (0 - size + small) + "px";
	}
	img.width = size;
	img.height = size;
}

addLoadEvent(flickr_animate_init);
</script>	
';
}

function flickr_zoom_badge($args) {
	extract($args);
	$options = get_option('flickr_zoom_badge');
	$title = $options['title'];
	$user = $options['user'];
	$tags = join('+', $options['tags']);
	$tagstitle = join(' & ', $options['tags']);
	if (!empty($user)) {
	  $source = 'user=' . urlencode($user) . '&amp;source=user';
	  $link = 'http://www.flickr.com/photos/' . $user . '/';
	  if (!empty($tags)) {
	    $source .= '_tag&amp;tag=' . $tags;
	    $link .= 'tags/' . $tags;
	  }
	} elseif (!empty($tags)) {
    $source = 'source=all_tag&amp;tag=' . $tags;
    $link = 'http://www.flickr.com/photos/tags/' . $tags;
  } else
	  return;
	echo $before_widget . $before_title . '<a href="' . $link . '">' . $title . '</a>' . $after_title;
	echo '<div id="flickr_badge_uber_wrapper">
<div id="flickr_badge_wrapper">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.(flickr_zoom_badge_count*flickr_zoom_badge_count).'&amp;display=random&amp;size=s&amp;layout=x&amp;'.$source.'">
	</script>
</div>
<div style="clear: left"> </div>
</div>';
	echo $after_widget;
}

function flickr_zoom_badge_control() {
	$options = get_option('flickr_zoom_badge');
	if ( !is_array($options) )
		$options = array('title'=>'', 'tags'=>array());
	if ( $_POST['flickr_zoom_badge-submit'] ) {
		$options['title'] = strip_tags(stripslashes($_POST['flickr_zoom_badge-title']));
		$options['user'] = strip_tags(stripslashes($_POST['flickr_zoom_badge-user']));
		$options['tags'] = array_map(trim, preg_split('/\s*,\s*/', strip_tags(stripslashes($_POST['flickr_zoom_badge-tags'])), -1, PREG_SPLIT_NO_EMPTY));
		update_option('flickr_zoom_badge', $options);
	}
	$title = htmlspecialchars($options['title'], ENT_QUOTES);
	$user = htmlspecialchars($options['user'], ENT_QUOTES);
	$tags = htmlspecialchars(join(', ', $options['tags']), ENT_QUOTES);
	?>
	<label for="flickr_zoom_badge-title" style="line-height:35px;display:block;"><?php _e('Title', 'flickr-zoom-badge'); ?></label><input style="width: 200px;" id="flickr_zoom_badge-title" name="flickr_zoom_badge-title" type="text" value="<?php echo $title; ?>" />
  <label for="flickr_zoom_badge-title" style="line-height:35px;display:block;"><?php _e('Flickr ID', 'flickr-zoom-badge'); ?></label><input style="width: 200px;" id="flickr_zoom_badge-user" name="flickr_zoom_badge-user" type="text" value="<?php echo $user; ?>" />
	<label for="flickr_zoom_badge-tags" style="line-height:35px;display:block;"><?php _e('Tags (separated by commas)', 'flickr-zoom-badge'); ?></label><input style="width: 200px;" id="flickr_zoom_badge-tags" name="flickr_zoom_badge-tags" type="text" value="<?php echo $tags; ?>" />
	<input type="hidden" id="flickr_zoom_badge-submit" name="flickr_zoom_badge-submit" value="1" />
	<?php
}

function flickr_zoom_badge_init() {
	if (!function_exists('register_sidebar'))
		return;
	register_sidebar_widget(__('Flickr Zoom Badge', 'flickr_zoom_badge'), 'flickr_zoom_badge');
	register_widget_control(__('Flickr Zoom Badge', 'flickr_zoom_badge'), 'flickr_zoom_badge_control', 300, 160);
	if (is_active_widget('flickr_zoom_badge'))
      add_action('wp_head', 'flickr_zoom_badge_header');
}

add_action('init', 'flickr_zoom_badge_init');

// EOF
