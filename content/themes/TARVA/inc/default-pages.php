<?php

function my_create_page( $page_title = 'Lorem ipsum', $page_permalink = 'lorem-ipsum', $page_order = '0', $page_parent= null, $page_content = null, $page_template = null ) {
	
	// Define page content
	// -------------------------------------------------------------
	$page_params = array(
		'post_type' => 'page',
		'post_title' => $page_title,
		'post_name' => $page_permalink,
		'post_parent' => $page_parent,
		'post_status' => 'publish',
		'post_content' => $page_content,
		'post_author' => 1,
		'menu_order' => $page_order,
	);
	
	// Check if the page exists
	// -------------------------------------------------------------
	$page_data = get_page_by_title( $page_title );
	$page_id = $page_data->ID;
	
	// Create page if it doesn't exist
	// -------------------------------------------------------------
	if ( ! isset( $page_data ) ) {
		wp_insert_post( $page_params );
		$page_data = get_page_by_title( $page_title );
		$page_id = $page_data->ID;
		if ( isset( $page_data ) ) {
			update_post_meta( $page_id, '_wp_page_template', $page_template );
		}
	}
	
}

// Set page content
// -------------------------------------------------------------
$contact_content = '
[gravityform id="1" name="Make an enquiry" title="true" description="false"]
';

$confirmation_content = '
<p><strong class="flash success">Your message has been successfully sent</strong></p>
<p>Thank you for your enquiry. It has been received and we will get back to you shortly, usually within 24 hours.</p>
';

$privacy_content = '
<p class="intro">This privacy policy sets out how '. get_bloginfo('name') . ' uses and protects any information that you give us when you use this website.</p>
We are committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website; you can be assured that it will only be used in accordance with this privacy statement.

'. get_bloginfo('name') . ' may change this policy from time to time by updating this page. You should check this page frequently to ensure that you are happy with any changes. This policy is effective from <strong>' . date("jS F Y") . '</strong>.

<h2>How we use cookies</h2>
Cookies are harmless text files which may be stored on your computer whilst using the site. We use cookies to improve your browsing experience and enable certain features or functionality.

We also measure statistics about visitors to the site and their usage e.g. where they came from, what pages they visit and what browser they are using. Knowing how our site is being used means we can improve our user&rsquo;s experience in the future. We <strong>do not</strong> use cookies for advertising purposes or pass user data to any other organisation.

All cookies used on this site are listed below. If you do not wish these cookies to be tracked you can <a href="http://www.aboutcookies.org/default.aspx?page=1">disable them in your browser</a>, but this may negatively effect your experience on the site.
<h3>First party cookies</h3>
These are cookies that may be controlled and set by us on this domain, used to provide site functionality and optimisation.
<table>
<thead>
<tr>
<th scope="col">Name</th>
<th scope="col">Purpose</th>
</tr>
</thead>
<tbody>
<tr>
<td>resolution</td>
<td>Set and used by <a href="http://adaptive-images.com/">Adaptive Images</a> to serve appropriately sized images to your device</td>
</tr>
<tr>
<td>wordpress_test_cookie</td>
<td>Set and used by <a href="http://wordpress.org/">WordPress</a> to test for cookie capability</td>
</tr>
<tr>
<td>comment_author, comment_author_email</td>
<td>Set and used by <a href="http://wordpress.org/">WordPress</a> to remember a commenting user&rsquo;s data</td>
</tr>
<tr>
<td>wp-settings, wp-settings-time</td>
<td>Set and used by <a href="http://wordpress.org/">WordPress</a> to remember a logged-in user&rsquo;s preferences</td>
</tr>
</tbody>
</table>
<h3>Third party cookies</h3>
These are cookies that may be controlled and set by external services / tools, used to enhance our site and provide usage information.
<table>
<thead>
<tr>
<th scope="col">Name</th>
<th scope="col">Purpose</th>
</tr>
</thead>
<tbody>
<tr>
<td>__utma, __utmb, __utmc, __utmv, __utmz</td>
<td>Set and used by <a href="http://www.google.co.uk/intl/en/policies/privacy/">Google Analytics</a> to track user activity</td>
</tr>
<tr>
<td>NREUM, NRAGENT, JSESSIONID</td>
<td>Set and used by <a href="https://newrelic.com/docs/general/what-cookies-does-newrelic-create/">New Relic</a> to track user activity</td>
</tr>
<tr>
<td>khcookie, NID, SNID and PREF</td>
<td>Set and used by <a href="http://www.google.com/intl/en/policies/privacy/">Google Maps</a> to provide interactive location maps</td>
</tr>
<tr>
<td>APISID, HSID, NID, PREF, SSID, SID, SAPISID</td>
<td>Set and used by <a href="http://www.google.com/intl/en/policies/privacy/">Google Site Search</a> to provide search functionality</td>
</tr>
<tr>
<td>SERVERID, UID, UIDR, __qca</td>
<td>Set and used by <a href="http://www.slideshare.net/privacy/">Slideshare</a> to provide embedded slideshows</td>
</tr>
</tbody>
</table>
<hr />
<h2>Form data</h2>
We may collect the following information via any of the site&rsquo;s input forms:
<ul>
	<li>Your name and job title</li>
	<li>Contact information including email address and telephone</li>
	<li>Your address and postcode</li>
	<li>Subscriptions to our email newsletter</li>
