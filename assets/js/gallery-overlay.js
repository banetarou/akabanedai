/* global jQuery */
jQuery(function ($) {
  // 対象ギャラリー（必要なら .wp-block-gallery にしてもOK）
  const GALLERY_SELECTOR = '.wp-block-gallery-1';

  const $body = $('body');
  if (
    !$body.hasClass('single-works') &&
    !$body.hasClass('single-projects')
  ) {
    return;
  }

  const $gallery = $(GALLERY_SELECTOR);
  if (!$gallery.length) return;

  // 既にオーバーレイがある場合は作らない
  if ($('.slick-overlay').length) return;

  // オーバーレイDOMを作成
  const $overlay = $(`
    <div class="slick-overlay" aria-hidden="true">
      <div class="slick-stage"></div>
      <div class="slick-thumbs" aria-label="Gallery thumbnails"></div>
    </div>
  `);

  $('body').append($overlay);

  // ギャラリーをクローンして、内側の figure.wp-block-image をスライドとして使う
  // 余計な class や figure 外側は不要なので、wp-block-imageだけ抽出して入れる
  const $slides = $gallery.find('figure.wp-block-image').clone(true, true);
  const $thumbSlides = $slides.clone(true, true);

  function stripLinks($items) {
    // aタグで画像がリンクされているテーマの場合、クリック無効化（拡大や遷移しない）
    $items.find('a').each(function () {
      const $a = $(this);
      // aの中にimgがあるときは、aを剥がしてimgだけ残す
      const $img = $a.find('img').first();
      if ($img.length) $a.replaceWith($img);
    });
  }

  stripLinks($slides);
  stripLinks($thumbSlides);

  $overlay.find('.slick-stage').append($slides);
  $overlay.find('.slick-thumbs').append($thumbSlides);

  let isInited = false;

  function initSlick() {
    if (isInited) return;

    const $stage = $overlay.find('.slick-stage');

    const $thumbs = $overlay.find('.slick-thumbs');
    const thumbsToShow = Math.min(8, $thumbSlides.length);

    $stage.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      arrows: true,
      dots: false,
      adaptiveHeight: false,
      speed: 700,
      cssEase: 'ease-in-out',
      swipe: true,
      touchMove: true,
      asNavFor: '.slick-thumbs',
      // 画像サイズに関係なくセンターに保つ（CSS側でflex）
      // centerMode: false,
    });

    $thumbs.slick({
      slidesToShow: thumbsToShow,
      slidesToScroll: 1,
      asNavFor: '.slick-stage',
      focusOnSelect: true,
      arrows: false,
      dots: false,
      infinite: true,
      swipe: true,
      touchMove: true,
      variableWidth: true,
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
