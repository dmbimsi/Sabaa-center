<?php 

$get_search = isset( $_GET["search_event"] ) ? $_GET["search_event"] : '';

/* Search Event */
if( $get_search == 'search-event' ){

	$events = apply_filters( 'OVAEV_search_event', $_REQUEST );

} else {

	$events = apply_filters( 'OVAEV_event', 10 );
}


?>

<div class="container-event">
	
	<!-- Search form template -->
	<?php do_action( 'ovaev_search_form' ); ?>

	<div class="archive_event three-columns">
		<div class="wp-archive-event">
			<?php if($events->have_posts() ) : while ( $events->have_posts() ) : $events->the_post(); ?>
				
				<?php ovaev_get_template( 'event-grid-content.php' ) ?>

			<?php endwhile; 
			else: ?>
				<div class="search_not_found">
					<?php esc_html_e( 'Not Found Events', 'ovaev' ); ?>
				</div>
			<?php endif; wp_reset_postdata(); ?>
		</div>
	</div>
	<?php ovaev_pagination_plugin($events); ?>

</div>
