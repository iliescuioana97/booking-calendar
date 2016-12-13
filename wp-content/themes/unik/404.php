<?php get_header();
get_template_part('breadcrumps'); ?>
		<div class="section">
	    	<div class="container">
				<div class="row unik-error-page">
				<h1 class="unik-404"><?php _e('Sorry No Content Found!',  'unik'); ?></h1>
				<h4 class="unik-error"><?php _e('Click to back HomePage','unik'); ?></h4>
				<a class="btn btn-alert" href="<?php echo esc_url(home_url( '/' )); ?>"><?php _e('Home', 'unik'); ?></a>
				</div>
			</div>
		</div>
<?php get_footer();?> 