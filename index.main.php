<?php
/**
 * This is the main/default page template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * It is used to display the blog when no specific page template is available to handle the request.
 *
 * @package evoskins
 * @subpackage nifty_nautica
 *
 * @version $Id: index.main.php,v 1.0 2007/10/23 21:49:35 CBetz
 * @version $Id: index.main.php,v 1.1 2015/9/13
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php', array() );
// -------------------------------- END OF HEADER --------------------------------


// ---------------------------- SITE HEADER INCLUDED HERE ----------------------------
// If site headers are enabled, they will be included here:
siteskin_include( '_site_body_header.inc.php' );
// ------------------------------- END OF SITE HEADER --------------------------------
?>


<div class="wrapper">
<div class="wrapper2">

<div class="outerwrap">
<div class="innerwrap">


	<div class="navigation">
		<ul>
		<?php
			// ------------------------- "Menu" CONTAINER EMBEDDED HERE --------------------------
			// Display container and contents:
			// Note: this container is designed to be a single <ul> list
			skin_container( NT_('Menu'), array(
					// The following params will be used as defaults for widgets included in this container:
					'block_start'         => '',
					'block_end'           => '',
					'block_display_title' => false,
					'list_start'          => '',
					'list_end'            => '',
					'item_start'          => '<li class="evo_widget $wi_class$">',
					'item_end'            => '</li>',
					'item_selected_start' => '<li class="active evo_widget $wi_class$">',
					'item_selected_end'   => '</li>',
					'item_title_before'   => '',
					'item_title_after'    => '',
				) );
			// ----------------------------- END OF "Menu" CONTAINER -----------------------------
		?>
		</ul>
	</div>

<div class="pageHeader">
		<?php
				// ------------------------- "Header" CONTAINER EMBEDDED HERE --------------------------
				// Display container and contents:
				skin_container( NT_('Header'), array(
						// The following params will be used as defaults for widgets included in this container:
						'block_start'       => '<div class="description">',
						'block_end'         => '</div>',
						'block_title_start' => '<h1>',
						'block_title_end'   => '</h1>',
					) );
				// ----------------------------- END OF "Header" CONTAINER -----------------------------
			?>
</div>

</div>
</div>

<div class="posts">
<div class="innerwrap">

  <?php
	// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
	messages( array(
			'block_start' => '<div class="action_messages">',
			'block_end'   => '</div>',
		) );
	// --------------------------------- END OF MESSAGES ---------------------------------
	?>

<?php
	/*if( isset($MainList) )
	{ // Links to previous and next post in single post mode:
		$MainList->prevnext_item_links( array(
				'block_start' => '<table class="prevnext_post"><tr>',
				'prev_start'  => '<td>',
				'prev_end'    => '</td>',
				'next_start'  => '<td class="right">',
				'next_end'    => '</td>',
				'block_end'   => '</tr></table>' ) );
	}*/
?>

<!-- =================================== START OF MAIN AREA =================================== -->

<?php // ------------------------------------ START OF POSTS ----------------------------------------
		// Display message if no post:
		display_if_empty();

	while( $Item = & $MainList->get_item() )
	{
		locale_temp_switch( $Item->locale ); // Temporarily switch to post locale
	?>

	<div class="bTitle"><h3 class="bTitle"><?php $Item->title(); ?></h3></div>

		<div class="bPost" lang="<?php $Item->lang() ?>">
			<?php
				$Item->anchor(); // Anchor for permalinks to refer to
			?>
	
			<div class="bSmallHead">
			<?php
				echo ' ', T_('Categories'), ': ';
				$Item->categories();
				echo ' &nbsp; ';
			?>
			</div>

			<?php
				// ---------------------- POST CONTENT INCLUDED HERE ----------------------
				skin_include( '_item_content.inc.php', array(
						'image_size'	=>	'fit-400x320',
					) );
				// Note: You can customize the default item feedback by copying the generic
				// /skins/_item_feedback.inc.php file into the current skin folder.
				// -------------------------- END OF POST CONTENT -------------------------
			?>

			<div class="bSmallPrint">
			Author: <a href="<?php echo T_('Posted by'); ?>"><?php $Item->author(); ?></a>, at

			<?php $Item->issue_time(); // to show the time of this post ?>, 
			<a href="<?php $Item->permanent_url() ?>" title="<?php echo T_('Permanent link to full entry') ?>"></a>
			
			<?php $Item->wordcount();
				echo ' ', T_('words', ' &bull; ');
				echo ';';
				$Item->views() ?> 

									<?php
						$Item->edit_link( array( // Link to backoffice for editing
								'before'    => ' ',
								'after'     => '',
							) );
					?>
			</div>

			<?php
				// ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
				skin_include( '_item_feedback.inc.php', array(
						'before_section_title' => '<h4>',
						'after_section_title'  => '</h4>',
					) );
				// Note: You can customize the default item feedback by copying the generic
				// /skins/_item_feedback.inc.php file into the current skin folder.
				// ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
			?>
		</div>
	<?php
		locale_restore_previous();	// Restore previous locale (Blog locale)
	} // ---------------------------------- END OF POSTS ------------------------------------ ?>

	<div align="center">
		<?php
			// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
			mainlist_page_links( array(
					'block_start' => '<p class="center">',
					'block_end' => '</p>',
					'links_format' => '$prev$ :: $next$',
   				'prev_text' => '&lt;&lt; '.T_('Previous'),
   				'next_text' => T_('Next').' &gt;&gt;',
				) );
			// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
		?>
	</div>


	<?php
		// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
		skin_include( '$disp$', array(
				'disp_posts'  => '',		// We already handled this case above
				'disp_single' => '',		// We already handled this case above
				'disp_page'   => '',		// We already handled this case above
			) );
		// Note: you can customize any of the sub templates included here by
		// copying the matching php file into your skin directory.
		// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
	?>


</div>
</div>


<!-- =================================== START OF SIDEBAR =================================== -->
<div class="bSideBar">
<div class="innerwrap">

	<?php
		// Display container contents:
		$Skin->container( NT_('Sidebar'), array(
				// The following (optional) params will be used as defaults for widgets included in this container:
				// This will enclose each widget in a block:
				'block_start' => '<div class="bSideItem $wi_class$">',
				'block_end' => '</div>',
				// This will enclose the title of each widget:
				'block_title_start' => '<h3>',
				'block_title_end' => '</h3>',
				// If a widget displays a list, this will enclose that list:
				'list_start' => '<ul>',
				'list_end' => '</ul>',
				// This will enclose each item in a list:
				'item_start' => '<li>',
				'item_end' => '</li>',
				// This will enclose sub-lists in a list:
				'group_start' => '<ul>',
				'group_end' => '</ul>',
			) );
	?>

	<p class="center"><!-- Please help us promote b2evolution and leave this link on your blog. --><a href="http://b2evolution.net/" title="b2evolution: next generation blog software"><img src="../../rsc/img/powered-by-b2evolution-120t.gif" alt="powered by b2evolution free blog software" title="b2evolution: next generation blog software" width="120" height="32" border="0" /></a></p>

</div>
</div>

<div class="clear"><img src="<?php echo $rsc_url; ?>img/blank.gif" width="1" height="1" alt="" /></div>


<?php
// ------------------------- BODY FOOTER INCLUDED HERE --------------------------
skin_include( '_body_footer.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>

</div>
</div>

<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the 
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>