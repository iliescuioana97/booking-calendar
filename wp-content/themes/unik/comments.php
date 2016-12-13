<?php
if ( post_password_required() ) { ?>
<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'unik' ); ?></p>
<?php return;
}
?>

<div class="post-coments">
	<?php if ( have_comments() ) : ?>

	<h4><?php echo comments_number(__('No Comments','unik'), __('1 Comment','unik'), '% Comments'); ?></h4>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'unik' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'unik' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'unik' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ul class="post-comments">
		<?php
			wp_list_comments( array( 'callback' => 'unik_comment' )  );
		?>
	</ul><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'unik' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'unik' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'unik' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'unik' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if ( comments_open() ) : ?>
	<?php $unik_fields=array(
		'author' => '<div class="form-group"><label for="comment-name"><i class="fa fa-user"></i> <b>'.__('Your name','unik').'</b></label><input class="form-control" id="name" name="author" type="text" placeholder=""></div>',
		'email' => '<div class="form-group"><label for="comment-email"><i class="fa fa-envelope"></i> <b>'.__('Your Email','unik').'</b></label><input class="form-control" id="email" name="email" type="text" placeholder=""></div>',
	);
	function unik_fields($unik_fields) { 
		return $unik_fields;
	}
	add_filter('unik_custom_comment','unik_fields');
		$defaults = array(
		'fields'=> apply_filters( 'unik_custom_comment', $unik_fields ),
		'comment_field'=> '<div class="form-group"><label for="message"><i class="fa fa-comment"></i> <b>Your Message</b></label><textarea class="form-control" rows="5" id="comment" name="comment"></textarea></div>',		
		'logged_in_as' => '<p class="logged-in-as">' . __( "Logged in as ",'unik' ).'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="Log out of this account">'.__(" Log out?",'unik').'</a>' . '</p>',
		'title_reply_to' => __( 'Leave a Reply to %s','unik'),
		'class_submit' => 'btn btn-large pull-right',
		'label_submit'=>__( 'Post Comment','unik'),
		'comment_notes_before'=> '',
		'comment_notes_after'=>'',
		'title_reply'=> '<h4>'.__('Leave a Reply','unik').'</h4>',		
		'role_form'=> 'form',		
		);
		comment_form($defaults); ?>		
<?php endif; // If registration required and not logged in ?>

</div><!-- #comments -->
