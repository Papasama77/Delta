<?php get_header();?>

<?php

if(have_posts()):
    while(have_posts()):
        the_post();
    endwhile;
endif;

?>


    <h1 class="<?php if(get_theme_mod('active_title')=='title'){
        echo esc_attr(get_theme_mod('active_title','title'));}

        else{echo esc_attr(get_theme_mod('active_title','hidden'));}        
        ?>">
        
        <?php the_title();?>
    </h1>
    <?php if(has_post_thumbnail()){
        ?>

        <div class="d-flex mt-3 px-5">
            <figure class="img-thumbnail">
                <?php the_post_thumbnail();?>
            </figure>

        <?php }?>

        <section>
            <?php the_content();?>
        </section>

    </div>

<?php get_footer();?>