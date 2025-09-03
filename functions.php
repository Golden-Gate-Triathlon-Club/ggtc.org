<?php
/**
 * GGTC Theme Functions
 * 
 * @package GGTC
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF JSON Sync
 * Saves ACF field definitions as JSON files in the theme directory
 */
function ggtc_acf_json_save_point($path) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'ggtc_acf_json_save_point');

/**
 * ACF JSON Load Point
 * Loads ACF field definitions from JSON files in the theme directory
 */
function ggtc_acf_json_load_point($paths) {
    // Add our custom path without removing the original
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    return $paths;
}
add_filter('acf/settings/load_json', 'ggtc_acf_json_load_point');

/**
 * Theme Setup
 */
function ggtc_theme_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ggtc'),
        'footer' => __('Footer Menu', 'ggtc'),
    ));
}
add_action('after_setup_theme', 'ggtc_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function ggtc_enqueue_scripts() {
    // Enqueue your theme's main stylesheet
    wp_enqueue_style('ggtc-style', get_stylesheet_uri());
    
    // Enqueue your compiled CSS from the build process
    wp_enqueue_style('ggtc-main', get_template_directory_uri() . '/docs/assets/css/global.css');
    
    // Enqueue jQuery (if needed)
    wp_enqueue_script('jquery');
    
    // Enqueue your custom scripts
    // wp_enqueue_script('ggtc-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'ggtc_enqueue_scripts');

/**
 * Custom Post Types (if needed)
 */
// function ggtc_register_post_types() {
//     // Register your custom post types here
// }
// add_action('init', 'ggtc_register_post_types');

/**
 * Custom Taxonomies (if needed)
 */
// function ggtc_register_taxonomies() {
//     // Register your custom taxonomies here
// }
// add_action('init', 'ggtc_register_taxonomies');




/**
 * Add Google Fonts to WordPress Admin Head
 * This ensures fonts are available in TinyMCE iframe
 */
function ggtc_admin_fonts() {
    if (is_admin()) {
        echo '<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">';
        echo '<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">';
    }
}
add_action('admin_head', 'ggtc_admin_fonts');

/**
 * TinyMCE Customization
 */
add_filter('tiny_mce_before_init', function ($mce_init) {
    $custom_css = get_stylesheet_directory_uri() . '/docs/assets/css/tinymce.css'; // Your custom CSS file path
    
    if (isset($mce_init['content_css'])) {
        $mce_init['content_css'] .= ',' . $custom_css;
    } else {
        $mce_init['content_css'] = $custom_css;
    }

    // Manually build the JS array string for textcolor_map
    $palette = "[
        'dd2b2e', 'Red',
        '0071bc', 'Blue',
        '231f20', 'Black',
        'fffff', 'White',
    ]";

    // Assign the JS array string directly, not JSON encoded
    $mce_init['textcolor_map'] = $palette;

    // Disable custom colors to restrict selection to the palette
    $mce_init['custom_colors'] = false;

    // Ensure fonts are available in TinyMCE iframe
    $mce_init['font_formats'] = 'Barlow Condensed=Barlow Condensed, sans-serif; Roboto=Roboto, sans-serif; Arial=arial,helvetica,sans-serif; Times New Roman=times new roman,times,serif; Courier New=courier new,courier,monospace';

    // Customize block formats - remove H5, H6, and Preformatted
    $mce_init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4';

    // Add Google Fonts to TinyMCE iframe head and prevent empty paragraphs
    $mce_init['setup'] = 'function(ed) {
        ed.on("init", () => {
            const iframe = ed.getContainer().querySelector("iframe");
            if (iframe?.contentDocument) {
                const { head } = iframe.contentDocument;
                
                const link1 = iframe.contentDocument.createElement("link");
                link1.href = "https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap";
                link1.rel = "stylesheet";
                head.appendChild(link1);
                
                const link2 = iframe.contentDocument.createElement("link");
                link2.href = "https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap";
                link2.rel = "stylesheet";
                head.appendChild(link2);
            }
        });
        
        // Prevent empty paragraphs and clean up existing ones
        ed.on("BeforeSetContent", (e) => {
            // Remove empty paragraphs with &nbsp; or just whitespace
            e.content = e.content.replace(/<p[^>]*>(\s|&nbsp;)*<\/p>/gi, "");
            e.content = e.content.replace(/<p[^>]*>\s*<\/p>/gi, "");
            e.content = e.content.replace(/<p[^>]*>[\r\n\s]*<\/p>/gi, "");
            e.content = e.content.replace(/(<p[^>]*>(\s|&nbsp;)*<\/p>\s*){2,}/gi, "");
        });
        
        // Clean up content when saving
        ed.on("SaveContent", (e) => {
            // Remove empty paragraphs with &nbsp; or just whitespace
            e.content = e.content.replace(/<p[^>]*>(\s|&nbsp;)*<\/p>/gi, "");
            e.content = e.content.replace(/<p[^>]*>\s*<\/p>/gi, "");
            e.content = e.content.replace(/<p[^>]*>[\r\n\s]*<\/p>/gi, "");
            e.content = e.content.replace(/(<p[^>]*>(\s|&nbsp;)*<\/p>\s*){2,}/gi, "");
        });
        
        // Clean up on paste
        ed.on("PastePostProcess", (e) => {
            e.node.innerHTML = e.node.innerHTML.replace(/<p[^>]*>(\s|&nbsp;)*<\/p>/gi, "");
            e.node.innerHTML = e.node.innerHTML.replace(/<p[^>]*>\s*<\/p>/gi, "");
            e.node.innerHTML = e.node.innerHTML.replace(/<p[^>]*>[\r\n\s]*<\/p>/gi, "");
        });
        
        // Prevent creation of empty paragraphs on Enter key
        ed.on("keydown", (e) => {
            if (e.keyCode === 13) { // Enter key
                const selection = ed.selection;
                const node = selection.getNode();
                
                // If current paragraph is empty, prevent creating another empty one
                if (node?.nodeName === "P" && (node.innerHTML.trim() === "" || node.innerHTML === "&nbsp;")) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    }';

    return $mce_init;
});

/**
 * Clean up empty paragraphs in content
 * Removes <p>&nbsp;</p> and other empty paragraph variations
 */
function ggtc_clean_empty_paragraphs($content) {
    if (empty($content)) {
        return $content;
    }
    
    // Remove empty paragraphs with &nbsp; or just whitespace
    $content = preg_replace('/<p[^>]*>(\s|&nbsp;)*<\/p>/i', '', $content);
    $content = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $content);
    
    // Remove multiple consecutive empty paragraphs
    $content = preg_replace('/(<p[^>]*>(\s|&nbsp;)*<\/p>\s*){2,}/i', '', $content);
    
    // Remove empty paragraphs with only line breaks
    $content = preg_replace('/<p[^>]*>[\r\n\s]*<\/p>/i', '', $content);
    
    // Clean up any remaining whitespace between tags
    $content = preg_replace('/>\s+</', '><', $content);
    
    return $content;
}

// Apply the filter to post content
add_filter('the_content', 'ggtc_clean_empty_paragraphs');

// Apply the filter to ACF WYSIWYG fields (for get_sub_field)
add_filter('acf/format_value/type=wysiwyg', 'ggtc_clean_empty_paragraphs');

// Apply the filter to ACF WYSIWYG fields (for the_sub_field)
add_filter('acf/load_value/type=wysiwyg', 'ggtc_clean_empty_paragraphs');

// Also apply to all ACF field outputs
add_filter('acf_the_content', 'ggtc_clean_empty_paragraphs');

// Apply to all content output (catch-all)
add_filter('acf/format_value', function($value, $post_id, $field) {
    if ($field['type'] === 'wysiwyg') {
        return ggtc_clean_empty_paragraphs($value);
    }
    return $value;
}, 10, 3);

// Additional filter for ACF sub fields
add_filter('acf/load_value/name=text_section_content', 'ggtc_clean_empty_paragraphs');
add_filter('acf/load_value/name=cta_banner_text', 'ggtc_clean_empty_paragraphs');
add_filter('acf/load_value/name=slider_text', 'ggtc_clean_empty_paragraphs');


// Allow SVG uploads in WordPress
function ggtc_allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'ggtc_allow_svg_uploads');

