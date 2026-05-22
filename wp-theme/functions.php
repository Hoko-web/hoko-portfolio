<?php 

// =====================================
// テーマ設定
// =====================================
function hoko_setup() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'site-icon' );
  add_theme_support( 'html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ] );

  register_nav_menus( [
    'global' => 'グローバルナビ（ヘッダーPC）',
    'drawer' => 'ドロワーメニュー（ヘッダーSP）',
    'footer' => 'フッターナビ',
  ] );
}
add_action( 'after_setup_theme', 'hoko_setup' );

// =====================================
// CSS JS 読み込み  
// =====================================
function hoko_enqueue_assets() {
  wp_enqueue_style( 'hoko-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Noto+Sans+JP:wght@400;500;700&family=Shippori+Mincho:wght@400;500;700&display=swap', [], null );
  wp_enqueue_style( 'hoko-style', get_template_directory_uri() . '/assets/css/style.css', [], '1.0.0' );
  wp_enqueue_script( 'hoko-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true );
  wp_script_add_data( 'hoko-main', 'strategy', 'defer' );
}
add_action( 'wp_enqueue_scripts', 'hoko_enqueue_assets' );

// =====================================
// カスタム投稿タイプ　（works）タクソノミー登録
// =====================================
function hoko_register_works() {
  register_post_type( 'works', [
    'label'          => '制作実績',
    'public'         => true,
    'menu_position'  => 5,
    'menu_icon'      => 'dashicons-portfolio',
    'has_archive'    => true,
    'supports'       => [ 'title', 'thumbnail', 'editor', 'page-attributes' ],
    'rewrite'        => [
      'slug'          =>  'works',
      'with_front'    => false,
    ],
    'show_in_rest'   => true,
  ] );

  register_taxonomy( 'works_category', 'works', [
    'label'          => 'カテゴリ',
    'hierarchical'   => true,
    'show_in_rest'   => true,
    'rewrite'        => [
      'slug'          => 'works-category',
      'with_front'    => false,
    ],
  ] );

  register_taxonomy( 'works_tag', 'works', [
    'label'          => '使用技術',
    'hierarchical'   => false,
    'show_in_rest'   => true,
    'rewrite'        => [
      'slug'          => 'works-tag',
      'with_front'    => false,
    ],
  ] );
}
add_action( 'init', 'hoko_register_works' );

// =====================================
// CF7設定
// =====================================
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// =====================================
// CF7送信後リダイレクト
// =====================================
function hoko_redirect_to_thanks() {
  if ( ! is_page( 'contact' ) ) {
    return;
  }

  $thanks_url = esc_url( home_url( '/contact/thanks/' ) );
  echo <<<EOD
<script>
  document.addEventListener( 'wpcf7mailsent', function () {
    window.location = '{$thanks_url}';
  });
</script>
EOD;
}
add_action( 'wp_footer', 'hoko_redirect_to_thanks' );