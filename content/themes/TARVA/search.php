<?php
	if(isset($_GET['post_type'])) {
	    $type = $_GET['post_type'];
	    if($type == 'centre') {
	        load_template(TEMPLATEPATH . '/parts/centre-search.php');
	    } elseif($type == 'investigator') {
	        load_template(TEMPLATEPATH . '/parts/specialist-search.php');
	    }
	}
?>