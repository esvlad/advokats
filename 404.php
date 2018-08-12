<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Адвокаты
 */

get_header(); ?>

<section class="sect start home error_page">
  <div class="wrapper">
    <div class="start_image">
      <div class="clip"></div>
      <div class="image"></div>
    </div>
    <div class="start_caption">
      <p>404</p>
      <p class="not_page">Такой страницы нет, но&nbsp;вы&nbsp;можете вернуться <a href="<?=SITE;?>">на&nbsp;главную</a>.</p>
    </div>
  </div>
</section>

<?php
get_footer();
