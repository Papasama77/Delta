<?php get_header();?>

<?php

if(have_posts()):
    while(have_posts()):
        the_post();
    endwhile;
endif;

?>
<div class="d-flex justify-content-around my-3">
    <?php if(has_post_format('aside')){
        
        get_template_part('template-parts/content-aside');
 
     } ?>

<section class="text-center flex-grow-1 mx-5">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if(has_post_format('quote')){
        
        get_template_part('template-parts/content-quote'); 
   
    }

    else{?>
        <h1>
            <?php the_title();?>
        </h1>
        <?php if(has_post_thumbnail()){
            ?>
                <figure>
                    <?php the_post_thumbnail();?>
                </figure>

            <?php }?>
            <span> <?php _e('Published','deltatheme'); the_date('d-m-Y','<small class="rouge">','</small>');?>, par <?php the_author();?></span>

            <article>
                <?php the_content();?>
            </article>
                <!--Permet d'affichier la suite de l'article si celui ci est divisé en plusieurs parties-->
                <?php wp_link_pages('before=<div id="page-links">&after=</div>');?>
                <hr>
            <div>
                <?php comments_template(); ?>
            </div>
        <?php } ?>
   
    </div>

</section>

    <?php if(is_active_sidebar('deux')):
        ?><aside><?php
        dynamic_sidebar('deux');
        ?></aside><?php
    endif;
    ?>

</div>

<?php get_footer();?>