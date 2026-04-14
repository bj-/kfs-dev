<?php 
/*
* Template Name: Политика - Куки
*/
get_header(); ?>
<!-- Блок №1 начало -->
<?php while (have_rows('blok_1')) : the_row(); ?>
    <div class="wrap" style="padding-top:100px;">
        <h2><?= get_sub_field('zagolovok') ?></h2>
        <div><?= get_sub_field('tekst') ?></div>
    </div>
<?php endwhile; ?>
<!-- Блок №1 конец -->

<?php get_footer(); ?>
