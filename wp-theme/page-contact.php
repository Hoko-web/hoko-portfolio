<?php get_header(); ?>

<main id="top">
  <!-- ===================================== -->
  <!-- Contact -->
  <!-- ===================================== -->
  <section class="p-contact p-contact--page">
    <div class="p-contact__inner p-contact__inner--page">
      <div class="c-heading">
        <h1 class="c-heading__title">Contact</h1>
      </div>

      <div class="p-contact__body">
        <p class="p-contact__text">
          お仕事のご相談・ご依頼、その他お問い合わせはこちらよりお気軽にご連絡ください。
        </p>

        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            the_content();
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>