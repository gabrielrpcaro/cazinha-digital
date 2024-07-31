<!---
    Template Name: Posts
    ----->
<?php get_header(); ?>

<div class="post">
<?php if (have_posts()){ ?>
<?php while ( have_posts() ) : the_post(); $posta++; $contou=0;
 ?>
<div class="conteudo">
<?php the_content(); ?>
</div>
<?php endwhile; ?>
<?php }else{ ?>
<?php include"404-msg.php"; ?>
 <?php } ?>

</div>

<?php get_footer(); ?>