<?php
/**
 * SNS アイコンリスト（共通パーツ）
 *
 * @param string $args['modifier'] 追加クラス（例：'p-header__sns'）
 */
$modifier = $args['modifier'] ?? '';
$class    = trim( 'c-sns ' . $modifier );
?>
<ul class="<?php echo esc_attr( $class ); ?>" aria-label="SNS・連絡先">
  <li class="c-sns__item">
    <a
      href="https://x.com/Hoko_Web"
      class="c-sns__link"
      target="_blank"
      rel="noopener noreferrer"
      aria-label="X"
    >
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-x.svg' ); ?>" alt="" class="c-sns__icon" decoding="async" />
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
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-github.svg' ); ?>" alt="" class="c-sns__icon" decoding="async" />
    </a>
  </li>
  <li class="c-sns__item">
    <a
      href="mailto:396989.hiro@gmail.com"
      class="c-sns__link"
      aria-label="メール"
    >
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-mail.svg' ); ?>" alt="" class="c-sns__icon" decoding="async" />
    </a>
  </li>
</ul>
