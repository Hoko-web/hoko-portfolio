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