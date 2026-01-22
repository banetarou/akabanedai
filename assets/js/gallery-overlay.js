/* global jQuery */
jQuery(function ($) {
  // 対象ギャラリー（必要なら .wp-block-gallery にしてもOK）
  const GALLERY_SELECTOR = '.wp-block-gallery-1';

  const $gallery = $(GALLERY_SELECTOR);
  if (!$gallery.length) return;

  // 既にオーバーレイがある場合は作らない
  if ($('.slick-overlay').length) return;

  // オーバーレイDOMを作成
  const $overlay = $(`
    <div class="slick-overlay" aria-hidden="true">
      <button type="button" class="slick-overlay-close" aria-label="Close">×</button>
      <div class="slick-stage"></div>
    </div>
  `);

  $('body').append($overlay);

  // ギャラリーをクローンして、内側の figure.wp-block-image をスライドとして使う
  // 余計な class や figure 外側は不要なので、wp-block-imageだけ抽出して入れる
  const $slides = $gallery.find('figure.wp-block-image').clone(true, true);

  // aタグで画像がリンクされているテーマの場合、クリック無効化（拡大や遷移しない）
  $slides.find('a').each(function () {
    const $a = $(this);
    // aの中にimgがあるときは、aを剥がしてimgだけ残す
    const $img = $a.find('img').first();
    if ($img.length) $a.replaceWith($img);
  });

  $overlay.find('.slick-stage').append($slides);

  let isInited = false;

  function initSlick() {
    if (isInited) return;

    const $stage = $overlay.find('.slick-stage');

    $stage.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      arrows: true,
      dots: true,
      adaptiveHeight: false,
      speed: 350,
      swipe: true,
      touchMove: true,
      // 画像サイズに関係なくセンターに保つ（CSS側でflex）
      // centerMode: false,
    });

    isInited = true;
  }

  function openOverlay(startIndex = 0) {
    initSlick();

    $('body').addClass('is-slick-overlay-open');
    $overlay.addClass('is-open').attr('aria-hidden', 'false');

    // 開いたときに指定indexへ移動
    $overlay.find('.slick-stage').slick('slickGoTo', startIndex, true);
  }

  function closeOverlay() {
    $overlay.removeClass('is-open').attr('aria-hidden', 'true');
    $('body').removeClass('is-slick-overlay-open');
  }

  // ギャラリーの各画像をクリックしたら、その画像から開始
  $gallery.on('click', 'figure.wp-block-image', function (e) {
    e.preventDefault();

    const idx = $(this).index(); // ギャラリー直下のfigure群のindex想定
    openOverlay(idx);
  });

  // 閉じる
  $overlay.on('click', '.slick-overlay-close', function () {
    closeOverlay();
  });

  // 背景クリックで閉じる（ステージ外）
  $overlay.on('click', function (e) {
    if ($(e.target).is('.slick-overlay')) closeOverlay();
  });

  // ESCで閉じる
  $(document).on('keydown', function (e) {
    if (e.key === 'Escape' && $overlay.hasClass('is-open')) {
      closeOverlay();
    }
  });

  // 初期ロード時にオーバーレイを開く
  openOverlay(0);
});
