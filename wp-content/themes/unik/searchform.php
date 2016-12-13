<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>"> 
	<div class="input-group">
		<input class="form-control input-md" id="s" name="s" type="text">
		<span class="input-group-btn">
			<button class="btn btn-md" type="submit"><?php _e('Search','unik'); ?></button>
		</span>
	</div>	 
</form>