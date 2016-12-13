<!-- Footer -->
<?php $unik_option=unik_options(); ?>
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">
				<?php if ( is_active_sidebar( 'unik_footer_widget' ) )
						{ dynamic_sidebar( 'unik_footer_widget' );	} ?>
		    	</div>
		    	<div class="row footer-copyright">
		    		<div class="col-md-3">
					<?php if($unik_option['footer_social']=='on'){ ?>
					<ul class="footer-social">
					<?php for($i=1; $i<=4; $i++){ 
					if($unik_option['social_icon_'.$i]!='' && $unik_option['social_icon_link_'.$i]!=''){ ?>
						<li class="footer-icon"><a href="<?php echo esc_url($unik_option['social_icon_link_'.$i]); ?>" ><i class="<?php echo esc_attr($unik_option['social_icon_'.$i]); ?>" <?php if($unik_option['icon_color_'.$i]!='') echo 'style="color:'.esc_attr($unik_option['icon_color_'.$i]).'"'; ?>></i></a></li>
					<?php } } ?>
					</ul>
					<?php } ?>
		    		</div>
					<div class="col-md-6">
						<ul class="footer-info">
						<?php for($i=1; $i<=4; $i++){ 
						if($unik_option['footer_text_'.$i]!='' && $unik_option['footer_link_'.$i]!=''){?>
							<li><a href="<?php echo esc_url($unik_option['footer_link_'.$i]); ?>"><?php echo esc_attr($unik_option['footer_text_'.$i]); ?></a></li>
						<?php } } ?>
						</ul>
					</div>
					<div class="col-md-3">
						<p class="footer-credit"><?php if($unik_option['footer_credit']!=''){ echo esc_attr($unik_option['footer_credit']); } 
						if($unik_option['footer_company']!='' && $unik_option['footer_company_link']!=''){?>
						<a href="<?php echo esc_url($unik_option['footer_company_link']); ?>"><?php echo esc_attr($unik_option['footer_company']); ?></a>
						<?php } ?>
						</p>
					</div>
		    	</div>
		    </div>
	    </div>
	</div>
<?php wp_footer(); ?>
    </body>
</html>