// Optional: Fix SVG display in media library
function ggtc_fix_svg_display() {
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'ggtc_fix_svg_display');

/**
 * Debug function to check if custom post types and taxonomies are registered
 * Remove this after debugging
 */
function ggtc_debug_post_types() {
    if (current_user_can('manage_options') && isset($_GET['debug_post_types'])) {
        echo '<h3>Registered Post Types:</h3>';
        $post_types = get_post_types(array('public' => true), 'objects');
        foreach ($post_types as $post_type) {
            echo '<p><strong>' . $post_type->name . '</strong>: ' . $post_type->label . '</p>';
        }
        
        echo '<h3>Registered Taxonomies:</h3>';
        $taxonomies = get_taxonomies(array('public' => true), 'objects');
        foreach ($taxonomies as $taxonomy) {
            echo '<p><strong>' . $taxonomy->name . '</strong>: ' . $taxonomy->label . '</p>';
        }
        
        echo '<h3>Sponsor Posts:</h3>';
        $sponsors = get_posts(array(
            'post_type' => 'sponsor',
            'numberposts' => -1,
            'post_status' => 'publish'
        ));
        echo '<p>Found ' . count($sponsors) . ' sponsor posts</p>';
        
        echo '<h3>Sponsor Levels:</h3>';
        $sponsor_levels = get_terms(array(
            'taxonomy' => 'sponsor-level',
            'hide_empty' => false
        ));
        if (!is_wp_error($sponsor_levels)) {
            echo '<p>Found ' . count($sponsor_levels) . ' sponsor levels</p>';
            foreach ($sponsor_levels as $level) {
                echo '<p>- ' . $level->name . ' (' . $level->slug . ')</p>';
            }
        } else {
            echo '<p>Error: ' . $sponsor_levels->get_error_message() . '</p>';
        }
    }
}
add_action('wp_footer', 'ggtc_debug_post_types');

