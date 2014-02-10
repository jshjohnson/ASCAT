<?php
	if(isset($_GET['post_type'])) {
	    $type = $_GET['post_type'];
	    if($type == 'centre') {
	        load_template(TEMPLATEPATH . '/parts/search-centre.php');
	    } elseif($type == 'investigator') {
	        load_template(TEMPLATEPATH . '/parts/search-specialist.php');
	    }
	}
?>