<!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h1><?php if(is_home()){ _e('Home', 'unik'); }else{ the_title(); } ?></h1>
					</div>
					<div class="col-md-6">
					<?php if (function_exists('unik_breadcrumbs') && !is_home()){ unik_breadcrumbs(); } ?>
					</div>
				</div>
			</div>
		</div>