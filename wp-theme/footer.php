<?php
/**
 * フッター（全ページ共通）
 */
?>
    <footer class="p-footer">
      <div class="p-footer__inner">
        <div class="p-footer__head">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="p-footer__logo" aria-label="トップへ戻る"
            >Hoko</a
          >
          <p class="p-footer__text">Portfolio</p>
        </div>
        <div class="p-footer__menus">
          <nav class="p-footer__nav" aria-label="フッターナビ">
            <ul class="p-footer__nav-list">
              <li class="p-footer__nav-item">
                <a class="p-footer__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#about' ); ?>">About</a>
              </li>
              <li class="p-footer__nav-item">
                <a class="p-footer__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#works' ); ?>">Works</a>
              </li>
              <li class="p-footer__nav-item">
                <a class="p-footer__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#skills' ); ?>">Skills</a>
              </li>
              <li class="p-footer__nav-item">
                <a class="p-footer__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#contact' ); ?>">Contact</a>
              </li>
            </ul>
          </nav>
          <!-- SNS -->
          <?php get_template_part( 'template-parts/sns-list' ); ?>
          <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>" class="p-footer__privacy">Privacy Policy</a>
        </div>
      </div>
      <div class="p-footer__bottom">
        <p class="p-footer__copyright">
          © <?php echo esc_html( wp_date( 'Y' ) ); ?> Hiromasa Hokotate All rights reserved.
        </p>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
