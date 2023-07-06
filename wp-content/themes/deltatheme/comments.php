<?php
/*TEMPLATE POUR LES COMMENTAIRES*/
if ( post_password_required() )
 return;
?>

<div id="comments" class="comments-area">

<?php if(have_comments()):?>

    <h4 class="comments-title">
    <?php
			printf(
				_nx(
					'Commentaire(s) :',
					'Commentaire(s) :',
					get_comments_number(),
					'comments title',
					'deltatheme'
				),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
			?>  
    </h4>

<!--On creer une liste pour affichier les commentaires-->
            <ol class="comment-list">
                <?php
                    wp_list_comments(array(

                        'style'=>'ol',
                        'avatar_size'=>36
                    ));
                ?>
            </ol>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

            <nav class="navigation comment-navigation" role="navigation">

            <h3 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'deltatheme' ); ?></h3>
            <div class="nav-previous pe-3"><?php previous_comments_link( __( '&larr; Older Comments', 'deltatheme' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'deltatheme' ) ); ?></div>

            </nav><!-- .comment-navigation -->

<?php endif; // Check for comment navigation ?>
<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'deltatheme' ); ?></p>
<?php endif; ?>

<?php endif; //fin du hav_comments() ?>
<?php
$comment_args=array(
    //changer la classe du bouton submit
    'class_submit'=>'btn btn-info text-light',
    'label_submit'=>'Envoyer'
);

comment_form($comment_args); ?>


<div class="pagination d-flex justify-content-center">
	<?php paginate_comments_links(); ?>
</div>

</div>
