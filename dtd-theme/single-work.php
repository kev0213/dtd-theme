
<?php get_header(); ?>
<?php
    function checkPostType(){
		$args = null;
	
		$args = array(
				'posts_per_page'  => -1,
				'orderby'         => 'date',
				'order'           => 'DESC',
				'post_type'       => 'work',
		);
		
		return $args;
	}

	$postlist_args = checkPostType();

    $postlist = get_posts( $postlist_args );


    $ids = array();

    foreach ($postlist as $thepost) {
        $ids[] = $thepost->ID;
    }

    // get and echo previous and next post in the same taxonomy
    $thisindex = array_search($post->ID, $ids);

	if( $thisindex-1 > -1 ){
		$previd = get_permalink($ids[$thisindex-1]);
	}
	if( $thisindex+1 <= count($ids) ){
    	$nextid = get_permalink($ids[$thisindex+1]);
	}

?>
<div class="work-post">
    <h1>work post</h1>
    <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();

            the_content();
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
    ?>
    <?php 
    $images = get_field('Workimgs');
    if( $images ): ?>
        <ul>
            <?php foreach( $images as $image ): ?>
                <li>
                    <a href="<?php echo $image['url']; ?>">
                        <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>



    <div class="groups">
    <?php 
    if( !empty($previd) ){ ?>
		<div class="prev-button"><a href="<?php echo $previd; ?>"> < </a></div>
	<?php } 
	if( !empty($nextid) ){ ?>
		<div class="next-button"><a href="<?php echo $nextid; ?>"> > </a></div>
	<?php } ?>
    </div>
</div>
<?php get_footer(); ?>