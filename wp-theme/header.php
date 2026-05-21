<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>"
    />
    <!-- OGP -->
    <meta property="og:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" />
    <meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/img/ogp.png' ); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo esc_url( home_url( add_query_arg( null, null ) ) ); ?>" /> 
    <meta name="twitter:card" content="summary_large_image" />

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <!-- ===================================== -->
    <!-- header -->
    <!-- ===================================== -->
    <header class="p-header">
      <div class="p-header__inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="p-header__logo" aria-label="トップへ戻る">Hoko</a>
        <!-- Menus(pc) -->
        <div class="p-header__menus">
          <!-- Nav(pc) -->
          <nav class="p-header__nav" aria-label="グローバルナビ">
            <ul class="p-header__nav-list">
              <li class="p-header__nav-item">
                <a class="p-header__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#about' ); ?>">About</a>
              </li>
              <li class="p-header__nav-item">
                <a class="p-header__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#works' ); ?>">Works</a>
              </li>
              <li class="p-header__nav-item">
                <a class="p-header__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#skills' ); ?>">Skills</a>
              </li>
              <li class="p-header__nav-item">
                <a class="p-header__nav-link" href="<?php echo esc_url( home_url( '/' ) . '#contact' ); ?>">Contact</a>
              </li>
            </ul>
          </nav>

          <!-- SNS(pc) -->
          <ul class="c-sns p-header__sns" aria-label="SNS・連絡先">
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
        </div>
        <!-- Hamburger(sp) -->
        <button
          class="p-header__hamburger js-hamburger"
          type="button"
          aria-expanded="false"
          aria-label="メニューを開く"
        >
          <span class="p-header__hamburger-bar"></span>
          <span class="p-header__hamburger-bar"></span>
        </button>
        <!-- Drawer(sp) -->
        <nav class="p-header__drawer js-drawer" aria-label="ドロワーナビ">
          <ul class="p-header__drawer-list">
            <li class="p-header__drawer-item">
              <a class="p-header__drawer-link" href="<?php echo esc_url( home_url( '/' ) . '#about' ); ?>">About</a>
            </li>
            <li class="p-header__drawer-item">
              <a class="p-header__drawer-link" href="<?php echo esc_url( home_url( '/' ) . '#works' ); ?>">Works</a>
            </li>
            <li class="p-header__drawer-item">
              <a class="p-header__drawer-link" href="<?php echo esc_url( home_url( '/' ) . '#skills' ); ?>">Skills</a>
            </li>
            <li class="p-header__drawer-item">
              <a class="p-header__drawer-link" href="<?php echo esc_url( home_url( '/' ) . '#contact' ); ?>">Contact</a>
            </li>
          </ul>
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
        </nav>
      </div>
      
    </header>