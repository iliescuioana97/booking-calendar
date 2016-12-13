<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
    </head>
	<body <?php body_class(); ?>>
	<?php $unik_option=unik_options(); ?>
	<div id="wrapper">
	<!-- Navigation & Logo-->
        <div class="navigation_menu">
		<div class="container" >
		<div class="col-md-6 unik-logo">
		<?php $unik_logo_id = get_theme_mod( 'custom_logo' );
			$unik_logo_data = wp_get_attachment_image_src( $unik_logo_id , 'full' );
			$unik_logo = $unik_logo_data[0];	?>
			<a class="logo-wrapper" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if(isset($unik_logo)){ ?>
			<img src="<?php echo esc_url($unik_logo); ?>" alt="Logo" >
			<?php }else { echo get_bloginfo('name'); } ?></a>
		</div>
		<div class="col-md-6 unik-social">
		<?php if($unik_option['header_social']=='on'){ ?>
			<ul class="header-social">
			<?php for($i=1; $i<=4; $i++){ 
			if($unik_option['social_icon_'.$i]!=''){?>
				<li class="social-icon"><a href="<?php echo $unik_option['social_icon_link_'.$i]; ?>" ><i class="<?php echo $unik_option['social_icon_'.$i]; ?>" <?php if($unik_option['icon_color_'.$i]!='') echo 'style="color:'.$unik_option['icon_color_'.$i].'"'; ?>></i></a></li>
			<?php } } ?>
			</ul>
		<?php } ?>
		</div>
			<nav class="navbar navbar-default col-md-12" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
					 
					  <span class="sr-only"><?php _e('Toggle navigation','unik');?></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
				</div>
				<div id="menu" class="collapse navbar-collapse ">	
				<?php wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class' => 'nav navbar-nav',
						'fallback_cb' => 'unik_fallback_page_menu',
						'walker' => new unik_nav_walker(),
						)
						);	?>				
				</div>	
			</nav>
		</div>
	</div>