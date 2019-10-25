

@if ('pattern' === 1)
<header class="c-Header">
    <h1 class="u-text-pink text-center">おすすめ<a class="c-right-icon" href="/search"><img src="/dist/images/search-icon.png" alt=""></a></h1>
    <a class="u-down-arrow u-txt-b d-block text-center mt-3" href="./filter.html">フィルター</a>
</header>

@elseif ('pattern' === 2) 
<header class="c-Header">
    <h1 class="u-text-pink text-center">検索<a class="c-right-icon" href="/search"><img src="/dist/images/close-icon.png" alt=""></a></h1>
    <a class="u-down-arrow u-txt-b d-block text-center mt-3" href="./filter.html">フィルター</a>
    <div class="c-Header__tabs row">
      <div class="col text-center u-bt-border--pink">
        <a class="u-txt-p" href="">友達</a>
      </div>
      <div class="col text-center">
        <a class="u-txt-grey" href="">投稿</a>
      </div>
    </div>
</header>

@elseif ('pattern' === 3) {
<header class="c-Header--short">
  <div class="c-Header--short__inner">
    <p class="position-relative u-txt-b text-left u-pl-40">
      <a class="c-left-icon" href="/search"><img src="/dist/images/arrow-left-icon.png" alt=""></a>
      写真家
      <a class="c-right-icon" href="/search"><img src="/dist/images/close-icon.png" alt=""></a>
    <p>
  </div>
</header>
}
@endif