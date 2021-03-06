<?php
/**
 * This is the footer include template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * This is meant to be included in a page template.
 *
 * @package evoskins
 * @subpackage nifty_nautica
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );
?>

<!-- =================================== START OF FOOTER =================================== -->
<div id="pageFooter">
	<p class="baseline">
		<?php
			// Display a link to contact the owner of this blog (if owner accepts messages):
			$Blog->contact_link( array(
					'before'      => '',
					'after'       => ' &bull; ',
					'text'   => T_('Contact'),
'title'  => T_('Send a message to the owner of this blog...'),
									) );
		?>
		Original by <a href="http://severinelandrieu.com/">S&eacute;verine Landrieu</a>
		&amp; <a href="http://fplanque.com">F. Planque</a>

		&bull;  Edit by <a href="http://www.betz.lu" title="Charles Betz Blog">Charles Betz</a>
		<?php
			// Display additional credits (see /conf/):
 			// If you can add your own credits without removing the defaults, you'll be very cool :))
			// Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net
			display_list( $credit_links, T_('Credits').': ', '', '|', ' ', ' ' );
		?>
	</p>
</div>
