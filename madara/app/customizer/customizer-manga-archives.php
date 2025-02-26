<?php
add_action( 'customize_register', 'madara_customize_register_manga_archives' );
function madara_customize_register_manga_archives( $wp_customize ) {
    $section = 'manga_archives';

    $wp_customize->add_section( $section , array(
        'title'      => esc_html__( 'Manga Archives', 'madara' ),
        'priority'   => 18,
    ) );

    $arr_settings = array(
        'manga_archive_breadcrumb' => 'on'
    );

    $arr_settings = array_merge($arr_settings, madara_background_control_properties('manga_archive_breadcrumb_background'));

    $arr_settings = array_merge($arr_settings, array(
        'manga_archive_breadcrumb_background' => '',
        'manga_archive_heading' => '',
        'manga_archive_genres' => 'on',
        'manga_archive_genres_collapse' => 'on',
        'manga_archive_genres_title' => 'Genres',
        'manga_archive_sidebar' => 'right',
        'manga_archives_item_layout' => 'default',
        'manga_archives_item_mobile_width' => '50',
        'manga_single_allow_thumb_gif' => 'off',
        'manga_archive_latest_chapter_on_thumbnail' => 'off',
        'manga_archives_item_type_icon' => 'off',
        'manga_archives_item_type_text' => 'off',
        'manga_badge_position' => '1',
        'manga_archive_limit_visible_lines' => '2',
        'manga_archive_latest_chapters_visible' => '2',
        'manga_archives_item_volume' => 'on'
    ));

    foreach($arr_settings as $key => $def_value){
        $wp_customize->add_setting( $key , array(
            'default'   => $def_value,
            'transport' => 'refresh',
        ) );
    };

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archive_breadcrumb',
            array(
                'label'          => esc_html__( 'Manga Archives Header', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_breadcrumb',
                'type'           => 'select',
                'description' => esc_html__( 'Enable Header section on Manga Archives page', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );

    madara_customizer_register_background_controls($wp_customize, 'manga_archive_breadcrumb_background', esc_html__( 'Manga Archive Header Background', 'madara' ), $section);

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'manga_archive_heading',
            array(
                'label'          => esc_html__( 'Manga Archive Heading Text', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_heading',
                'type'           => 'text',
                'description' => esc_html__( 'set Heading Text for Manga Archives page. Default is "All Mangas"', 'madara' ),
            )
        )
    ); 

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archive_genres',
            array(
                'label'          => esc_html__( 'Genres on Manga Archive Page', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_genres',
                'type'           => 'select',
                'description' => esc_html__( 'Enable Genres block on Manga Archive Page Breadcrumb', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archive_genres_collapse',
            array(
                'label'          => esc_html__( 'Default Genres List appearance', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_genres_collapse',
                'type'           => 'select',
                'description' => esc_html__( 'Show or hide Genres list by default. Choose "On" to open the Genres List', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'manga_archive_genres_title',
            array(
                'label'          => esc_html__( 'Genres Block Title', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_genres_title',
                'type'           => 'text',
                'description' => esc_html__( 'Genres Block Title. Default is "GENRES"', 'madara' ),
            )
        )
    );
    
    $wp_customize->add_control(
        new Skyrocket_Image_Radio_Button_Custom_Control(
            $wp_customize,
            'manga_archive_sidebar',
            array(
                'label'          => esc_html__( 'Manga Archives Sidebar', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_sidebar',
                'type'           => 'select',
                'description' => '',
                'choices' => array(
					'full' => array(
						'image' => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-fullwidth.png' ),
						'name' => __( 'Full', 'madara' )
					),
					'left' => array(
						'image' => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-left.png' ),
						'name' => __( 'Left', 'madara' )
					),
					'right' => array(
						'image' => get_parent_theme_file_uri( '/images/options/sidebar/sidebar-right.png' ),
						'name' => __( 'Right', 'madara' )
					)
				)
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'manga_archives_item_layout',
            array(
                'label'          => esc_html__( 'Item Layout', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archives_item_layout',
                'type'           => 'select',
                'description' => esc_html__( 'Select layout for Manga Item in the list. Remember to regenerate thumbnails for existing mangas', 'madara' ),
                'choices' => array(
                    'default' => esc_html__( 'Default (Small Thumbnail)', 'madara' ),
                    'big_thumbnail' => esc_html__( 'Big Thumbnail', 'madara' ),
                    'simple' => esc_html__( 'Simple List', 'madara' ),
				),
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'manga_archives_item_layout',
            array(
                'label'          => esc_html__( 'Item Layout', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archives_item_layout',
                'type'           => 'select',
                'description' => esc_html__( 'Select layout for Manga Item in the list. Remember to regenerate thumbnails for existing mangas', 'madara' ),
                'choices' => array(
                    'default' => esc_html__( 'Default (Small Thumbnail)', 'madara' ),
                    'big_thumbnail' => esc_html__( 'Big Thumbnail', 'madara' ),
                    'simple' => esc_html__( 'Simple List', 'madara' ),
				),
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'manga_archives_item_mobile_width',
            array(
                'label'          => esc_html__( 'Item Width on Mobile Screen', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archives_item_mobile_width',
                'type'           => 'select',
                'description' => esc_html__( 'Set item width when viewing on mobile screens', 'madara' ),
                'choices' => array(
                    '50' => esc_html__( '1/2 - 50% screen width', 'madara' ),
                    '100' => esc_html__( '1/1 - 100% screen width', 'madara' )
				),
            )
        )
    );

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archive_latest_chapter_on_thumbnail',
            array(
                'label'          => esc_html__( 'Link to the Latest Chapter on thumbnail', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_latest_chapter_on_thumbnail',
                'type'           => 'select',
                'description' => esc_html__( 'Item thumbnail will link to the Latest Chapter in this series. A "Chapter Tag" will also appear on top of the thumbnail', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archives_item_type_icon',
            array(
                'label'          => esc_html__( 'Manga Type Icon', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archives_item_type_icon',
                'type'           => 'select',
                'description' => esc_html__( 'If your site has different types of manga (Comic, Novel, Drama) and you need an icon to differentiate those, turn this on', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archives_item_type_text',
            array(
                'label'          => esc_html__( 'Manga Type Text', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archives_item_type_text',
                'type'           => 'select',
                'description' => esc_html__( 'Showing Manga Type value or not', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'manga_badge_position',
            array(
                'label'          => esc_html__( 'Badge Position', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_badge_position',
                'type'           => 'select',
                'description' => esc_html__( 'Choose where to show the badge', 'madara' ),
                'choices' => array(
                    1 => esc_html__( 'Before title', 'madara' ),
                    2 => esc_html__( 'Before thumbnail', 'madara' ),
				),
            )
        )
    );

    $wp_customize->add_control(
        new Skyrocket_Slider_Custom_Control($wp_customize,
            'manga_archive_limit_visible_lines',
            array(
                'label'          => esc_html__( 'Limit Visible Titles', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_limit_visible_lines',
                'type'           => 'slider_control',
                'input_attrs' => array(
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                ),
                'description' => esc_html__( 'Limit number of text lines so the long title will not break the layout', 'madara' ),
            )
    ));

    $wp_customize->add_control(
        new Skyrocket_Slider_Custom_Control($wp_customize,
            'manga_archive_latest_chapters_visible',
            array(
                'label'          => esc_html__( 'Number of visible latest chapters', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archive_latest_chapters_visible',
                'type'           => 'slider_control',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 4,
                    'step' => 1,
                ),
                'description' => esc_html__( 'Choose number of visible latest chapters for each item in the list', 'madara' ),
            )
    ));

    $wp_customize->add_control(
        new Skyrocket_Toggle_Switch_Custom_control(
            $wp_customize,
            'manga_archives_item_volume',
            array(
                'label'          => esc_html__( 'Show Chapter Volume', 'madara' ),
                'section'        => $section,
                'settings'       => 'manga_archives_item_volume',
                'type'           => 'select',
                'description' => esc_html__( 'Show Chapter Volume information', 'madara' ),
                'choices' => array(
                    'off' => esc_html__( 'Off', 'madara' ),
                    'on' => esc_html__( 'On', 'madara' )
				),
            )
        )
    );
}