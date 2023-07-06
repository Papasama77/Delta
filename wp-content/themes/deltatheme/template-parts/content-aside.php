<?php ?>

<aside class="flex-shrink-1" id="aside-left">
    <h3 class="text-center text-danger">En avant première</h3>
        <?php if(is_active_sidebar('premier')):
        dynamic_sidebar('premier');
        endif;
        ?>
    </aside>

<?php ?>