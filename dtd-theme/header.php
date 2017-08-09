<!DOCTYPE html>
<html>
<head>
     <!-- 網站名稱或標題 -->
    <title itemprop="name">
        <?php
            if(is_home()){
                echo get_bloginfo('title');
            }
            else if (is_category()) {
                echo get_main_category(get_the_category()).' | '.get_bloginfo('title');
            }
            else if (is_tag()) {
                echo single_tag_title('', false).' | '.get_bloginfo('title');
            }
            else if (is_search()) {
                echo get_search_query().' | '.get_bloginfo('title');
            }
            else if (is_author()) {
                echo get_the_author().' | '.get_bloginfo('title');
            }
			else if (is_archive()) {
                echo post_type_archive_title().' | '.get_bloginfo('title');
            }
            else {
                echo the_title().' | '.get_bloginfo('title');
            }
            ?>
    </title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/dist/css/style.css">
	<meta property="fb:app_id" content="....">
	<meta property="fb:admins" content="....">
	<meta property="og:site_name" content="....">
	<meta property="og:title" content="....">
    <meta property="og:description" content="....">
    <meta property="og:image" content="....">
	<meta property="og:image:height" content="100%">
    <?php wp_head(); ?>
</head>

<body>
    <div id="app" class="container">
        