</ul>
Any email address data collected is <strong>never</strong> passed on to any third parties. If you do not wish to revieve email newsletters from ourselves, please leave the "subscribe" option unticked when submitting any contact forms.
<h2 class="headline">Security</h2>
We are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure we have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information we collect online.
<h2 class="headline">Links to other websites</h2>
Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website. Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.
<h2 class="headline">Controlling your personal information</h2>
You may choose to restrict the collection or use of your personal information in the following ways:
<ul>
	<li>Whenever you are asked to fill in a form on the website, <strong>do not</strong> tick the box to indicate that you want your email address to be used by for email marketing purposes</li>
	<li>If you have previously agreed to us using your personal information for email marketing purposes, you may change your mind at any time by writing to the address given below or by <a href="/contact">emailing us</a></li>
	<li>We will not sell, distribute or lease your personal information to third parties unless we have your permission or are required by law to do so</li>
</ul>
You may request details of personal information which we hold about you under the Data Protection Act 1998. A small fee may be payable. If you would like a copy of the information held on you please write to: <strong>[CLIENT ADDRESS]</strong>.

If you believe that any information we are holding on you is incorrect or incomplete, please write to or email us as soon as possible, at the above address. We will promptly correct any information found to be incorrect.
';

$terms_content = '
If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern the '. get_bloginfo('name') . '&rsquo;s relationship with you in relation to this website.

If you disagree with any part of these terms and conditions, please do not use our website.

The term &lsquo;'. get_bloginfo('name') . '&rsquo; or &lsquo;us&rsquo; or &lsquo;we&rsquo; refers to the owner of the website whose registered office is <strong>[CLIENT ADDRESS]</strong>. Our company registration number is <strong>[CLIENT REGISTRATION NUMBER]</strong>, registered in England and Wales. The term &laquo;you&rsquo; refers to the user or viewer of our website.
<h2>This website is subject to the following terms of use:</h2>
<ul>
<li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>
<li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>
<li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>
<li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>
<li>All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.</li>
<li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>
<li>From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>
<li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li>
</ul>
';

$accessibility_content = '
<p class="intro">We have made every effort to make this site accessible and easy to use for everyone, no matter what browser you choose to use, and whether they use assistive technology or not.</p>

<h2>Landmark Roles</h2>
Following guidance set by the Web Accessibility Initiative (WAI) and the Accessible Rich Internet Applications Suite (ARIA), landmark roles are provided to make the site more accessible. Roles used to identify specific content or navigation areas for machine readers and assistive devices such as screen readers.

Landmarks have been added to identify the site&rsquo;s Header (banner), Sidebar (complementary), Footer (contentinfo), Primary Content (main), Navigation (navigation) and Search (search).
<h2>Browser support</h2>
The site is built in a flexible manner and scales to ensure readability on whatever device or browser it is viewed upon. Browser support is progressive meaning more capable browsers may get improved aesthetics or functionality, yet content is still accessible to even the oldest browsers.
<h2>Semantics</h2>
HTML5 markup is used to structure the site with appropriate elements used to clearly and logically identify content for search engines or screen readers.
<h2>JavaScript</h2>
The use of JavaScript will give the user enhanced features of the site. Where it is not available then all pages and process are still accessible.
<h2>Forms</h2>
All forms fields follow a logical tab sequence to ensure easy navigation. Form fields also have &lsquo;label&rsquo; and &lsquo;id&rsquo; attributes to associate the form field with its label to allow for easy entry of data.
<h2>Links</h2>
All links have been written to make sense when taken out of context. Where appropriate, we have also added link title attributes to describe the link in greater detail.
<h2>Font size</h2>
The font sizes used on the website are fully flexible. You can change the font size to make it either larger or smaller via your browser settings.
<h2>Colours</h2>
We have taken care to ensure that the site’s colour combinations and contrast significantly and are effective in ensuring information is still clear when viewed by all.
<h2>Downloads</h2>
We use Adobe PDFs for additional information and downloads. Adobe PDF Reader is freely available for use on any computer, and a link to the software has been provided where appropriate.
';

// Create default pages after theme activation
// -------------------------------------------------------------
function create_default_pages() {
	global $contact_content, $confirmation_content, $privacy_content, $terms_content, $accessibility_content;

	my_create_page( 'Contact us', 'contact', '96', '', $contact_content );
	my_create_page( 'Confirmation', 'confirmation', '1', '4', $confirmation_content );
	my_create_page( 'Privacy &amp; cookies', 'privacy', '97', '', $privacy_content );
	my_create_page( 'Terms &amp; conditions', 'terms', '98', '', $terms_content );
	my_create_page( 'Accessibility', 'accessibility', '99', '', $accessibility_content );
	my_create_page( 'Sitemap', 'sitemap', '100', '', '', 'sitemap.php' );
	
	// Exclude our created Confirmation page
	if( get_option( 'nav_excluded_ids' ) == '' ) {
		update_option( 'nav_excluded_ids', '5' );
	}	
}

add_action( 'after_switch_theme' , 'create_default_pages', 10, 2 );