/**
 * Force refresh permalinks on theme activation
 */
function ggtc_flush_rewrite_rules() {
    // Force flush rewrite rules to register custom post types
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ggtc_flush_rewrite_rules');

/**
 * Additional debugging for ACF JSON loading
 */
function ggtc_debug_acf_json() {
    if (current_user_can('manage_options') && isset($_GET['debug_acf'])) {
        echo '<h3>ACF JSON Debug:</h3>';
        
        // Check if ACF is active
        if (function_exists('acf_get_setting')) {
            echo '<p>ACF Plugin: Active</p>';
            
            // Check JSON paths
            $json_paths = acf_get_setting('load_json');
            echo '<p>ACF JSON Paths:</p><ul>';
            foreach ($json_paths as $path) {
                echo '<li>' . $path . '</li>';
            }
            echo '</ul>';
            
            // Check if our path exists
            $our_path = get_stylesheet_directory() . '/acf-json';
            echo '<p>Our ACF JSON Path: ' . $our_path . '</p>';
            echo '<p>Path exists: ' . (file_exists($our_path) ? 'Yes' : 'No') . '</p>';
            
            if (file_exists($our_path)) {
                $files = scandir($our_path);
                echo '<p>Files in directory:</p><ul>';
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        echo '<li>' . $file . '</li>';
                    }
                }
                echo '</ul>';
            }
        } else {
            echo '<p>ACF Plugin: NOT ACTIVE</p>';
        }
    }
}
add_action('wp_footer', 'ggtc_debug_acf_json');

/**
 * Show all sponsors on archive page (no pagination)
 */
function ggtc_show_all_sponsors($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('sponsor')) {
            $query->set('posts_per_page', -1);
        }
    }
}
add_action('pre_get_posts', 'ggtc_show_all_sponsors');

/**
 * Check if user is logged in (for use in if statements)
 * Usage: if (ggtc_is_logged_in()) { // show content }
 */
function ggtc_is_logged_in() {
    return is_user_logged_in();
}

/**
 * Conditional content wrapper for logged-in users
 * Usage: ggtc_logged_in_content('Your content here', 'Custom login message');
 */
function ggtc_logged_in_content($content, $login_message = null) {
    if (is_user_logged_in()) {
        return $content;
    } else {
        $default_message = 'Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to view this content.';
        $message = $login_message ?: $default_message;
        
        return '<div class="login-required">' . $message . '</div>';
    }
}

/**
 * Basic Breadcrumb Function
 * Displays breadcrumb navigation for the current page
 */
