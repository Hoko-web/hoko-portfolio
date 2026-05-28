<?php

/**
 * テーマセットアップ（メニュー登録、テーマサポート）
 */
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

/**
 * CSS / JS の読み込み
 */
function hoko_enqueue_assets() {
  wp_enqueue_style( 'hoko-style', get_template_directory_uri() . '/assets/css/style.css', [], '1.0.0' );
  wp_enqueue_script( 'hoko-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true );
  wp_script_add_data( 'hoko-main', 'strategy', 'defer' );
}
add_action( 'wp_enqueue_scripts', 'hoko_enqueue_assets' );

/**
 * 使用しない WordPress 標準スタイルを削除
 */
function hoko_dequeue_unused_styles() {
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'classic-theme-styles' );
  wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'hoko_dequeue_unused_styles', 100 );

/**
 * カスタム投稿タイプ「works」と関連タクソノミーを登録
 */
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

/**
 * CF7設定（autop無効化、フロント側CSS停止）
 */
function hoko_cf7_setup() {
  add_filter( 'wpcf7_autop_or_not', '__return_false' );
  add_filter( 'wpcf7_load_css', '__return_false' );
}
add_action( 'init', 'hoko_cf7_setup' );

/**
 * CF7送信完了時に Thanks ページへリダイレクト
 */
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

/**
 * Works一覧の表示件数を6件に固定
 */
function hoko_works_archive_query( $query ) {
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }
  if ( $query->is_post_type_archive( 'works' ) ) {
    $query->set( 'posts_per_page', 6 );
    $query->set( 'orderby', 'menu_order' );
    $query->set( 'order', 'ASC' );
  }
}
add_action( 'pre_get_posts', 'hoko_works_archive_query' );

/**
 * ページネーションを出力する
 */
function hoko_pagination( $args = [] ) {
  $defaults = [
    'type'               => 'array',
    'mid_size'           => 1,
    'end_size'           => 1,
    'prev_text'          => 'Prev',
    'next_text'          => 'Next',
    'screen_reader_text' => 'ページネーション',
  ];
  $args  = wp_parse_args( $args, $defaults );
  $links = paginate_links( $args );

  if ( empty( $links ) ) {
    return;
  }

  echo '<nav class="c-pagination" aria-label="' . esc_attr( $args['screen_reader_text'] ) . '">';
  echo '<ul class="c-pagination__list">';
  foreach ( $links as $link ) {
    echo '<li class="c-pagination__item">' . $link . '</li>';
  }
  echo '</ul>';
  echo '</nav>';
}

/**
 * Worksセクション用のクエリを取得
 */
function hoko_get_related_works( $exclude_id = null ) {
  $args = [
    'post_type'      => 'works',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ];
  if ( $exclude_id ) {
    $args['post__not_in'] = [ $exclude_id ];
  }
  return new WP_Query( $args );
}