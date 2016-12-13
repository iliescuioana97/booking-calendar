<?php get_header(); ?>
<div class="page_title2">
	<div class="container">
		<div class="two_third">    
			<div class="title">
				<h1><?php global $wp;
					echo $current_url = (add_query_arg(array(),$wp->request)); ?></h1>
			</div>
			<?php chronicle_breadcrumbs(); ?>        
		</div>    
		<div class="one_third last">    
			<?php get_search_form(); ?>
		</div>    
	</div>
</div>
<div class="container">
	<div class="col-md-9 content_left">
        <?php woocommerce_content(); ?>          
    <div class="clearfix divider_dashed9"></div>	
	<div class="clearfix mar_top2"></div>
	</div><!-- end content left side -->
<?php get_sidebar(); ?>
</div><!-- end content area -->
<div class="margin_top5"></div>	
<?php get_footer(); ?>