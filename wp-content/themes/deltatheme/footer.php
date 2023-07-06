<section class="bottom d-flex">
<!-- Ici nous allons placer une zone de widget-->
<?php get_sidebar(); ?>
</section>

<footer class="d-flex">
    <div">
            <?php 
                wp_nav_menu(array(
                    'theme_location'=>'footmenu',
                    'container'=>'nav',
                    'container_class'=>'navbar navbar-expand-lg',
                    'menu_class'=>'navbar-nav',
                    'sort_column'=>'menu_order',
                    'link_after'=>'<span class="separator"> |</span>'
                ));
            ?>
        </div>
    <p><span><?php echo esc_html(get_theme_mod('copyright','Copyright 2023 - Tous droits réservés'));?></span>
    </p>
    
</footer>
</main>

<?php wp_footer();?>
</body>
</html>