<?php if ( !defined( 'ABSPATH' ) ) exit();

if( isset( $args['id'] ) ){
	$id = $args['id'];
}else{
	$id = get_the_id();	
}


$ovaev_start_date = get_post_meta( $id, 'ovaev_start_date_time', true );

$date_event    = $ovaev_start_date != '' ? date_i18n('d', $ovaev_start_date ) : '';
$month_event_M = $ovaev_start_date != '' ? date_i18n('M', $ovaev_start_date ) : '';
$week_day      = $ovaev_start_date != '' ? date_i18n('D', $ovaev_start_date ) : '';

?>

<div class="date-event">
	<span class="date-month second_font">

		<?php  echo esc_html( $week_day );?>,

		<?php  echo esc_html( $month_event_M );?>

		<?php  echo esc_html( $date_event );?>
		
		

	</span>
					
</div>