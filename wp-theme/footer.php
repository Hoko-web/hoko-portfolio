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
          <ul class="c-sns" aria-label="SNS・連絡先">
            <li class="c-sns__item">
              <a
                href="https://x.com/Hoko_Web"
                class="c-sns__link"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="X"
              >
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-x.svg' ); ?>" alt="" class="c-sns__icon" />
              </a>
            </li>
            <li class="c-sns__item">
              <a
                href="https://github.com/Hoko-web"
                class="c-sns__link"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="GitHub"
              >
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-github.svg' ); ?>" alt="" class="c-sns__icon" />
              </a>
            </li>
            <li class="c-sns__item">
              <a
                href="mailto:396989.hiro@gmail.com"
                class="c-sns__link"
                aria-label="メール"
              >
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-mail.svg' ); ?>" alt="" class="c-sns__icon" />
              </a>
            </li>
          </ul>

          <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>" class="p-footer__privacy">Privacy Policy</a>
        </div>
      </div>
      <div class="p-footer__bottom">
        <p class="p-footer__copyright">
          © <?php echo date( 'Y' ); ?> Hiromasa Hokotate All rights reserved.
        </p>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
