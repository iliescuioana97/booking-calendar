<?php get_header();
if(get_option('show_on_front')=='posts'){
	$unik_post_data= array( 'post_type' => 'post');
	$unik_posts=new WP_Query($unik_post_data);
	 if ( $unik_posts->have_posts() ) : ?>
        <!-- Posts List -->
        <div class="section blog-posts-wrapper">
	    	<div class="container">
				<div class="row" id="masonry">
				<?php while ( $unik_posts->have_posts() ) : $unik_posts->the_post(); ?>
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
					<?php endwhile;  ?>
					<!-- End Post -->
					</div>
			</div>
		</div>
	    <!-- End Posts List -->
		<?php endif;
}else{  
get_template_part('breadcrumps'); ?>
		<div class="section">
	    	<div class="container">
				<div class="row">
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
		<?php get_sidebar(); ?>
		<?php endif; ?>
				</div>
			</div>
		</div>
<?php }
get_footer();?> 