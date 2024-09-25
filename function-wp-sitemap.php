<?php

/** @package wp-bk-2024 */

if (!defined('ABSPATH')) die('Restricted Area');

#########################################################################################
/// SITE MAPS XML = Function to create sitemap.xml file in root directory of site
#########################################################################################

add_action("publish_post", "xml_sitemap");
add_action("publish_page", "xml_sitemap");

function xml_sitemap()
{
    $postsForSitemap = get_posts(array(
        'numberposts' => 9999, /// '-1' is possible
        'orderby' => 'modified',
        'post_type'  => array('post', 'page', 'date'), /// Add a CPT Date
        'post_status' => 'publish',
        'order'    => 'DESC'
    ));

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
    $sitemap .= ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9';
    $sitemap .= ' http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"';
    $sitemap .= ' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    $sitemap .= '<url>';
    $sitemap .= '<loc>' . esc_url(home_url('/')) . '</loc>';
    $sitemap .= '<lastmod>' . date("Y-m-d\TH:i:s", current_time('timestamp', 0)) . '</lastmod>';
    $sitemap .= '<changefreq>daily</changefreq>';
    $sitemap .= '<priority>1</priority>';
    $sitemap .= '</url>';

    foreach ($postsForSitemap as $post) {

        setup_postdata($post);
        $postdate = explode(" ", $post->post_modified);
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . get_permalink($post->ID) . '</loc>';
        $sitemap .= '<lastmod>' . $postdate[0] . 'T' . $postdate[1] . '</lastmod>';
        $sitemap .= '<changefreq>weekly</changefreq>';
        $sitemap .= '<priority>0.5</priority>';
        $sitemap .= '</url>';
    }
    $sitemap .= '</urlset>';
    $fp = fopen(ABSPATH . "sitemap.xml", 'w');
    fwrite($fp, $sitemap);
    fclose($fp);
}
