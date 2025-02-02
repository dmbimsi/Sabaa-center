<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVAEV_Admin_Settings' ) ){

	/**
	 * Make Admin Class
	 */
	class OVAEV_Admin_Settings{

		/**
		 * Construct Admin
		 */
		public function __construct(){
			add_action( 'admin_enqueue_scripts', array( $this, 'ovaev_load_media' ) );
			add_action( 'admin_init', array( $this, 'register_options' ) );
		}


		public function ovaev_load_media() {
			wp_enqueue_media();
		}


		public function print_options_section(){
			return true;
		}


		public function register_options(){

			register_setting(
				'ovaev_options_group', // Option group
				'ovaev_options', // Name Option
				array( $this, 'settings_callback' ) // Call Back
			);

			/**
			 * General Settings
			 */
			// Add Section: General Settings
			add_settings_section(
				'ovaev_general_section_id', // ID
				esc_html__('General Setting', 'ovaev'), // Title
				array( $this, 'print_options_section' ),
				'ovaev_general_settings' // Page
			);

		

			add_settings_field(
				'archive_event_format_date', // ID
				esc_html__('Date Format','ovaev'),
				array( $this, 'archive_event_format_date' ),
				'ovaev_general_settings', // Page
				'ovaev_general_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_format_time', // ID
				esc_html__('Time Format','ovaev'),
				array( $this, 'archive_event_format_time' ),
				'ovaev_general_settings', // Page
				'ovaev_general_section_id' // Section ID
			);

			add_settings_field(
				'archive_format_date_lang', // ID
				esc_html__('Calendar Language','ovaev'),
				array( $this, 'archive_format_date_lang' ),
				'ovaev_general_settings', // Page
				'ovaev_general_section_id' // Section ID
			);


			/**
			 * Basic Settings
			 */

			/** Add Section: Archive Event Settings **/
			add_settings_section(
				'ovaev_archive_event_section_id', // ID
				esc_html__('Archive Event Setting', 'ovaev'), // Title
				array( $this, 'print_options_section' ),
				'ovaev_archive_event_settings' // Page
			);

			add_settings_field(
				'archive_event_type', // ID
				esc_html__('Template','ovaev'),
				array( $this, 'archive_event_type' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'ovaev_show_past', // ID
				esc_html__('Show event in past','ovaev'),
				array( $this, 'ovaev_show_past' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_orderby', // ID
				esc_html__('Order By','ovaev'),
				array( $this, 'archive_event_orderby' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_order', // ID
				esc_html__('Order','ovaev'),
				array( $this, 'archive_event_order' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			

			

			add_settings_field(
				'archive_event_bg', // ID
				esc_html__('Header Background','ovaev'),
				array( $this, 'archive_event_bg' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_header', // ID
				esc_html__('Header','ovaev'),
				array( $this, 'archive_event_header' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);

			add_settings_field(
				'archive_event_footer', // ID
				esc_html__('Footer','ovaev'),
				array( $this, 'archive_event_footer' ),
				'ovaev_archive_event_settings', // Page
				'ovaev_archive_event_section_id' // Section ID
			);


			/** Add Section: Single Event Settings **/
			add_settings_section(
				'ovaev_single_event_section_id', // ID
				esc_html__('Single Event Setting', 'ovaev'), // Title
				array( $this, 'print_options_section' ),
				'ovaev_single_event_settings' // Page
			);

			add_settings_field(
				'single_event_bg', // ID
				esc_html__('Header Background','ovaev'),
				array( $this, 'single_event_bg' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);

			add_settings_field(
				'single_event_header', // ID
				esc_html__('Header','ovaev'),
				array( $this, 'single_event_header' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);

			add_settings_field(
				'single_event_footer', // ID
				esc_html__('Footer','ovaev'),
				array( $this, 'single_event_footer' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);

			add_settings_field(
				'google_key_map', // ID
				esc_html__('Google Key Map','ovaev'),
				array( $this, 'google_key_map' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);

			add_settings_field(
				'event_map_zoom', // ID
				esc_html__('Google Map Zoom','ovaev'),
				array( $this, 'event_map_zoom' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);


			add_settings_field(
				'ovaev_show_title', // ID
				esc_html__('Show title in single','ovaev'),
				array( $this, 'ovaev_show_title' ),
				'ovaev_single_event_settings', // Page
				'ovaev_single_event_section_id' // Section ID
			);


		}

		public function settings_callback( $input ){

			$new_input = array();

			

			if( isset( $input['single_event_bg'] ) )
				$new_input['single_event_bg'] = sanitize_text_field( $input['single_event_bg'] ) ? sanitize_text_field( $input['single_event_bg'] ) : '';

			if( isset( $input['single_event_header'] ) )
				$new_input['single_event_header'] = sanitize_text_field( $input['single_event_header'] ) ? sanitize_text_field( $input['single_event_header'] ) : 'default';

			if( isset( $input['single_event_footer'] ) )
				$new_input['single_event_footer'] = sanitize_text_field( $input['single_event_footer'] ) ? sanitize_text_field( $input['single_event_footer'] ) : 'default';

			if( isset( $input['google_key_map'] ) )
				$new_input['google_key_map'] = sanitize_text_field( $input['google_key_map'] ) ? sanitize_text_field( $input['google_key_map'] ) : '';

			if( isset( $input['event_map_zoom'] ) )
				$new_input['event_map_zoom'] = sanitize_text_field( $input['event_map_zoom'] ) ? sanitize_text_field( $input['event_map_zoom'] ) : '17';

			if( isset( $input['ovaev_show_title'] ) )
				$new_input['ovaev_show_title'] = sanitize_text_field( $input['ovaev_show_title'] ) ? sanitize_text_field( $input['ovaev_show_title'] ) : 'yes';

			if( isset( $input['ovaev_show_past'] ) )
				$new_input['ovaev_show_past'] = sanitize_text_field( $input['ovaev_show_past'] ) ? sanitize_text_field( $input['ovaev_show_past'] ) : 'yes';

			if( isset( $input['archive_event_orderby'] ) )
				$new_input['archive_event_orderby'] = sanitize_text_field( $input['archive_event_orderby'] ) ? sanitize_text_field( $input['archive_event_orderby'] ) : 'title';

			if( isset( $input['archive_event_order'] ) )
				$new_input['archive_event_order'] = sanitize_text_field( $input['archive_event_order'] ) ? sanitize_text_field( $input['archive_event_order'] ) : 'ASC';

			if( isset( $input['archive_event_type'] ) )
				$new_input['archive_event_type'] = sanitize_text_field( $input['archive_event_type'] ) ? sanitize_text_field( $input['archive_event_type'] ) : 'type1';

			if( isset( $input['archive_event_bg'] ) )
				$new_input['archive_event_bg'] = sanitize_text_field( $input['archive_event_bg'] ) ? sanitize_text_field( $input['archive_event_bg'] ) : '';

			if( isset( $input['archive_event_header'] ) )
				$new_input['archive_event_header'] = sanitize_text_field( $input['archive_event_header'] ) ? sanitize_text_field( $input['archive_event_header'] ) : 'default';


			if( isset( $input['archive_event_footer'] ) )
				$new_input['archive_event_footer'] = sanitize_text_field( $input['archive_event_footer'] ) ? sanitize_text_field( $input['archive_event_footer'] ) : 'default';


			if( isset( $input['archive_event_format_date'] ) )
				$new_input['archive_event_format_date'] = sanitize_text_field( $input['archive_event_format_date'] ) ? sanitize_text_field( $input['archive_event_format_date'] ) : 'd-m-Y';

			if( isset( $input['archive_format_date_lang'] ) )
				$new_input['archive_format_date_lang'] = sanitize_text_field( $input['archive_format_date_lang'] ) ? sanitize_text_field( $input['archive_format_date_lang'] ) : 'en';

			if( isset( $input['archive_event_format_time'] ) )
				$new_input['archive_event_format_time'] = sanitize_text_field( $input['archive_event_format_time'] ) ? sanitize_text_field( $input['archive_event_format_time'] ) : 'H:i';

			return $new_input;
		}


		public static function create_admin_setting_page() { ?>
			<div class="wrap">
				<h1><?php esc_html_e( "Event Settings", "ovaev" ); ?></h1>

				<form method="post" action="options.php">

					<div id="tabs">

						<?php settings_fields( 'ovaev_options_group' ); // Options group ?>

						<!-- Menu Tab -->
						<ul>
							<li><a href="#ovaev_general_settings"><?php esc_html_e( 'General Settings', 'ovaev' ); ?></a></li>
							<li><a href="#ovaev_event_settings"><?php esc_html_e( 'Event Settings', 'ovaev' ); ?></a></li>
						</ul>

						<!-- General Settings -->  
						<div id="ovaev_general_settings" class="ovaev_admin_settings">
							<?php do_settings_sections( 'ovaev_general_settings' ); // Page ?>
						</div>

						<!-- Event Settings -->  
						<div id="ovaev_event_settings" class="ovaev_admin_settings">
							<?php do_settings_sections( 'ovaev_archive_event_settings' ); // Page ?>
							<hr>
							<?php do_settings_sections( 'ovaev_single_event_settings' ); // Page ?>
						</div>

					</div>

					<?php submit_button(); ?>
				</form>
			</div>

		<?php }


	


		/***** Archive Event Settings *****/
		public function ovaev_show_past(){
			$ovaev_show_past = OVAEV_Settings::ovaev_show_past();
			$ovaev_show_past = isset( $ovaev_show_past ) ? $ovaev_show_past : 'yes';

			$yes = ( 'yes' == $ovaev_show_past ) ? 'selected' : '';
			$no  = ( 'no' == $ovaev_show_past ) ? 'selected' : '';

			?>
			<select name="ovaev_options[ovaev_show_past]" id="ovaev_show_past">
				<option <?php echo esc_attr($yes) ?> value="yes"><?php echo esc_html__('Yes', 'ovaev') ?></option>
				<option <?php echo esc_attr($no) ?> value="no"><?php echo esc_html__('No', 'ovaev') ?></option>
			</select>
			<?php
		}

		public function archive_event_orderby(){
			$archive_event_orderby = OVAEV_Settings::archive_event_orderby();
			$archive_event_orderby = isset( $archive_event_orderby ) ? $archive_event_orderby : 'title';

			$title             = ( 'title' == $archive_event_orderby) ? 'selected' : '';
			$event_custom_sort = ( 'event_custom_sort' == $archive_event_orderby) ? 'selected' : '';
			$ovaev_start_date  = ( 'ovaev_start_date' == $archive_event_orderby) ? 'selected' : '';
			$id                = ( 'ID' == $archive_event_orderby) ? 'selected' : '';

			?>
			<select name="ovaev_options[archive_event_orderby]" id="archive_event_orderby">
				<option <?php echo esc_attr($title) ?> value="title"><?php echo esc_html__('Title', 'ovaev') ?></option>
				<option <?php echo esc_attr($event_custom_sort) ?> value="event_custom_sort"><?php echo esc_html__('Custom Sort', 'ovaev') ?></option>
				<option <?php echo esc_attr($ovaev_start_date) ?> value="ovaev_start_date"><?php echo esc_html__('Start Date', 'ovaev') ?></option>
				<option <?php echo esc_attr($id) ?> value="ID"><?php echo esc_html__('ID', 'ovaev') ?></option>
			</select>
			<?php
		}

		public function archive_event_order(){
			$archive_event_order = OVAEV_Settings::archive_event_order(); 	
			$archive_event_order = isset( $archive_event_order ) ? $archive_event_order : 'ASC';

			$asc_selected  = ('ASC' == $archive_event_order) ? 'selected' : '';
			$desc_selected = ('DESC' == $archive_event_order) ? 'selected' : '';

			?>
			<select name="ovaev_options[archive_event_order]" id="archive_event_order">
				<option <?php echo esc_attr($asc_selected) ?> value="ASC"><?php echo esc_html__('Increasing', 'ovaev') ?></option>
				<option <?php echo esc_attr($desc_selected) ?> value="DESC"><?php echo esc_html__('Decreasing', 'ovaev') ?></option>
			</select>
			<?php
		}


		public function archive_event_type(){
			$archive_event_type = OVAEV_Settings::archive_event_type(); 	
			$archive_event_type = isset( $archive_event_type ) ? $archive_event_type : 'ASC';

			$type1 = ('type1' == $archive_event_type) ? 'selected' : '';
			$type2 = ('type2' == $archive_event_type) ? 'selected' : '';
			$type3 = ('type3' == $archive_event_type) ? 'selected' : '';

			?>
			<select name="ovaev_options[archive_event_type]" id="archive_event_type">
				<option <?php echo esc_attr($type1) ?> value="type1"><?php echo esc_html__('List', 'ovaev') ?></option>
				<option <?php echo esc_attr($type2) ?> value="type2"><?php echo esc_html__('Grid', 'ovaev') ?></option>
				<option <?php echo esc_attr($type3) ?> value="type3"><?php echo esc_html__('Grid Sidebar', 'ovaev') ?></option>
			</select>
			<?php
		}

		public function archive_event_bg(){

			$archive_event_bg_button = OVAEV_Settings::archive_event_bg();
			?>
			<input id="archive_event_bg_upload" type="text" size="36" name="ovaev_options[archive_event_bg]" value="<?php echo esc_attr( $archive_event_bg_button ) ?>" />
			<input id="archive_event_bg_button" type="button" value="<?php echo esc_attr__( 'Upload Image', 'ovaev' ) ?>" />
			<br>
			<span><?php esc_html_e( 'Display when Header are using Heading Top Page Element', 'ovaev' ); ?> </span>
			<?php
		}


		public function archive_event_header(){
			$archive_event_header = OVAEV_Settings::archive_event_header();
			?>

			<?php 
			$lits_headers = apply_filters('asting_list_header', '');

			?>
			<select name="ovaev_options[archive_event_header]" id="archive_event_header">
				<?php if( ! empty( $lits_headers ) ){
					foreach( $lits_headers as $key => $val  ){
						$selected = ($archive_event_header == $key) ? 'selected' : '';
					?>
					<option <?php echo esc_attr( $selected ) ?> value="<?php echo esc_attr( $key ) ?>">
						<?php echo esc_html( $val ) ?>
					</option>
					<?php
					}
				} ?>
			</select>
			<?php
		}

		public function archive_event_footer(){
			$archive_event_footer = OVAEV_Settings::archive_event_footer(); 
			?>

			<?php 
			$lits_headers = apply_filters('asting_list_footer', '');

			?>
			<select name="ovaev_options[archive_event_footer]" id="archive_event_footer">
				<?php if( ! empty( $lits_headers ) ){
					foreach( $lits_headers as $key => $val  ){
						$selected = ($archive_event_footer == $key) ? 'selected' : '';
					?>
					<option <?php echo esc_attr( $selected ) ?> value="<?php echo esc_attr( $key ) ?>">
						<?php echo esc_html( $val ) ?>
					</option>
					<?php
					}
				} ?>
			</select>
			<?php
		}

		public function archive_event_format_date(){

			$archive_event_format_date = OVAEV_Settings::archive_event_format_date() ? OVAEV_Settings::archive_event_format_date() : 'd-m-Y';

			$date_format = apply_filters( 'ovaev_date_format' ,array(
				'd-m-Y'	=> 'd-m-Y',
				'm/d/Y'	=> 'm/d/Y',
				'Y/m/d'	=> 'Y/m/d',
				'Y-m-d'	=> 'Y-m-d',
			) );
			?>

			<select name="ovaev_options[archive_event_format_date]">
				<?php foreach ($date_format as $key => $value) { ?>
					<?php $selected = ( $archive_event_format_date == $key ) ? 'selected' : ''; ?>
					<option value="<?php echo $key; ?>" <?php echo $selected ?> >
						<?php echo $value; ?>
					</option>
				<?php } ?>
			</select>
			
		<?php 
		}

		public function archive_event_format_time(){

			$archive_event_format_time = OVAEV_Settings::archive_event_format_time() ? OVAEV_Settings::archive_event_format_time() : 'H:i';

			$time_format = apply_filters( 'ovaev_time_format', array(

				'H:i'	=> 'H:i'.' '.esc_html__( '24 hour', 'ovaev' ),
				'g:i A'	=> 'g:i A'.' '.esc_html__( '12 hour', 'ovaev' ),
				'g:i a'	=> 'g:i a'.' '.esc_html__( '12 hour', 'ovaev' ),
				
			) );
			?>

			<select name="ovaev_options[archive_event_format_time]">
				<?php foreach ($time_format as $key => $value) { ?>
					<?php $selected = ( $archive_event_format_time == $key ) ? 'selected' : ''; ?>
					<option value="<?php echo $key; ?>" <?php echo $selected ?> >
						<?php echo $value; ?>
					</option>
				<?php } ?>
			</select>

			
		<?php	
		}

		public function archive_format_date_lang(){
			$archive_format_date_lang = OVAEV_Settings::archive_format_date_lang() ? OVAEV_Settings::archive_format_date_lang() : 'en';

			$langauges = array(
				'ar'	=> esc_html__( 'Arabic', 'ovaev' ),
				'az'	=> esc_html__( 'Azerbaijanian', 'ovaev' ),
				'bg'	=> esc_html__( 'Bulgarian', 'ovaev' ),
				'bs'	=> esc_html__( 'Bosanski', 'ovaev' ),
				'ca'	=> esc_html__( 'Català', 'ovaev' ),
				'ch'	=> esc_html__( 'Simplified Chinese', 'ovaev' ),
				'cs'	=> esc_html__( 'Čeština', 'ovaev' ),
				'da'	=> esc_html__( 'Dansk', 'ovaev' ),
				'de'	=> esc_html__( 'German', 'ovaev' ),
				'el'	=> esc_html__( 'Ελληνικά', 'ovaev' ),
				'en'	=> esc_html__( 'English', 'ovaev' ),
				'en-GB'	=> esc_html__( 'English(British)', 'ovaev' ),
				'es'	=> esc_html__( 'Spanish', 'ovaev' ),
				'et'	=> esc_html__( 'Eesti', 'ovaev' ),
				'eu'	=> esc_html__( 'Euskara', 'ovaev' ),
				'fa'	=> esc_html__( 'Finnish(Suomi)', 'ovaev' ),
				'fr'	=> esc_html__( 'French', 'ovaev' ),
				'gl'	=> esc_html__( 'Galego', 'ovaev' ),
				'he'	=> esc_html__( 'Hebrew', 'ovaev' ),
				'hr'	=> esc_html__( 'Hrvatski', 'ovaev' ),
				'hu'	=> esc_html__( 'Hungarian', 'ovaev' ),
				'id'	=> esc_html__( 'Indonesian', 'ovaev' ),
				'it'	=> esc_html__( 'Italian', 'ovaev' ),
				'ja'	=> esc_html__( 'Japanese', 'ovaev' ),
				'ko'	=> esc_html__( 'Korean', 'ovaev' ),
				'kr'	=> esc_html__( 'Korean', 'ovaev' ),
				'lt'	=> esc_html__( 'Lithuanian', 'ovaev' ),
				'lv'	=> esc_html__( 'Latvian', 'ovaev' ),
				'mk'	=> esc_html__( 'Macedonian', 'ovaev' ),
				'mn'	=> esc_html__( 'Mongolian', 'ovaev' ),
				'nl'	=> esc_html__( 'Dutch', 'ovaev' ),
				'no'	=> esc_html__( 'Norwegian', 'ovaev' ),
				'pl'	=> esc_html__( 'Polish', 'ovaev' ),
				'pt'	=> esc_html__( 'Portuguese', 'ovaev' ),
				'pt-BR'	=> esc_html__( 'Português', 'ovaev' ),
				'ro'	=> esc_html__( 'Romanian', 'ovaev' ),
				'ru'	=> esc_html__( 'Russian', 'ovaev' ),
				'se'	=> esc_html__( 'Swedish', 'ovaev' ),
				'sk'	=> esc_html__( 'Slovenčina', 'ovaev' ),
				'sl'	=> esc_html__( 'Slovenščina', 'ovaev' ),
				'sq'	=> esc_html__( 'Albanian', 'ovaev' ),
				'sr'	=> esc_html__( 'Serbian', 'ovaev' ),
				'sr-YU'	=> esc_html__( 'Serbian (Srpski)', 'ovaev' ),
				'sv'	=> esc_html__( 'Svenska', 'ovaev' ),
				'th'	=> esc_html__( 'Thai', 'ovaev' ),
				'tr'	=> esc_html__( 'Turkish', 'ovaev' ),
				'uk'	=> esc_html__( 'Ukrainian', 'ovaev' ),
				'vi'	=> esc_html__( 'Vietnamese', 'ovaev' ),
				'zh'	=> esc_html__( 'Simplified Chinese ', 'ovaev' ),
				'zh-TW'	=> esc_html__( 'Traditional Chinese', 'ovaev' )
			);
			?>
			<select name="ovaev_options[archive_format_date_lang]">
				<?php foreach ($langauges as $key => $value) { ?>
					<?php $selected = ( $archive_format_date_lang == $key ) ? 'selected' : ''; ?>
					<option value="<?php echo $key; ?>" <?php echo $selected ?> >
						<?php echo $value; ?>
					</option>
				<?php } ?>
			</select>

			
		<?php }

		public function single_event_bg(){

			$single_event_bg_button = OVAEV_Settings::single_event_bg();
			?>
			<input id="single_event_bg_upload" type="text" size="36" name="ovaev_options[single_event_bg]" value="<?php echo esc_attr( $single_event_bg_button ) ?>" />
			<input id="single_event_bg_button" type="button" value="<?php echo esc_attr__( 'Upload Image', 'ovaev' ) ?>" />
			<br>
			<span><?php esc_html_e( 'Display when Header are using Heading Top Page Element', 'ovaev' ); ?> </span>
			<?php
		}


		public function single_event_header(){
			$single_event_header = OVAEV_Settings::single_event_header(); 
			?>

			<?php 
			$lits_headers = apply_filters('asting_list_header', '');

			?>
			<select name="ovaev_options[single_event_header]" id="single_event_header">
				<?php if( ! empty( $lits_headers ) ){
					foreach( $lits_headers as $key => $val  ){
						$selected = ($single_event_header == $key) ? 'selected' : '';
					?>
					<option <?php echo esc_attr( $selected ) ?> value="<?php echo esc_attr( $key ) ?>">
						<?php echo esc_html( $val ) ?>
					</option>
					<?php
					}
				} ?>
			</select>
			<?php
		}

		public function single_event_footer(){
			$single_event_footer = OVAEV_Settings::single_event_footer(); 
			?>

			<?php 
			$lits_headers = apply_filters('asting_list_footer', '');

			?>
			<select name="ovaev_options[single_event_footer]" id="single_event_footer">
				<?php if( ! empty( $lits_headers ) ){
					foreach( $lits_headers as $key => $val  ){
						$selected = ($single_event_footer == $key) ? 'selected' : '';
					?>
					<option <?php echo esc_attr( $selected ) ?> value="<?php echo esc_attr( $key ) ?>">
						<?php echo esc_html( $val ) ?>
					</option>
					<?php
					}
				} ?>
			</select>
			<?php
		}


		/*****  Single Event Settings *****/
		public function google_key_map(){
			$google_key_map =  esc_attr( OVAEV_Settings::google_key_map() );
			printf(
				'<input type="text" id="google_key_map"  name="ovaev_options[google_key_map]" value="%s" />',
				isset( $google_key_map ) ? $google_key_map : ''
			);

			echo '<br/>'; 
			esc_html_e('You can get here: https://developers.google.com/maps/documentation/javascript/get-api-key', 'ovaev');
		}

		public function event_map_zoom(){
			$event_map_zoom = OVAEV_Settings::event_map_zoom();
			$event_map_zoom = isset( $event_map_zoom ) ? $event_map_zoom : '17';

			printf(
				'<input type="number" id="event_map_zoom" name="ovaev_options[event_map_zoom]" value="%s" />',
				isset( $event_map_zoom ) ? $event_map_zoom : '17'
			);
		}


			public function ovaev_show_title(){
			$ovaev_show_title = OVAEV_Settings::ovaev_show_past();
			$ovaev_show_title = isset( $ovaev_show_title ) ? $ovaev_show_title : 'yes';

			$yes = ( 'yes' == $ovaev_show_title ) ? 'selected' : '';
			$no  = ( 'no' == $ovaev_show_title ) ? 'selected' : '';

			?>
			<select name="ovaev_options[ovaev_show_title]" id="ovaev_show_title">
				<option <?php echo esc_attr($yes) ?> value="yes"><?php echo esc_html__('Yes', 'ovaev') ?></option>
				<option <?php echo esc_attr($no) ?> value="no"><?php echo esc_html__('No', 'ovaev') ?></option>
			</select>
			<?php
		}


	}
	new OVAEV_Admin_Settings();
}
