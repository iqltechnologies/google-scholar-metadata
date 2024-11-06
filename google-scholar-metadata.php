<?php
/*
Plugin Name: Google Scholar Metadata by IQL
Description: Adds Google Scholar indexing metadata to the header of posts.
Version: 1.1
Author: IQL Technologies
Author URI: https://iqltech.com
*/

// Include the TGM Plugin Activation library.
require_once plugin_dir_path(__FILE__) . 'class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'gsm_register_required_plugins');

function gsm_register_required_plugins() {
    $plugins = [
        [
            'name' => 'Meta Box',
            'slug' => 'meta-box',
            'required' => true,
        ],
    ];

    $config = [
        'id' => 'google-scholar-meta', 
        'default_path' => '', 
        'menu' => 'tgmpa-install-plugins', 
        'parent_slug' => 'plugins.php', 
        'capability' => 'manage_options', 
        'has_notices' => true, 
        'dismissable' => true, 
        'is_automatic' => false, 
    ];

    tgmpa($plugins, $config);
}

// Add meta tags to the header for single posts
add_action('wp_head', 'gsm_add_google_scholar_meta');

function gsm_add_google_scholar_meta() {
    if (is_single()) {
        $post_id = get_the_ID();
        $meta_data = [
            'citation_title' => get_post_meta($post_id, 'title', true),
            'citation_abstract' => get_post_meta($post_id, 'abstract', true),
            'citation_journal_title' => get_post_meta($post_id, 'citation_journal_title', true),
            'citation_pdf_url' => get_post_meta($post_id, 'citation_pdf_url', true),
            'citation_issue' => get_post_meta($post_id, 'issue', true),
            'citation_volume' => get_post_meta($post_id, 'volume', true),
            'citation_firstpage' => get_post_meta($post_id, 'firstpage', true),
            'citation_lastpage' => get_post_meta($post_id, 'lastpage', true),
            'citation_publication_date' => get_post_meta($post_id, 'publication_date', true),
        ];

        // Check for the new 'authors' field (cloneable field)
        $authors = get_post_meta($post_id, 'authors', true);

        // Output each author from the 'authors' cloneable field if it exists
        if (!empty($authors) && is_array($authors)) {
            foreach ($authors as $author) {
                if (!empty($author)) {
                    echo "<meta name=\"citation_author\" content=\"" . esc_attr($author) . "\">" . PHP_EOL;
                }
            }
        } else {
            // Fallback: Output authors from individual 'author1', 'author2', etc.
            for ($i = 1; $i <= 6; $i++) {
                $author = get_post_meta($post_id, "author$i", true);
                if (!empty($author)) {
                    echo "<meta name=\"citation_author\" content=\"" . esc_attr($author) . "\">" . PHP_EOL;
                }
            }
        }

        // Output other meta tags for filled fields
        foreach ($meta_data as $key => $value) {
            if (!empty($value)) {
                echo "<meta name=\"$key\" content=\"" . esc_attr($value) . "\">" . PHP_EOL;
            }
        }
    }
}

// Register metaboxes using Meta Box plugin
add_filter('rwmb_meta_boxes', 'gsm_register_google_scholar_meta_boxes');

function gsm_register_google_scholar_meta_boxes($meta_boxes) {
    $meta_boxes[] = [
        'id' => 'google-scholar-meta-box',
        'title' => __('Google Scholar Metadata', 'textdomain'),
        'post_types' => ['post'],
        'fields' => [
            [
                'name' => __('Title', 'textdomain'),
                'id' => 'title',
                'type' => 'text',
            ],
            [
                'name' => __('Abstract', 'textdomain'),
                'id' => 'abstract',
                'type' => 'textarea',
            ],
            [
                'name' => __('Authors', 'textdomain'),
                'id' => 'authors',
                'type' => 'text',
                'clone' => true, // Allow users to add multiple authors
                'sort_clone' => true, // Allow users to reorder authors
            ],
            [
                'name' => __('Journal Title', 'textdomain'),
                'id' => 'citation_journal_title',
                'type' => 'text',
            ],
            [
                'name' => __('PDF URL', 'textdomain'),
                'id' => 'citation_pdf_url',
                'type' => 'url',
            ],
            [
                'name' => __('Issue', 'textdomain'),
                'id' => 'issue',
                'type' => 'text',
            ],
            [
                'name' => __('Volume', 'textdomain'),
                'id' => 'volume',
                'type' => 'text',
            ],
            [
                'name' => __('First Page', 'textdomain'),
                'id' => 'firstpage',
                'type' => 'text',
            ],
            [
                'name' => __('Last Page', 'textdomain'),
                'id' => 'lastpage',
                'type' => 'text',
            ],
            [
                'name' => __('Publication Date', 'textdomain'),
                'id' => 'publication_date',
                'type' => 'date',
                'js_options' => [
                    'dateFormat' => 'yy-mm-dd',
                ],
            ],
        ],
    ];
    return $meta_boxes;
}
