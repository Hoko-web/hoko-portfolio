<?php
/**
 * ヘッダー（全ページ共通）
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts 非同期読み込み -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Noto+Sans+JP:wght@400;500;700&family=Shippori+Mincho:wght@400;500;700;800&display=swap" media="print" onload="this.media='all'">

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

    <!-- ローディング画面 -->
    <?php if ( is_front_page() ) : ?>
    <script>
      (() => {
        // もう表示した？　/ 視差効果を減らす設定？　どちらかなら、ローディング画面出さない
        const seen = sessionStorage.getItem("loaderSeen");
        const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        if (seen || reduce) return;
        // ローディング画面ON
        document.documentElement.classList.add("is-loading");
        // 読み込みが終わったら、ローディングを消し、「もう表示した」印を押す
        window.addEventListener("load", () => {
          document.documentElement.classList.remove("is-loading");
          sessionStorage.setItem("loaderSeen", "1");
        });
      })();
    </script>
    <?php endif; ?>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <!-- カスタムカーソル -->
    <div class="c-cursor js-cursor" aria-hidden="true">
      <span class="c-cursor__ring js-cursor-ring"></span>
      <span class="c-cursor__dot js-cursor-dot"></span>
    </div>
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
          <?php get_template_part( 'template-parts/sns-list', null, [ 'modifier' => 'p-header__sns' ] ); ?>
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
          <!-- SNS -->
          <?php get_template_part( 'template-parts/sns-list' ); ?>
        </nav>
      </div>
      
    </header>