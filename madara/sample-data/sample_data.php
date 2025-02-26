<?php

if(!class_exists('madara_UNYSON_BACKUP')){
	class madara_UNYSON_BACKUP
	{
		function __construct(){
			// empty class to trick the sample data tab
		}
	}
	
}

if(!class_exists('madara_sampledata_installer')){
	class madara_sampledata_installer{
		function __construct(){
			add_action( 'wp_ajax_madara_install_data', array($this, 'ajax_install_data' ));
			add_action('madara_welcome_importdata_tab_content', array($this, '_sample_data_page'));
		}
		
		function ajax_install_data(){
			// create home page	
			$args = array(
						'post_content' => '[tp_manga_heroslider count="3"]',
						'post_type' => 'page',
						'post_title' => 'Home Page',
						'post_status' => 'publish'
					);
			$frontpage_id = wp_insert_post($args);
			
			update_post_meta( $frontpage_id, 'custom_sidebar_settings', 'on' );
			update_post_meta( $frontpage_id, 'page_content', 'manga' );
			update_post_meta( $frontpage_id, 'page_sidebar', 'right' );
			update_post_meta( $frontpage_id, 'main_top_sidebar_background', array('background-color' => '#000') );
			update_post_meta( $frontpage_id, 'main_top_sidebar_container', 'full_width' );
			update_post_meta( $frontpage_id, 'main_top_sidebar_spacing', array('top' => '15', 'right' => '0', 'bottom' => '1', 'left' => '0', 'unit' => 'px') );
			update_post_meta( $frontpage_id, 'main_top_second_sidebar_spacing', array('top' => '1', 'right' => '0', 'bottom' => '0', 'left' => '0', 'unit' => 'px') );
			update_post_meta( $frontpage_id, 'main_top_second_sidebar_background', array('background-color' => '#000') );
			update_post_meta( $frontpage_id, 'page_title', 'off' );
			update_post_meta( $frontpage_id, 'page_meta_tags', 'off' );
			update_post_meta( $frontpage_id, '_wp_page_template', 'page-templates/front-page.php' );
		
			$args = array(
				'post_content' => '-- Manga Listing --',
				'post_type' => 'page',
				'post_title' => 'New',
				'post_status' => 'publish'
			);
			$newpage_id = wp_insert_post($args);
		
			update_post_meta( $newpage_id, 'page_content', 'manga' );
			update_post_meta( $newpage_id, 'page_sidebar', 'full' );
			update_post_meta( $newpage_id, 'manga_archives_item_layout', 'small_thumbnail' );
			update_post_meta( $newpage_id, 'archive_heading_text', 'Latest Updates' );
			update_post_meta( $newpage_id, '_wp_page_template', 'page-templates/front-page.php' );
			update_post_meta( $newpage_id, 'page_post_orderby', 'modified' );
			
			$args = array(
				'post_content' => '-- Manga Listing --',
				'post_type' => 'page',
				'post_title' => 'Ranking',
				'post_status' => 'publish'
			);
			$rankingpage_id = wp_insert_post($args);
		
			update_post_meta( $rankingpage_id, 'page_content', 'manga' );
			update_post_meta( $rankingpage_id, 'page_sidebar', 'full' );
			update_post_meta( $rankingpage_id, 'manga_archives_item_layout', 'big_thumbnail' );
			update_post_meta( $rankingpage_id, 'archive_heading_text', 'Top Views' );    
			update_post_meta( $rankingpage_id, '_wp_page_template', 'page-templates/front-page.php' );
			update_post_meta( $rankingpage_id, 'page_post_orderby', 'views' );
			update_post_meta( $rankingpage_id, 'page_custom_css', 'ranking' );
			
			$args = array(
				'post_content' => '-- Blog Page --',
				'post_type' => 'page',
				'post_title' => 'Blog',
				'post_status' => 'publish'
			);
			$blog_pageid = wp_insert_post($args);
		
			update_post_meta( $blog_pageid, 'page_sidebar', 'right' );

			$args = array(
				'post_content' => '-- About Us --',
				'post_type' => 'page',
				'post_title' => 'About Us',
				'post_status' => 'publish'
			);
			$aboutus_pageid = wp_insert_post($args);
			
			$settings = get_option( 'wp_manga_settings' , array() );
			$settings['manga_archive_page'] = $newpage_id;
			$resp = update_option( 'wp_manga_settings', $settings );
		
			// Widgets settings
			$widgets = '{"manga_archive_sidebar":{"manga-history-id-2":{"title":"MY READING HISTORY","number_of_posts":"3","widget_logic":"!is_page(\'contact\') && !is_page(\'about-us\')"}},"manga_single_sidebar":{"manga-recent-3":{"title":"POPULAR MANGA","number_of_post":"6","genre":"","author":"","artist":"","release":"","order_by":"latest","time_range":"all","order":"desc","style":"style-1","button":"Here for more Popular Manga","url":"\/manga\/?m_orderby=trending","widget_logic":"!is_page(\'contact\') && !is_page(\'about-us\')"}},"manga_reading_sidebar":{"custom_html-2":{"title":"Madara Info","content":"<p>\r\nMadara stands as a beacon for those desiring to craft a captivating online comic and manga reading platform on WordPress\r\n<\/p>\r\n<p>\r\n\tFor custom work request, please send email to wpstylish(at)gmail(dot)com\r\n<\/p>","widget_logic":""}},"main_sidebar":{"manga-search-3":{"title":"","search_advanced":"Advanced","widget_logic":""},"manga-recent-4":{"title":"Editor choices","number_of_post":"5","genre":"","author":"","artist":"","release":"","order_by":"random","time_range":"all","order":"desc","style":"style-1","button":"View All","url":"https:\/\/live.mangabooth.com\/manga\/","show_volume":"yes"},"wp_manga_release_id-2":{"title":"Titles by years","exclude":"","number":"20","go_release":"true","widget_logic":""}},"search_sidebar":{"manga-search-4":{"title":"","search_advanced":"Advanced"}},"top_sidebar":{"manga-slider-2":{"title":"","number_of_post":"7","number_to_show":"3","genre":"","manga_tags":"","author":"","artist":"","release":"","order_by":"latest","manga_type":"","order":"desc","style":"style-2","autoplay":"1","timerange":"all","extended_widget_opts-manga-slider-6":{"id_base":"manga-slider-6","visibility":{"main":"","options":"hide","selected":"0","misc":{"home":"1"},"pages":["12","337","498","849"],"tax_terms_page":{"category":"1"}},"devices":{"options":"hide"},"alignment":{"desktop":"default"},"roles":{"state":""},"styling":{"bg_image":""},"class":{"selected":"0","id":"","classes":"","logic":""},"tabselect":"0"}}},"top_second_sidebar":{"manga-popular-slider-2":{"title":"Popular Series","number_of_post":"5","number_to_show":"4","genre":"","author":"","artist":"","release":"","order_by":"latest","order":"desc","style":"style-1","manga_type":"","manga_tags":"","autoplay":"1","timerange":"all","extended_widget_opts-manga-popular-slider-6":{"id_base":"manga-popular-slider-6","visibility":{"main":"","options":"hide","selected":"0","pages":["498","849"],"tax_terms_page":{"category":"1"}},"devices":{"options":"hide"},"alignment":{"desktop":"default"},"roles":{"state":""},"styling":{"bg_image":""},"class":{"selected":"0","id":"","classes":"","logic":""},"tabselect":"0"}}},"footer_sidebar":{"manga-genres-id-2":{"title":"All Genres","exclude_genre":"","show_manga_counts":"true","layout":"layout-2"}}}';
		
			$widgets_json = json_decode($widgets);   // Decode file contents to JSON data.
			$wie_import_results = $this->wie_import_data($widgets_json);
		
			// Theme Options settings
			$to_settings = 'YToyNTc6e3M6MTA6ImxvZ29faW1hZ2UiO3M6MDoiIjtzOjE1OiJsb2dvX2ltYWdlX3NpemUiO3M6MDoiIjtzOjE3OiJyZXRpbmFfbG9nb19pbWFnZSI7czowOiIiO3M6MTY6ImxvZ2luX2xvZ29faW1hZ2UiO3M6MDoiIjtzOjExOiJib2R5X3NjaGVtYSI7czo0OiJkYXJrIjtzOjI2OiJtYWluX3RvcF9zaWRlYmFyX2NvbnRhaW5lciI7czo5OiJjb250YWluZXIiO3M6Mjc6Im1haW5fdG9wX3NpZGViYXJfYmFja2dyb3VuZCI7YTo2OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNToiYmFja2dyb3VuZC1zaXplIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjI0OiJtYWluX3RvcF9zaWRlYmFyX3NwYWNpbmciO2E6MDp7fXM6MzM6Im1haW5fdG9wX3NlY29uZF9zaWRlYmFyX2NvbnRhaW5lciI7czo5OiJjb250YWluZXIiO3M6MzQ6Im1haW5fdG9wX3NlY29uZF9zaWRlYmFyX2JhY2tncm91bmQiO2E6Njp7czoxNjoiYmFja2dyb3VuZC1jb2xvciI7czowOiIiO3M6MTc6ImJhY2tncm91bmQtcmVwZWF0IjtzOjA6IiI7czoyMToiYmFja2dyb3VuZC1hdHRhY2htZW50IjtzOjA6IiI7czoxOToiYmFja2dyb3VuZC1wb3NpdGlvbiI7czowOiIiO3M6MTU6ImJhY2tncm91bmQtc2l6ZSI7czowOiIiO3M6MTY6ImJhY2tncm91bmQtaW1hZ2UiO3M6MDoiIjt9czozMToibWFpbl90b3Bfc2Vjb25kX3NpZGViYXJfc3BhY2luZyI7YTowOnt9czoyOToibWFpbl9ib3R0b21fc2lkZWJhcl9jb250YWluZXIiO3M6OToiY29udGFpbmVyIjtzOjMwOiJtYWluX2JvdHRvbV9zaWRlYmFyX2JhY2tncm91bmQiO2E6Njp7czoxNjoiYmFja2dyb3VuZC1jb2xvciI7czowOiIiO3M6MTc6ImJhY2tncm91bmQtcmVwZWF0IjtzOjA6IiI7czoyMToiYmFja2dyb3VuZC1hdHRhY2htZW50IjtzOjA6IiI7czoxOToiYmFja2dyb3VuZC1wb3NpdGlvbiI7czowOiIiO3M6MTU6ImJhY2tncm91bmQtc2l6ZSI7czowOiIiO3M6MTY6ImJhY2tncm91bmQtaW1hZ2UiO3M6MDoiIjt9czoyNzoibWFpbl9ib3R0b21fc2lkZWJhcl9zcGFjaW5nIjthOjA6e31zOjIyOiJsb2dpbl9wb3B1cF9iYWNrZ3JvdW5kIjthOjY6e3M6MTY6ImJhY2tncm91bmQtY29sb3IiO3M6MDoiIjtzOjE3OiJiYWNrZ3JvdW5kLXJlcGVhdCI7czowOiIiO3M6MjE6ImJhY2tncm91bmQtYXR0YWNobWVudCI7czowOiIiO3M6MTk6ImJhY2tncm91bmQtcG9zaXRpb24iO3M6MDoiIjtzOjE1OiJiYWNrZ3JvdW5kLXNpemUiO3M6MDoiIjtzOjE2OiJiYWNrZ3JvdW5kLWltYWdlIjtzOjA6IiI7fXM6MTg6InNpdGVfY3VzdG9tX2NvbG9ycyI7czozOiJvZmYiO3M6MTA6Im1haW5fY29sb3IiO3M6MDoiIjtzOjE0OiJtYWluX2NvbG9yX2VuZCI7czowOiIiO3M6MTY6ImxpbmtfY29sb3JfaG92ZXIiO3M6MDoiIjtzOjEwOiJzdGFyX2NvbG9yIjtzOjA6IiI7czoxOToiaG90X2JhZGdlc19iZ19jb2xvciI7czowOiIiO3M6MTk6Im5ld19iYWRnZXNfYmdfY29sb3IiO3M6MDoiIjtzOjIyOiJjdXN0b21fYmFkZ2VzX2JnX2NvbG9yIjtzOjA6IiI7czo2OiJidG5fYmciO3M6MDoiIjtzOjk6ImJ0bl9jb2xvciI7czowOiIiO3M6MTI6ImJ0bl9ob3Zlcl9iZyI7czowOiIiO3M6MTU6ImJ0bl9ob3Zlcl9jb2xvciI7czowOiIiO3M6MjA6ImhlYWRlcl9jdXN0b21fY29sb3JzIjtzOjM6Im9mZiI7czoxNDoibmF2X2l0ZW1fY29sb3IiO3M6MDoiIjtzOjIwOiJuYXZfaXRlbV9ob3Zlcl9jb2xvciI7czowOiIiO3M6MTA6Im5hdl9zdWJfYmciO3M6MDoiIjtzOjIzOiJuYXZfc3ViX2JnX2JvcmRlcl9jb2xvciI7czowOiIiO3M6MTg6Im5hdl9zdWJfaXRlbV9jb2xvciI7czowOiIiO3M6MjQ6Im5hdl9zdWJfaXRlbV9ob3Zlcl9jb2xvciI7czowOiIiO3M6MjE6Im5hdl9zdWJfaXRlbV9ob3Zlcl9iZyI7czowOiIiO3M6Mjc6ImhlYWRlcl9ib3R0b21fY3VzdG9tX2NvbG9ycyI7czozOiJvZmYiO3M6MTY6ImhlYWRlcl9ib3R0b21fYmciO3M6MDoiIjtzOjIxOiJib3R0b21fbmF2X2l0ZW1fY29sb3IiO3M6MDoiIjtzOjI3OiJib3R0b21fbmF2X2l0ZW1faG92ZXJfY29sb3IiO3M6MDoiIjtzOjE3OiJib3R0b21fbmF2X3N1Yl9iZyI7czowOiIiO3M6MjU6ImJvdHRvbV9uYXZfc3ViX2l0ZW1fY29sb3IiO3M6MDoiIjtzOjMxOiJib3R0b21fbmF2X3N1Yl9pdGVtX2hvdmVyX2NvbG9yIjtzOjA6IiI7czoyODoiYm90dG9tX25hdl9zdWJfYm9yZGVyX2JvdHRvbSI7czowOiIiO3M6MjQ6Im1vYmlsZV9tZW51X2N1c3RvbV9jb2xvciI7czozOiJvZmYiO3M6Mjc6Im1vYmlsZV9icm93c2VyX2hlYWRlcl9jb2xvciI7czowOiIiO3M6MjI6ImNhbnZhc19tZW51X2JhY2tncm91bmQiO3M6MDoiIjtzOjE3OiJjYW52YXNfbWVudV9jb2xvciI7czowOiIiO3M6MTc6ImNhbnZhc19tZW51X2hvdmVyIjtzOjA6IiI7czoxOToiZ29vZ2xlX2ZvbnRfYXBpX2tleSI7czowOiIiO3M6MTc6ImZvbnRfdXNpbmdfY3VzdG9tIjtzOjM6Im9mZiI7czoxOToibWFpbl9mb250X29uX2dvb2dsZSI7czoyOiJvbiI7czoyMzoibWFpbl9mb250X2dvb2dsZV9mYW1pbHkiO2E6MTp7aTowO2E6MTp7czo2OiJmYW1pbHkiO3M6MDoiIjt9fXM6MTY6Im1haW5fZm9udF9mYW1pbHkiO3M6MDoiIjtzOjE0OiJtYWluX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxNjoibWFpbl9mb250X3dlaWdodCI7czo2OiJub3JtYWwiO3M6MjE6Im1haW5fZm9udF9saW5lX2hlaWdodCI7czozOiIxLjUiO3M6MjI6ImhlYWRpbmdfZm9udF9vbl9nb29nbGUiO3M6Mjoib24iO3M6MjY6ImhlYWRpbmdfZm9udF9nb29nbGVfZmFtaWx5IjthOjE6e2k6MDthOjE6e3M6NjoiZmFtaWx5IjtzOjA6IiI7fX1zOjE5OiJoZWFkaW5nX2ZvbnRfZmFtaWx5IjtzOjA6IiI7czoyMDoiaGVhZGluZ19mb250X3NpemVfaDEiO3M6MjoiMzQiO3M6MTQ6ImgxX2xpbmVfaGVpZ2h0IjtzOjM6IjEuMiI7czoxNDoiaDFfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjIwOiJoZWFkaW5nX2ZvbnRfc2l6ZV9oMiI7czoyOiIzMCI7czoxNDoiaDJfbGluZV9oZWlnaHQiO3M6MzoiMS4yIjtzOjE0OiJoMl9mb250X3dlaWdodCI7czozOiI2MDAiO3M6MjA6ImhlYWRpbmdfZm9udF9zaXplX2gzIjtzOjI6IjI0IjtzOjE0OiJoM19saW5lX2hlaWdodCI7czozOiIxLjQiO3M6MTQ6ImgzX2ZvbnRfd2VpZ2h0IjtzOjM6IjYwMCI7czoyMDoiaGVhZGluZ19mb250X3NpemVfaDQiO3M6MjoiMTgiO3M6MTQ6Img0X2xpbmVfaGVpZ2h0IjtzOjM6IjEuMiI7czoxNDoiaDRfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjIwOiJoZWFkaW5nX2ZvbnRfc2l6ZV9oNSI7czoyOiIxNiI7czoxNDoiaDVfbGluZV9oZWlnaHQiO3M6MzoiMS4yIjtzOjE0OiJoNV9mb250X3dlaWdodCI7czozOiI2MDAiO3M6MjA6ImhlYWRpbmdfZm9udF9zaXplX2g2IjtzOjI6IjE0IjtzOjE0OiJoNl9saW5lX2hlaWdodCI7czozOiIxLjIiO3M6MTQ6Img2X2ZvbnRfd2VpZ2h0IjtzOjM6IjUwMCI7czoyNToibmF2aWdhdGlvbl9mb250X29uX2dvb2dsZSI7czoyOiJvbiI7czoyOToibmF2aWdhdGlvbl9mb250X2dvb2dsZV9mYW1pbHkiO2E6MTp7aTowO2E6MTp7czo2OiJmYW1pbHkiO3M6MDoiIjt9fXM6MjI6Im5hdmlnYXRpb25fZm9udF9mYW1pbHkiO3M6MDoiIjtzOjIwOiJuYXZpZ2F0aW9uX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoyMjoibmF2aWdhdGlvbl9mb250X3dlaWdodCI7czozOiI0MDAiO3M6MTk6Im1ldGFfZm9udF9vbl9nb29nbGUiO3M6Mjoib24iO3M6MjM6Im1ldGFfZm9udF9nb29nbGVfZmFtaWx5IjthOjE6e2k6MDthOjE6e3M6NjoiZmFtaWx5IjtzOjA6IiI7fX1zOjE2OiJtZXRhX2ZvbnRfZmFtaWx5IjtzOjA6IiI7czoxMzoiY3VzdG9tX2ZvbnRfMSI7czowOiIiO3M6MTM6ImN1c3RvbV9mb250XzIiO3M6MDoiIjtzOjEzOiJjdXN0b21fZm9udF8zIjtzOjA6IiI7czoxMjoiaGVhZGVyX3N0eWxlIjtzOjE6IjEiO3M6MTA6Im5hdl9zdGlja3kiO3M6MToiMSI7czoyMDoiaGVhZGVyX2JvdHRvbV9ib3JkZXIiO3M6Mjoib24iO3M6Mjg6ImhlYWRlcl9kaXNhYmxlX2xvZ2luX2J1dHRvbnMiO3M6Mjoib24iO3M6MTU6ImFyY2hpdmVfc2lkZWJhciI7czo1OiJyaWdodCI7czoyMDoiYXJjaGl2ZV9oZWFkaW5nX3RleHQiO3M6MDoiIjtzOjIwOiJhcmNoaXZlX2hlYWRpbmdfaWNvbiI7czowOiIiO3M6MTg6ImFyY2hpdmVfbWFyZ2luX3RvcCI7czowOiIiO3M6MjM6ImFyY2hpdmVfY29udGVudF9jb2x1bW5zIjtzOjE6IjMiO3M6MTg6ImFyY2hpdmVfbmF2aWdhdGlvbiI7czo3OiJkZWZhdWx0IjtzOjE5OiJhcmNoaXZlX2JyZWFkY3J1bWJzIjtzOjI6Im9uIjtzOjI4OiJhcmNoaXZlX25hdmlnYXRpb25fc2FtZV90ZXJtIjtzOjM6Im9mZiI7czozMjoiYXJjaGl2ZV9uYXZpZ2F0aW9uX3Rlcm1fdGF4b25vbXkiO3M6MDoiIjtzOjIwOiJhcmNoaXZlX3Bvc3RfZXhjZXJwdCI7czoyOiJvbiI7czoxNDoic2luZ2xlX3NpZGViYXIiO3M6NToicmlnaHQiO3M6MTQ6InNpbmdsZV9leGNlcnB0IjtzOjI6Im9uIjtzOjIxOiJzaW5nbGVfZmVhdHVyZWRfaW1hZ2UiO3M6Mjoib24iO3M6MTE6InNpbmdsZV90YWdzIjtzOjI6Im9uIjtzOjE0OiJwb3N0X21ldGFfdGFncyI7czoyOiJvbiI7czoxNToic2luZ2xlX2NhdGVnb3J5IjtzOjI6Im9uIjtzOjE0OiJlbmFibGVfY29tbWVudCI7czoyOiJvbiI7czoxODoic2luZ2xlX3JldmVyc2VfbmF2IjtzOjM6Im9mZiI7czoxMjoicGFnZV9zaWRlYmFyIjtzOjU6InJpZ2h0IjtzOjE0OiJwYWdlX21ldGFfdGFncyI7czoyOiJvbiI7czoxMzoicGFnZV9jb21tZW50cyI7czoyOiJvbiI7czoyNDoic2VhcmNoX2hlYWRlcl9iYWNrZ3JvdW5kIjthOjY6e3M6MTY6ImJhY2tncm91bmQtY29sb3IiO3M6NzoiIzBhMGEwYSI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNToiYmFja2dyb3VuZC1zaXplIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjI1OiJtYW5nYV9zZWFyY2hfZXhjbHVkZV90YWdzIjtzOjA6IiI7czoyNzoibWFuZ2Ffc2VhcmNoX2V4Y2x1ZGVfZ2VucmVzIjtzOjA6IiI7czoyODoibWFuZ2Ffc2VhcmNoX2V4Y2x1ZGVfYXV0aG9ycyI7czowOiIiO3M6MTg6Im1hZGFyYV9hamF4X3NlYXJjaCI7czoyOiJvbiI7czoxNjoicGFnZTQwNF9oZWFkX3RhZyI7czowOiIiO3M6MjI6InBhZ2U0MDRfZmVhdHVyZWRfaW1hZ2UiO3M6MDoiIjtzOjEzOiJwYWdlNDA0X3RpdGxlIjtzOjA6IiI7czoxNToicGFnZTQwNF9jb250ZW50IjtzOjA6IiI7czo4OiJmYWNlYm9vayI7czowOiIiO3M6NzoidHdpdHRlciI7czowOiIiO3M6ODoibGlua2VkaW4iO3M6MDoiIjtzOjY6InR1bWJsciI7czowOiIiO3M6MTE6Imdvb2dsZS1wbHVzIjtzOjA6IiI7czo5OiJwaW50ZXJlc3QiO3M6MDoiIjtzOjc6InlvdXR1YmUiO3M6MDoiIjtzOjY6ImZsaWNrciI7czowOiIiO3M6ODoiZHJpYmJibGUiO3M6MDoiIjtzOjc6ImJlaGFuY2UiO3M6MDoiIjtzOjg6ImVudmVsb3BlIjtzOjA6IiI7czozOiJyc3MiO3M6MDoiIjtzOjI0OiJvcGVuX3NvY2lhbF9saW5rX25ld190YWIiO3M6Mjoib24iO3M6MTA6ImFkc2Vuc2VfaWQiO3M6MDoiIjtzOjMxOiJhZHNlbnNlX3Nsb3RfYWRzX2JlZm9yZV9jb250ZW50IjtzOjA6IiI7czoxODoiYWRzX2JlZm9yZV9jb250ZW50IjtzOjA6IiI7czozMDoiYWRzZW5zZV9zbG90X2Fkc19hZnRlcl9jb250ZW50IjtzOjA6IiI7czoxNzoiYWRzX2FmdGVyX2NvbnRlbnQiO3M6MDoiIjtzOjIzOiJhZHNlbnNlX3Nsb3RfYWRzX2Zvb3RlciI7czowOiIiO3M6MTA6ImFkc19mb290ZXIiO3M6MDoiIjtzOjI2OiJhZHNlbnNlX3Nsb3RfYWRzX3dhbGxfbGVmdCI7czowOiIiO3M6MTM6ImFkc193YWxsX2xlZnQiO3M6MDoiIjtzOjI3OiJhZHNlbnNlX3Nsb3RfYWRzX3dhbGxfcmlnaHQiO3M6MDoiIjtzOjE0OiJhZHNfd2FsbF9yaWdodCI7czowOiIiO3M6MjU6ImFkc2Vuc2Vfc2xvdF9hZHNfdG9wX3BhZ2UiO3M6MDoiIjtzOjEyOiJhZHNfdG9wX3BhZ2UiO3M6MTA0OiI8YSBocmVmPSIjIj48aW1nIHNyYz0iaHR0cHM6Ly9saXZlLm1hbmdhYm9vdGguY29tL3RwL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDIzLzAyL3RvcC1iYW5uZXItMS5wbmciIC8+PC9hPiI7czo5OiJjb3B5cmlnaHQiO3M6NDA6Ik1hZGFyYSBXb3JkUHJlc3MgVGhlbWUgYnkgTWFuZ2Fib290aC5jb20iO3M6MTQ6ImVjaG9fbWV0YV90YWdzIjtzOjI6Im9uIjtzOjg6Imxhenlsb2FkIjtzOjI6Im9uIjtzOjEzOiJzY3JvbGxfZWZmZWN0IjtzOjI6Im9uIjtzOjk6ImdvX3RvX3RvcCI7czoyOiJvbiI7czoxOToibG9hZGluZ19mb250YXdlc29tZSI7czoyOiJvbiI7czoxNjoibG9hZGluZ19pb25pY29ucyI7czoyOiJvbiI7czoxNjoibG9hZGluZ19jdF9pY29ucyI7czoyOiJvbiI7czoxMDoiY3VzdG9tX2NzcyI7czowOiIiO3M6MTU6ImZhY2Vib29rX2FwcF9pZCI7czowOiIiO3M6MTE6InN0YXRpY19pY29uIjtzOjA6IiI7czoxMToicHJlX2xvYWRpbmciO3M6MToiMiI7czoxNjoicHJlX2xvYWRpbmdfbG9nbyI7czowOiIiO3M6MjA6InByZV9sb2FkaW5nX2JnX2NvbG9yIjtzOjA6IiI7czoyMjoicHJlX2xvYWRpbmdfaWNvbl9jb2xvciI7czowOiIiO3M6MTk6ImFqYXhfbG9hZGluZ19lZmZlY3QiO3M6MTU6ImJhbGwtZ3JpZC1wdWxzZSI7czoxOToibWFkYXJhX21pc2NfdGh1bWJfMyI7czoyOiJvbiI7czoyMjoibWFkYXJhX21hbmdhX2JpZ190aHVtYiI7czoyOiJvbiI7czoxOToibWFkYXJhX21pc2NfdGh1bWJfMSI7czoyOiJvbiI7czoyNzoibWFkYXJhX21hbmdhX2JpZ190aHVtYl9mdWxsIjtzOjI6Im9uIjtzOjE5OiJtYWRhcmFfbWlzY190aHVtYl8yIjtzOjI6Im9uIjtzOjI5OiJtYWRhcmFfbWlzY190aHVtYl9wb3N0X3NsaWRlciI7czoyOiJvbiI7czoxOToibWFkYXJhX21pc2NfdGh1bWJfNCI7czoyOiJvbiI7czoxNDoidHBfc2xpZGVyX2l0ZW0iO3M6Mjoib24iO3M6MzoiYW1wIjtzOjM6Im9mZiI7czoxOToiYW1wX2ZvbnRhd2Vzb21lX2tleSI7czowOiIiO3M6MTY6ImFtcF9pbWFnZV9oZWlnaHQiO3M6MzoiNDAwIjtzOjIzOiJhbXBfbWFuZ2FfcmVhZGluZ19zdHlsZSI7czo0OiJsaXN0IjtzOjI3OiJ1c2VyX3NldHRpbmdzX3dlYWtfcGFzc3dvcmQiO3M6Mjoib24iO3M6MzI6Im1hbmdhX21haW5fdG9wX3NpZGViYXJfY29udGFpbmVyIjtzOjk6ImNvbnRhaW5lciI7czozMzoibWFuZ2FfbWFpbl90b3Bfc2lkZWJhcl9iYWNrZ3JvdW5kIjthOjY6e3M6MTY6ImJhY2tncm91bmQtY29sb3IiO3M6MDoiIjtzOjE3OiJiYWNrZ3JvdW5kLXJlcGVhdCI7czowOiIiO3M6MjE6ImJhY2tncm91bmQtYXR0YWNobWVudCI7czowOiIiO3M6MTk6ImJhY2tncm91bmQtcG9zaXRpb24iO3M6MDoiIjtzOjE1OiJiYWNrZ3JvdW5kLXNpemUiO3M6MDoiIjtzOjE2OiJiYWNrZ3JvdW5kLWltYWdlIjtzOjA6IiI7fXM6MzA6Im1hbmdhX21haW5fdG9wX3NpZGViYXJfc3BhY2luZyI7YTowOnt9czozOToibWFuZ2FfbWFpbl90b3Bfc2Vjb25kX3NpZGViYXJfY29udGFpbmVyIjtzOjk6ImNvbnRhaW5lciI7czo0MDoibWFuZ2FfbWFpbl90b3Bfc2Vjb25kX3NpZGViYXJfYmFja2dyb3VuZCI7YTo2OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNToiYmFja2dyb3VuZC1zaXplIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjM3OiJtYW5nYV9tYWluX3RvcF9zZWNvbmRfc2lkZWJhcl9zcGFjaW5nIjthOjA6e31zOjM1OiJtYW5nYV9tYWluX2JvdHRvbV9zaWRlYmFyX2NvbnRhaW5lciI7czo5OiJjb250YWluZXIiO3M6MzY6Im1hbmdhX21haW5fYm90dG9tX3NpZGViYXJfYmFja2dyb3VuZCI7YTo2OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjA6IiI7czoxNzoiYmFja2dyb3VuZC1yZXBlYXQiO3M6MDoiIjtzOjIxOiJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiO3M6MDoiIjtzOjE5OiJiYWNrZ3JvdW5kLXBvc2l0aW9uIjtzOjA6IiI7czoxNToiYmFja2dyb3VuZC1zaXplIjtzOjA6IiI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czowOiIiO31zOjMzOiJtYW5nYV9tYWluX2JvdHRvbV9zaWRlYmFyX3NwYWNpbmciO2E6MDp7fXM6MTk6Im1hbmdhX2FkdWx0X2NvbnRlbnQiO3M6Mjoib24iO3M6MTk6Im1hbmdhX2hvdmVyX2RldGFpbHMiO3M6Mzoib2ZmIjtzOjE3OiJtYW5nYV9uZXdfY2hhcHRlciI7czoyOiJvbiI7czoyODoibWFuZ2FfbmV3X2NoYXB0ZXJfdGltZV9yYW5nZSI7czoxOiIzIjtzOjIwOiJtYW5nYV9yZWFkZXJfc2V0dGluZyI7czoyOiJvbiI7czoyNzoibWFuZ2FfYm9va21hcmtfbGlzdF9vcmRlcmJ5IjtzOjA6IiI7czoyNToibWFuZ2FfYm9va21hcmtfbGlzdF9vcmRlciI7czoxMjoib2xkZXN0X2ZpcnN0IjtzOjI0OiJtYW5nYV9hcmNoaXZlX2JyZWFkY3J1bWIiO3M6Mjoib24iO3M6Mjc6Im1hbmdhX2FyY2hpdmVfYnJlYWRjcnVtYl9iZyI7YTo2OntzOjE2OiJiYWNrZ3JvdW5kLWNvbG9yIjtzOjc6IiMwYTBhMGEiO3M6MTc6ImJhY2tncm91bmQtcmVwZWF0IjtzOjA6IiI7czoyMToiYmFja2dyb3VuZC1hdHRhY2htZW50IjtzOjA6IiI7czoxOToiYmFja2dyb3VuZC1wb3NpdGlvbiI7czowOiIiO3M6MTU6ImJhY2tncm91bmQtc2l6ZSI7czowOiIiO3M6MTY6ImJhY2tncm91bmQtaW1hZ2UiO3M6MDoiIjt9czoyMToibWFuZ2FfYXJjaGl2ZV9oZWFkaW5nIjtzOjA6IiI7czoyMDoibWFuZ2FfYXJjaGl2ZV9nZW5yZXMiO3M6Mjoib24iO3M6Mjk6Im1hbmdhX2FyY2hpdmVfZ2VucmVzX2NvbGxhcHNlIjtzOjI6Im9uIjtzOjI2OiJtYW5nYV9hcmNoaXZlX2dlbnJlc190aXRsZSI7czowOiIiO3M6MjE6Im1hbmdhX2FyY2hpdmVfc2lkZWJhciI7czo1OiJyaWdodCI7czoyNjoibWFuZ2FfYXJjaGl2ZXNfaXRlbV9sYXlvdXQiO3M6NzoiZGVmYXVsdCI7czozMjoibWFuZ2FfYXJjaGl2ZXNfaXRlbV9tb2JpbGVfd2lkdGgiO3M6MjoiNTAiO3M6NDE6Im1hbmdhX2FyY2hpdmVfbGF0ZXN0X2NoYXB0ZXJfb25fdGh1bWJuYWlsIjtzOjM6Im9mZiI7czoyOToibWFuZ2FfYXJjaGl2ZXNfaXRlbV90eXBlX2ljb24iO3M6Mzoib2ZmIjtzOjI5OiJtYW5nYV9hcmNoaXZlc19pdGVtX3R5cGVfdGV4dCI7czozOiJvZmYiO3M6MjA6Im1hbmdhX2JhZGdlX3Bvc2l0aW9uIjtzOjE6IjEiO3M6MzM6Im1hbmdhX2FyY2hpdmVfbGltaXRfdmlzaWJsZV9saW5lcyI7czoxOiIyIjtzOjM3OiJtYW5nYV9hcmNoaXZlX2xhdGVzdF9jaGFwdGVyc192aXNpYmxlIjtzOjE6IjIiO3M6MjY6Im1hbmdhX2FyY2hpdmVzX2l0ZW1fdm9sdW1lIjtzOjI6Im9uIjtzOjI4OiJtYW5nYV9zaW5nbGVfYWxsb3dfdGh1bWJfZ2lmIjtzOjM6Im9mZiI7czoyNDoibWFuZ2FfcHJvZmlsZV9iYWNrZ3JvdW5kIjthOjY6e3M6MTY6ImJhY2tncm91bmQtY29sb3IiO3M6MDoiIjtzOjE3OiJiYWNrZ3JvdW5kLXJlcGVhdCI7czowOiIiO3M6MjE6ImJhY2tncm91bmQtYXR0YWNobWVudCI7czowOiIiO3M6MTk6ImJhY2tncm91bmQtcG9zaXRpb24iO3M6MDoiIjtzOjE1OiJiYWNrZ3JvdW5kLXNpemUiO3M6MDoiIjtzOjE2OiJiYWNrZ3JvdW5kLWltYWdlIjtzOjA6IiI7fXM6Mjg6Im1hbmdhX3Byb2ZpbGVfc3VtbWFyeV9sYXlvdXQiO3M6MToiMSI7czoyODoibWFuZ2Ffc2luZ2xlX2luZm9fdmlzaWJpbGl0eSI7czozOiJvZmYiO3M6MjI6Im1hbmdhX3NpbmdsZV90YWdzX3Bvc3QiO3M6NDoiaW5mbyI7czoyNDoibWFuZ2Ffc2luZ2xlX21ldGFfYXV0aG9yIjtzOjk6IndwX2F1dGhvciI7czoyMzoibWFuZ2Ffc2luZ2xlX2JyZWFkY3J1bWIiO3M6Mjoib24iO3M6MjA6Im1hbmdhX3NpbmdsZV9zdW1tYXJ5IjtzOjI6Im9uIjtzOjI2OiJtYW5nYV9zaW5nbGVfY2hhcHRlcnNfbGlzdCI7czoyOiJvbiI7czoxODoiaW5pdF9saW5rc19lbmFibGVkIjtzOjI6Im9uIjtzOjIwOiJtYW5nYV9zaW5nbGVfc2lkZWJhciI7czo1OiJyaWdodCI7czoyMToibWFuZ2FfcmVhZGluZ19vbmVzaG90IjtzOjU6Im1hbmdhIjtzOjI2OiJtYW5nYV9kZXRhaWxfbGF6eV9jaGFwdGVycyI7czoyOiJvbiI7czoxOToibWFuZ2Ffdm9sdW1lc19vcmRlciI7czo0OiJkZXNjIjtzOjIwOiJtYW5nYV9jaGFwdGVyc19vcmRlciI7czo5OiJuYW1lX2Rlc2MiO3M6MzE6Im1hbmdhX3NpbmdsZV9jaGFwdGVyc19saXN0X2NvbHMiO3M6MToiMSI7czozMzoibWFuZ2Ffc2luZ2xlX3JlbGF0ZWRfaXRlbXNfbGF5b3V0IjtzOjE6IjEiO3M6MzI6Im1hbmdhX3NpbmdsZV9yZWxhdGVkX2l0ZW1zX2NvdW50IjtzOjE6IjQiO3M6Mzg6Im1hbmdhX3NpbmdsZV9yZWxhdGVkX2l0ZW1fbW9iaWxlX3dpZHRoIjtzOjM6IjEwMCI7czoxNjoibWFuZ2FfcmFua192aWV3cyI7czo3OiJtb250aGx5IjtzOjE1OiJzZW9fbWFuZ2FfdGl0bGUiO3M6MDoiIjtzOjE0OiJzZW9fbWFuZ2FfZGVzYyI7czowOiIiO3M6MTc6InNlb19jaGFwdGVyX3RpdGxlIjtzOjA6IiI7czoxNjoic2VvX2NoYXB0ZXJfZGVzYyI7czowOiIiO3M6MjQ6Im1hbmdhX3JlYWRpbmdfZGlzY3Vzc2lvbiI7czoyOiJvbiI7czozMjoibWFuZ2FfcmVhZGluZ19kaXNjdXNzaW9uX2hlYWRpbmciO3M6Mjoib24iO3M6MjY6Im1hbmdhX3JlYWRpbmdfcGFnZV9zaWRlYmFyIjtzOjU6InJpZ2h0IjtzOjI2OiJtYW5nYV9yZWFkaW5nX3RleHRfc2lkZWJhciI7czozOiJvZmYiO3M6MTU6ImNoYXB0ZXJfaGVhZGluZyI7czoyOiJvbiI7czoyMDoibWluaW1hbF9yZWFkaW5nX3BhZ2UiO3M6Mjoib24iO3M6Mjc6Im1hbmdhX3JlYWRpbmdfdGV4dF9mb250c2l6ZSI7czowOiIiO3M6MTk6Im1hbmdhX3JlYWRpbmdfc3R5bGUiO3M6NDoibGlzdCI7czoyNzoibWFuZ2FfY2hhcHRlcnNfc2VsZWN0X29yZGVyIjtzOjc6ImRlZmF1bHQiO3M6MjY6Im1hbmdhX3JlYWRpbmdfY29udGVudF9nYXBzIjtzOjI6Im9uIjtzOjI5OiJtYW5nYV9yZWFkaW5nX2ltYWdlc19wZXJfcGFnZSI7czoxOiIxIjtzOjI0OiJtYW5nYV9yZWFkaW5nX2Z1bGxfd2lkdGgiO3M6Mjoib24iO3M6MjE6Im1hbmdhX3JlYWRpbmdfcmVsYXRlZCI7czoyOiJvbiI7czoyMzoibWFuZ2FfcGFnZV9yZWFkaW5nX2FqYXgiO3M6Mjoib24iO3M6Mjg6Im1hbmdhX3JlYWRpbmdfcHJlbG9hZF9pbWFnZXMiO3M6Mjoib24iO3M6Mjc6Im1hbmdhX3JlYWRpbmdfc3RpY2t5X2hlYWRlciI7czowOiIiO3M6MzE6Im1hbmdhX3JlYWRpbmdfc3RpY2t5X25hdmlnYXRpb24iO3M6Mjoib24iO3M6Mzg6Im1hbmdhX3JlYWRpbmdfc3RpY2t5X25hdmlnYXRpb25fbW9iaWxlIjtzOjM6Im9mZiI7czozNToibWFuZ2FfcmVhZGluZ19uYXZpZ2F0aW9uX2J5X3BvaW50ZXIiO3M6Mjoib24iO3M6MjY6Im1hbmdhX3JlYWRpbmdfc29jaWFsX3NoYXJlIjtzOjM6Im9mZiI7czoyNzoibWFkYXJhX2Rpc2FibGVfaW1hZ2V0b29sYmFyIjtzOjM6Im9mZiI7czoyMjoibWFkYXJhX3JlYWRpbmdfaGlzdG9yeSI7czoyOiJvbiI7czoyODoibWFkYXJhX3JlYWRpbmdfaGlzdG9yeV9kZWxheSI7czoxOiI1IjtzOjI4OiJtYWRhcmFfcmVhZGluZ19oaXN0b3J5X2l0ZW1zIjtzOjI6IjEyIjt9';
			
			$message = $this->_import_thememod($to_settings);
		
			// create menu
			$main_menu_id = wp_create_nav_menu('Primary Menu ' . rand(0,1000));
			if($main_menu_id){
				wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-title' =>  __('Home'),
					'menu-item-object-id' => $frontpage_id,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'));
			
				wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-title' =>  __('All Series'),
					'menu-item-object-id' => $newpage_id,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'));
			
				wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-title' =>  __('Blog'),
					'menu-item-object-id' => $blog_pageid	,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'));
				
				wp_update_nav_menu_item($main_menu_id, 0, array(
					'menu-item-title' =>  __('About Us'),
					'menu-item-object-id' => $aboutus_pageid,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'));
			}
		
			$second_menu_id = wp_create_nav_menu('Secondary Menu ' . rand(0,1000));
			if($second_menu_id){
				wp_update_nav_menu_item($second_menu_id, 0, array(
					'menu-item-title' =>  'ROMANCE',
					'menu-item-classes' => '',
					'menu-item-url' => '#', 
					'menu-item-status' => 'publish'));
			
				wp_update_nav_menu_item($second_menu_id, 0, array(
					'menu-item-title' =>  'COMEDY',
					'menu-item-classes' => '',
					'menu-item-url' => '#', 
					'menu-item-status' => 'publish'));
			}    
			
			$locations = get_theme_mod('nav_menu_locations');
			$locations['primary_menu'] = $main_menu_id;
			$locations['secondary_menu'] = $second_menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		
			update_option( 'page_on_front', $frontpage_id );
			update_option('show_on_front', 'page');
			update_option('posts_per_page', 16);
			update_option('page_for_posts', $blog_pageid);
			// permalink
			update_option('permalink_structure', '/%postname%/');
			update_option('users_can_register', 1);
		
			// insert manga post
			for($id = 1; $id <= 20; $id++){
				$args = array(
					'post_content' => 'Lorem ipsum',
					'post_type' => 'wp-manga',
					'post_title' => 'Manga ' . $id,
					'post_status' => 'publish'
				);
			
				$manga_id = wp_insert_post($args);

				$thumb_idx = rand(1,5);
				$banner_idx = rand(1,5);
			
				$thumb_id = $this->_upload_thumb( get_stylesheet_directory_uri() . '/sample-data/thumb-' . $thumb_idx . '.jpg', $manga_id );
				$banner_id = $this->_upload_thumb( get_stylesheet_directory_uri() . '/sample-data/horiimage-' . $banner_idx . '.jpg', $manga_id );
			
				$meta_data = array(
					'_thumbnail_id'          => $thumb_id,
					'_wp_manga_alternative'  => 'Alternative Name',
					'_wp_manga_chapter_type' => 'manga',
				);
			
				foreach( $meta_data as $key => $value ){
					if( !empty( $value ) ){
						update_post_meta( $manga_id, $key, $value );
					}
				}
			
				update_post_meta($manga_id, 'manga_banner', wp_get_attachment_url($banner_id));
			
				$manga_terms = array(
					'wp-manga-release' => '2023',
					'wp-manga-author'      => 'The Author',
					'wp-manga-artist'      => 'Artist',
					'wp-manga-genre'       => 'action,horrow,fun,drama,ecchi,fighting,girl,boys,adventure,manhwa,chinese',
					'wp-manga-tag'         => 'tag-1,tag-2,tag-3',
				);
			
				foreach( $manga_terms as $tax => $term ){
					$resp = $this->_add_manga_terms( $manga_id, $term, $tax );
				}
		
				// insert chapters
				$this->_upload_single_chapter(array('name' => 'Chapter 1', 'extend_name' => 'Other Name 1'), $manga_id);
				$this->_upload_single_chapter(array('name' => 'Chapter 2', 'extend_name' => 'Other Name 2'), $manga_id);
				$this->_upload_single_chapter(array('name' => 'Chapter 3', 'extend_name' => 'Other Name 3'), $manga_id);
				$this->_upload_single_chapter(array('name' => 'Chapter 4', 'extend_name' => 'Other Name 4'), $manga_id);
			}
		
			$this->_update_post_views( $manga_id, 1000 );
			$this->_update_ratings( $manga_id, array('avg' => 5, 'numbers' => 1000) );
		
			wp_send_json_success( ['message' => 'Sample data installed. Please remove "/sample-data" folder in your theme', 'data' => $message] );
		}
		
		function _upload_single_chapter( $chapter, $post_id ){		
			// Prepare
			global $wp_manga, $wp_manga_storage;
			$uniqid = $wp_manga->get_uniqid( $post_id );
			
			$slugified_name = $wp_manga_storage->slugify( $chapter['name'] );
			
			// Download images
			$extract = WP_MANGA_DATA_DIR . $uniqid . '/' . $slugified_name;
		
			if( ! file_exists( $extract ) ){
				if( ! wp_mkdir_p( $extract ) ){
					error_log_die([
						'function' => __FUNCTION__,
						'message'  => "Cannot make dir $extract",
						'cancel'   => true,
					]);
				}
			}
		
			$extract_uri = WP_MANGA_DATA_URL;
		
			$this->_folder_copy(dirname(__FILE__) . '/chapter-images', $extract);
		
			// Create Chapter
			$chapter_args = array(
				'post_id'             => $post_id,
				'volume_id'           => 0,
				'chapter_name'        => $chapter['name'],
				'chapter_name_extend' => $chapter['extend_name'],
				'chapter_slug'        => $slugified_name,
			);
		
			$storage = 'local';
			
			//upload chapter to cloud in case of crawl single
			$result = $wp_manga_storage->wp_manga_upload_single_chapter( $chapter_args, $extract, $extract_uri, $storage );
			
			return $result;
		
		}
		
		function _folder_copy($src, $dst) { 
		  
			// open the source directory
			$dir = opendir($src); 
		  
			// Make the destination directory if not exist
			@mkdir($dst); 
		  
			// Loop through the files in source directory
			while( $file = readdir($dir) ) { 
		  
				if (( $file != '.' ) && ( $file != '..' )) { 
					if ( is_dir($src . '/' . $file) ) 
					{ 
		  
						// Recursively calling custom copy function
						// for sub directory 
						custom_copy($src . '/' . $file, $dst . '/' . $file); 
		  
					} 
					else { 
						copy($src . '/' . $file, $dst . '/' . $file); 
					} 
				} 
			} 
		  
			closedir($dir);
		}
		
		function _add_manga_terms( $post_id, $terms, $taxonomy ){
		
		
		
			$terms = explode(',', $terms);
		
			if( empty( $terms ) ){
				return false;
			}
		
			$taxonomy_obj = get_taxonomy( $taxonomy );
		
			if( $taxonomy_obj->hierarchical ){
		
				$output_terms = array();
		
				foreach( $terms as $current_term ){
		
					if( empty( $current_term ) ){
						continue;
					}
		
					//check if term is exist
					$term = term_exists( $current_term, $taxonomy );
		
					//then add if it isn't
					if( ! $term || is_wp_error( $term ) ){
						$term = wp_insert_term( $current_term, $taxonomy );
						if( !is_wp_error( $term ) && isset( $term['term_id'] ) ){
							$term = intval( $term['term_id'] );
		
						}else{
							continue;
						}
					}else{
						$term = intval( $term['term_id'] );
					}
		
					$output_terms[] = $term;
				}
		
				$terms = $output_terms;
			}
		
			$resp = wp_set_post_terms( $post_id, $terms, $taxonomy );
		
			return $resp;
		
		}
		
		function _update_post_views( $post_id, $views ){
		
			$month = date('m');
		
			update_post_meta( $post_id, '_wp_manga_month_views', array(
				'date' => $month,
				'views' => $views
			) );
			
			update_post_meta( $post_id, '_wp_manga_views', $views );
			
			$new_year_views = array( 'views' => $views, 'date' => date('y') );
			update_post_meta( $post_id, '_wp_manga_year_views', $new_year_views );
			update_post_meta( $post_id, '_wp_manga_year_views_value', $views ); // clone to sort by value
		
		}
		
		function _update_ratings( $post_id, $ratings = array() ){
		
			if( empty( $ratings ) || !isset( $ratings['avg'] ) || !isset( $ratings['numbers'] ) ){
				return false;
			}
		
			extract( $ratings );
		
			$totals = intval( (float)trim($avg) * (float)$numbers );
			$int_avg_totals = intval( $avg ) * $numbers;
		
			$above_avg_numbers = $totals - $int_avg_totals;
			$int_avg_numbers = $numbers - $above_avg_numbers;
		
			$rates = array();
		
			for( $i = 1; $i <= $above_avg_numbers; $i++ ){
				$rates[] = intval( $avg + 1 );
			}
		
			for( $i = 1; $i <= $int_avg_numbers; $i++ ){
				$rates[] = intval( $avg );
			}
		
			update_post_meta( $post_id, '_manga_avarage_reviews', $avg );
			update_post_meta( $post_id, '_manga_reviews', $rates );
		
			return true;
		}
		
		function _upload_thumb($url, $post_id = 0){
			include_once( ABSPATH . 'wp-admin/includes/image.php' );
			$content = file_get_contents( $url );
		
			$pathinfo = pathinfo( $url );
		
			if( ! $content ){
				return false;
			}
		
			$upload_dir = wp_upload_dir();
		
			if( ! file_exists( $upload_dir['basedir'] . '/images' ) ){
				if( ! wp_mkdir_p( $upload_dir['basedir'] . '/images' ) ){
					error_log_die([
						'function' => __FUNCTION__,
						'message'  => "Cannot make dir $extract",
						'cancel'   => true,
					]);
				}
			}
		
			$file_tmp_path = $upload_dir['basedir'] . '/images/' . $pathinfo['filename'] . '-' . $post_id . '.' . explode('?',$pathinfo['extension'])[0];
		
			$file = file_put_contents( $file_tmp_path, $content );
		
			$wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
		
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => $post_id,
				'post_content' => '',
				'post_status' => 'inherit'
			);
		
			$attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
		
			$imagenew = get_post( $attach_id );
			$fullsizepath = get_attached_file( $imagenew->ID );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
			wp_update_attachment_metadata( $attach_id, $attach_data );
		
			return $attach_id;
		}
		
		function _import_thememod($options){
			// Default message.
			$message = 'failed';
		
			$decoded  = base64_decode( $options ); // phpcs:ignore
			
			// Convert the options to an array.
			$options = maybe_unserialize( $decoded );
			
			if ( $options ) {
				$options = (array)$options;
				/*
				$options['copyright'] = 'Madara WordPress Theme by Mangabooth.com';
				$options = serialize($options);
				$encoded = base64_encode($options);
				echo $encoded;exit;*/
		
				$options_safe = array();
		
				// Get settings array.
				$settings = get_option( apply_filters( 'ot_options_id', 'option_tree' ) );
		
				// Has options.
				if ( is_array( $options ) ) {
					foreach($options as $option => $val){
						if($val == 'on'){
							$val = 1;
						} else if($val == 'off'){
							$val = 0;
						}
						set_theme_mod($option, $val);
					}
		
					$message = 'success';
				}
			}
		
			return $message;
		}
		
		/**
		 * Import widget JSON data
		 *
		 * @since 0.4
		 * @global array $wp_registered_sidebars
		 * @param object $data JSON widget data from .wie file.
		 * @return array Results array
		 */
		function wie_import_data($data)
		{
			global $wp_registered_sidebars;
	
			// Have valid data?
			// If no data or could not decode.
			if (empty($data) || ! is_object($data)) {
				$message = esc_html__('Import data is invalid.', 'madara');
				wp_send_json_error( ['message' => $message, 'data' => $message] );
			}
	
			// Hook before import.
			do_action('wie_before_import');
			$data = apply_filters('wie_import_data', $data);
	
			// Get all available widgets site supports.
			$available_widgets = $this->wie_available_widgets();
	
			// Get all existing widget instances.
			$widget_instances = array();
			foreach ($available_widgets as $widget_data) {
				$widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
			}
	
			// clean existing widgets
			$sidebars_widgets = get_option('sidebars_widgets');
			foreach($sidebars_widgets as $id => $widgets){
				$sidebars_widgets[$id] = array();
			}
			update_option('sidebars_widgets', $sidebars_widgets);
	
			// Begin results.
			$results = array();
	
			// Loop import data's sidebars.
			foreach ($data as $sidebar_id => $widgets) {
				// Skip inactive widgets (should not be in export file).
				if ('wp_inactive_widgets' === $sidebar_id) {
					continue;
				}
	
				// Check if sidebar is available on this site.
				// Otherwise add widgets to inactive, and say so.
				if (isset($wp_registered_sidebars[$sidebar_id])) {
					$sidebar_available    = true;
					$use_sidebar_id       = $sidebar_id;
					$sidebar_message_type = 'success';
					$sidebar_message      = '';
				} else {
					$sidebar_available    = false;
					$use_sidebar_id       = 'wp_inactive_widgets'; // Add to inactive if sidebar does not exist in theme.
					$sidebar_message_type = 'error';
					$sidebar_message      = esc_html__('Widget area does not exist in theme (using Inactive)', 'widget-importer-exporter');
				}
	
				// Result for sidebar
				// Sidebar name if theme supports it; otherwise ID.
				$results[$sidebar_id]['name']         = ! empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id;
				$results[$sidebar_id]['message_type'] = $sidebar_message_type;
				$results[$sidebar_id]['message']      = $sidebar_message;
				$results[$sidebar_id]['widgets']      = array();
	
				// Loop widgets.
				foreach ($widgets as $widget_instance_id => $widget) {
					$fail = false;
	
					// Get id_base (remove -# from end) and instance ID number.
					$id_base            = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
					$instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);
	
					// Does site support this widget?
					if (! $fail && ! isset($available_widgets[$id_base])) {
						$fail                = true;
						$widget_message_type = 'error';
						$widget_message      = esc_html__('Site does not support widget', 'widget-importer-exporter'); // Explain why widget not imported.
					}
	
					// Filter to modify settings object before conversion to array and import
					// Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
					// Ideally the newer wie_widget_settings_array below will be used instead of this.
					$widget = apply_filters('wie_widget_settings', $widget);
	
					// Convert multidimensional objects to multidimensional arrays
					// Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
					// Without this, they are imported as objects and cause fatal error on Widgets page
					// If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
					// It is probably much more likely that arrays are used than objects, however.
					$widget = json_decode(wp_json_encode($widget), true);
	
					// Filter to modify settings array
					// This is preferred over the older wie_widget_settings filter above
					// Do before identical check because changes may make it identical to end result (such as URL replacements).
					$widget = apply_filters('wie_widget_settings_array', $widget);
					
					// No failure.
					if (! $fail) {
						// Add widget instance
						$single_widget_instances   = get_option('widget_' . $id_base); // All instances for that widget ID base, get fresh every time.
						$single_widget_instances   = ! empty($single_widget_instances) ? $single_widget_instances : array(
							'_multiwidget' => 1,   // Start fresh if have to.
						);
						$single_widget_instances[] = $widget; // Add it.
	
						// Get the key it was given.
						end($single_widget_instances);
						$new_instance_id_number = key($single_widget_instances);
	
						// If key is 0, make it 1
						// When 0, an issue can occur where adding a widget causes data from other widget to load,
						// and the widget doesn't stick (reload wipes it).
						if ('0' === strval($new_instance_id_number)) {
							$new_instance_id_number = 1;
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							unset($single_widget_instances[0]);
						}
	
						// Move _multiwidget to end of array for uniformity.
						if (isset($single_widget_instances['_multiwidget'])) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							unset($single_widget_instances['_multiwidget']);
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}
	
						// Update option with new widget.
						update_option('widget_' . $id_base, $single_widget_instances);
	
						// Assign widget instance to sidebar.
						// Which sidebars have which widgets, get fresh every time.
						$sidebars_widgets = get_option('sidebars_widgets');
	
						// Avoid rarely fatal error when the option is an empty string
						// https://github.com/churchthemes/widget-importer-exporter/pull/11.
						if (! $sidebars_widgets) {
							$sidebars_widgets = array();
						}
	
						// Use ID number from new widget instance.
						$new_instance_id = $id_base . '-' . $new_instance_id_number;
	
						// Add new instance to sidebar.
						$sidebars_widgets[$use_sidebar_id][] = $new_instance_id;
	
						// Save the amended data.
						update_option('sidebars_widgets', $sidebars_widgets);
	
						// After widget import action.
						$after_widget_import = array(
							'sidebar'           => $use_sidebar_id,
							'sidebar_old'       => $sidebar_id,
							'widget'            => $widget,
							'widget_type'       => $id_base,
							'widget_id'         => $new_instance_id,
							'widget_id_old'     => $widget_instance_id,
							'widget_id_num'     => $new_instance_id_number,
							'widget_id_num_old' => $instance_id_number,
						);
						do_action('wie_after_widget_import', $after_widget_import);
	
						// Success message.
						if ($sidebar_available) {
							$widget_message_type = 'success';
							$widget_message      = esc_html__('Imported', 'widget-importer-exporter');
						} else {
							$widget_message_type = 'warning';
							$widget_message      = esc_html__('Imported to Inactive', 'widget-importer-exporter');
						}
					}
	
					// Result for widget instance
					$results[$sidebar_id]['widgets'][$widget_instance_id]['name']         = isset($available_widgets[$id_base]['name']) ? $available_widgets[$id_base]['name'] : $id_base;      // Widget name or ID if name not available (not supported by site).
					$results[$sidebar_id]['widgets'][$widget_instance_id]['title']        = ! empty($widget['title']) ? $widget['title'] : esc_html__('No Title', 'widget-importer-exporter');  // Show "No Title" if widget instance is untitled.
					$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
					$results[$sidebar_id]['widgets'][$widget_instance_id]['message']      = $widget_message;
				}
			}
	
			// Hook after import.
			do_action('wie_after_import');
	
			// Return results.
			return apply_filters('wie_import_results', $results);
		}
		
		/**
		 * Available widgets
		 *
		 * Gather site's widgets into array with ID base, name, etc.
		 * Used by export and import functions.
		 *
		 * @since 0.4
		 * @global array $wp_registered_widget_updates
		 * @return array Widget information
		 */
		function wie_available_widgets()
		{
			global $wp_registered_widget_controls;
	
			$widget_controls = $wp_registered_widget_controls;
	
			$available_widgets = array();
	
			foreach ($widget_controls as $widget) {
				// No duplicates.
				if (! empty( $widget['id_base'] ) && ! isset( $available_widgets[ $widget['id_base'] ] )) {
					$available_widgets[ $widget['id_base'] ]['id_base'] = $widget['id_base'];
					$available_widgets[ $widget['id_base'] ]['name']    = $widget['name'];
				}
			}
	
			return apply_filters( 'wie_available_widgets', $available_widgets );
		}
		
		function _sample_data_page(){
			?>
			<style type="text/css">
				#page-sample-data, #page-sample-data p{font-size:14px}
				#page-sample-data .btn{display:inline-block;padding:3px 10px;background:#007cba;color:#FFF;font-size:14px}
				#page-sample-data .btn i{display: none}
				#page-sample-data .btn:hover{background:#006ba1; color:#FFF}
				#page-sample-data .btn.loading{background:#999;border:none}
				#page-sample-data .btn.loading i{display: inline-block;}
				#page-sample-data ul{list-style-type: disc;padding-left:15px}
			</style>
			<div id="page-sample-data">
				<h3 style="margin: 40px 0">Install sample data for Madara</h3>
				<p>Demo Page: <a href="https://live.mangabooth.com/" target="_blank">Madara Demo Page</a></p>
				<p><a href="javascript:void(0)" class="btn" onclick="madara_install_sampledata(this)"><i class="fas fa-spinner fa-spin"></i> Click here</a></p>
				
				<p><strong>Notes:</strong>
					<ul>
						<li>New data will be imported each time running the Sample Data installation</li>
						<li>Make sure to run only on a fresh site because existing settings will be replaced</li>
					</ul>
				</p>
			</div>
			<script type="text/javascript">
				function madara_install_sampledata(obj){
					if(!jQuery(obj).hasClass('loading')){
						jQuery(obj).addClass('loading');
						jQuery.ajax({
							method : 'POST',
							url : ajaxurl,
							data : {
								action: 'madara_install_data'
							},
							success : function( response ){
								var data = response.data;
								console.log(data.data);
								alert(data.message);
								jQuery('#page-sample-data .btn').after("<p>View <a href='/'>your site</a> now</p>")
							},
							error: function(err){
								console.log(err);
								alert("error");
							},
							complete: function(){
								jQuery(obj).removeClass('loading');
							}
						});
					}
					
					return false;
				}
			</script>
			<?php
		}
	}
}