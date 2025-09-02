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
    // Remove the original path
    unset($paths[0]);
    
    // Add our custom path
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