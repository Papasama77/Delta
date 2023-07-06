<?php get_header();
    if(have_posts()):?>

<section class="text-center mt-3">
<h1><?php single_cat_title();?></h1>

<?php if(category_description()):
    echo category_description();
    endif;//fin du if description
?>
</section>

<section class="d-flex justify-content-around flex-wrap">
<?php
/*On affiche les articles de cette catégorie*/
    while(have_posts()):
        the_post();?>

        <article class="card">
            <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail('medium',['class'=>"card-img-top"]);?>
            </a>
            <div class="card-body">
                <h3 class="card-title"><?php the_title();?></h3>

                <p class="card-text"><?php the_excerpt();?></p>

                <a href="<?php the_permalink();?>" class="btn btn-info text-light">Lire la suite</a>
            </div>
        </article>

    <?php endwhile;?>
</section>

<?php endif;//fin du if have_posts?>

<?php get_footer();?>