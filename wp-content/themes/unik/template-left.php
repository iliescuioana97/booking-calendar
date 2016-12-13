<?php //Template Name: Page With Left Sidebar
get_header();
get_template_part('breadcrumps'); ?>
		<div class="section">
	    	<div class="container">
				<div class="row">
		<?php get_sidebar(); ?>
        <?php if ( have_posts() ) : ?>
        <!-- Posts List -->
        <div class="col-md-8 col-sm-12">
			<div class="blog-post blog-single-post">
				<?php while ( have_posts() ) : the_post(); ?>
					<!-- Post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="single-post-info">
						<i class="fa fa-calendar"></i><?php the_time('F j, Y'); ?> <i class="fa fa-comment"></i><?php echo comments_number(__('No Comments','unik'), __('1 Comment','unik'), '% Comments'); ?>
					</div>
							<?php if(has_post_thumbnail()): ?>
							<div class="single-post-image">
							<?php the_post_thumbnail(); ?>
							</div>
							<?php endif; ?>
							<div class="single-post-content">
								<h3><?php the_title(); ?></h3>
							
								<?php the_content(); ?>
								<div class="row">
									<div class="col-md-6 unik-tags"><?php the_tags(); ?></div>
									<div class="col-md-6 unik-cats">
									<?php if(get_the_category_list() != '') { ?>
								<?php _e('Categoties:','unik');  the_category(', '); ?>
								<?php }	 ?></div>
								</div>
							</div>
							<!-- End Post Title & Summary -->
							<?php wp_link_pages();
							if ( comments_open() || get_comments_number() ) {
		   comments_template();
		   } ?>
		   </div>
					<?php endwhile; ?>
					<!-- End Post -->
			</div>
	    </div>
	    <!-- End Posts List -->
		<?php endif; ?>
				</div>
			</div>
		</div>
	    
		<?php get_footer();?> 