function the_breadcrumb() {
    $separator = ' / ';
    $home_title = 'Home';
    
    // Get the home URL
    $home_url = home_url('/');
    
    // Start building the breadcrumb
    $breadcrumb = '<nav class="breadcrumb-nav" aria-label="Breadcrumb">';
    $breadcrumb .= '<ol class="breadcrumb-list">';
    
    // Always start with Home
    $breadcrumb .= '<li class="breadcrumb-item breadcrumb-home">';
    $breadcrumb .= '<a href="' . esc_url($home_url) . '" class="breadcrumb-link">' . esc_html($home_title) . '</a>';
    $breadcrumb .= '</li>';
    
    // Check if we're on the home page
    if (is_front_page()) {
        // Don't add anything else for home page
    } elseif (is_home()) {
        // Blog page
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">Blog</span>';
        $breadcrumb .= '</li>';
    } elseif (is_page()) {
        // Regular page
        $page_id = get_the_ID();
        $ancestors = get_post_ancestors($page_id);
        
        // Add parent pages in reverse order
        if ($ancestors) {
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor_id) {
                $breadcrumb .= '<li class="breadcrumb-item">';
                $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
                $breadcrumb .= '<a href="' . esc_url(get_permalink($ancestor_id)) . '" class="breadcrumb-link">';
                $breadcrumb .= esc_html(get_the_title($ancestor_id));
                $breadcrumb .= '</a>';
                $breadcrumb .= '</li>';
            }
        }
        
        // Add current page
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">' . esc_html(get_the_title()) . '</span>';
        $breadcrumb .= '</li>';
    } elseif (is_single()) {
        // Single post
        $post_type = get_post_type();
        
        if ($post_type === 'post') {
            // Regular blog post
            $blog_page_id = get_option('page_for_posts');
            if ($blog_page_id) {
                $breadcrumb .= '<li class="breadcrumb-item">';
                $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
                $breadcrumb .= '<a href="' . esc_url(get_permalink($blog_page_id)) . '" class="breadcrumb-link">Blog</a>';
                $breadcrumb .= '</li>';
            }
        } else {
            // Custom post type - add archive link
            $post_type_obj = get_post_type_object($post_type);
            if ($post_type_obj) {
                $archive_url = get_post_type_archive_link($post_type);
                if ($archive_url) {
                    $breadcrumb .= '<li class="breadcrumb-item">';
                    $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
                    $breadcrumb .= '<a href="' . esc_url($archive_url) . '" class="breadcrumb-link">';
                    $breadcrumb .= esc_html($post_type_obj->labels->name);
                    $breadcrumb .= '</a>';
                    $breadcrumb .= '</li>';
                }
            }
        }
        
        // Add current post
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">' . esc_html(get_the_title()) . '</span>';
        $breadcrumb .= '</li>';
    } elseif (is_category()) {
        // Category archive
        $breadcrumb .= '<li class="breadcrumb-item">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '" class="breadcrumb-link">Blog</a>';
        $breadcrumb .= '</li>';
        
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">' . esc_html(single_cat_title('', false)) . '</span>';
        $breadcrumb .= '</li>';
    } elseif (is_tag()) {
        // Tag archive
        $breadcrumb .= '<li class="breadcrumb-item">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '" class="breadcrumb-link">Blog</a>';
        $breadcrumb .= '</li>';
        
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">Tag: ' . esc_html(single_tag_title('', false)) . '</span>';
        $breadcrumb .= '</li>';
    } elseif (is_post_type_archive()) {
        // Custom post type archive
        $post_type = get_query_var('post_type');
        $post_type_obj = get_post_type_object($post_type);
        
        if ($post_type_obj) {
            $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
            $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
            $breadcrumb .= '<span class="breadcrumb-text">' . esc_html($post_type_obj->labels->name) . '</span>';
            $breadcrumb .= '</li>';
        }
    } elseif (is_search()) {
        // Search results
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">Search Results for: "' . esc_html(get_search_query()) . '"</span>';
        $breadcrumb .= '</li>';
    } elseif (is_404()) {
        // 404 page
        $breadcrumb .= '<li class="breadcrumb-item breadcrumb-current">';
        $breadcrumb .= '<span class="breadcrumb-separator">' . $separator . '</span>';
        $breadcrumb .= '<span class="breadcrumb-text">Page Not Found</span>';
        $breadcrumb .= '</li>';
    }
    
    $breadcrumb .= '</ol>';
    $breadcrumb .= '</nav>';
    
    echo $breadcrumb;
}