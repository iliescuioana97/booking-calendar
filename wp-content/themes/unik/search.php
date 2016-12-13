<?php get_header(); 
get_template_part('breadcrumps'); ?>
        <!-- Posts List -->
        <div class="section blog-posts-wrapper">
	    	<div class="container">
				<div class="row" id="masonry">
				<?php if ( have_posts() ) { 
				while ( have_posts() ) : the_post(); ?>
					<!-- Post -->
					<div class="item col-md-4 col-sm-6">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="blog-post">
							<!-- Post Info -->
							<?php if(has_post_thumbnail()): ?>
							<div class="post-info">
								<div class="post-date">
									<div class="date"><?php the_time('F j, Y'); ?></div>
									<div class="post-comments-count">
									<i class="fa fa-comment icon-white"></i><?php echo comments_number(__('0','unik'), __('1 ','unik'), '%'); ?>
								</div>
								</div>
							</div>
							<!-- End Post Info -->
							<!-- Post Image -->
							<div class="blog-thumb">
							<?php the_post_thumbnail(); ?>
							</div>
							<?php endif; ?>
							<!-- End Post Image -->
							<!-- Post Title & Summary -->
							<div class="post-title">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="post-summary">
								<?php the_excerpt(); ?>
							</div>
							<!-- End Post Title & Summary -->
							<div class="post-more">
								<a href="<?php the_permalink(); ?>" class="btn btn-small"><?php _e('Read more','unik'); ?> <i class="fa fa-plus icon-white"></i></a>
							</div>
						</div>
					</div>
					</div>					
					<?php endwhile;  
					}else{ ?>
					<div class="col-md-12 no-results">
						<h1 class="unik-not-found"><?php _e('No Results Found','unik'); ?></h1>
						<a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"  class="btn unik-home"><?php _e('Back to Homepage.','unik'); ?></a>
					</div>
					<?php } ?>
					<!-- End Post -->
					</div>
				<?php unik_paging_nav();?>
			</div>
		</div>
	    <!-- End Posts List -->
		
	    <?php get_footer();?> 