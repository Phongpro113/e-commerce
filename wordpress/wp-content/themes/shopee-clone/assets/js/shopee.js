/* Shopee Clone – Main JS */
(function () {
  'use strict';

  /* ── SLIDER ── */
  function initSlider(sliderEl) {
    const track = sliderEl.querySelector('.slider-track');
    const slides = sliderEl.querySelectorAll('.slider-slide');
    const dotsWrap = sliderEl.querySelector('.slider-dots');
    if (!track || slides.length === 0) return;

    let current = 0;
    let autoTimer;

    // Build dots
    slides.forEach(function (_, i) {
      const dot = document.createElement('button');
      dot.className = 'slider-dot' + (i === 0 ? ' active' : '');
      dot.addEventListener('click', function () { goTo(i); });
      dotsWrap.appendChild(dot);
    });

    function goTo(index) {
      current = (index + slides.length) % slides.length;
      track.style.transform = 'translateX(-' + current * 100 + '%)';
      sliderEl.querySelectorAll('.slider-dot').forEach(function (d, i) {
        d.classList.toggle('active', i === current);
      });
    }

    var prev = sliderEl.querySelector('.slider-arrow.prev');
    var next = sliderEl.querySelector('.slider-arrow.next');
    if (prev) prev.addEventListener('click', function () { goTo(current - 1); resetAuto(); });
    if (next) next.addEventListener('click', function () { goTo(current + 1); resetAuto(); });

    function resetAuto() { clearInterval(autoTimer); startAuto(); }
    function startAuto() { autoTimer = setInterval(function () { goTo(current + 1); }, 4000); }
    startAuto();
  }

  document.querySelectorAll('.sp-slider').forEach(initSlider);

  /* ── FLASH SALE COUNTDOWN ── */
  var timerEl = document.querySelector('.flash-timer');
  if (timerEl) {
    var endTime = timerEl.dataset.end ? parseInt(timerEl.dataset.end) : (Date.now() + 4 * 3600 * 1000);
    function updateTimer() {
      var diff = Math.max(0, endTime - Date.now());
      var h = Math.floor(diff / 3600000);
      var m = Math.floor((diff % 3600000) / 60000);
      var s = Math.floor((diff % 60000) / 1000);
      var pad = function (n) { return String(n).padStart(2, '0'); };
      var hEl = timerEl.querySelector('.timer-h');
      var mEl = timerEl.querySelector('.timer-m');
      var sEl = timerEl.querySelector('.timer-s');
      if (hEl) hEl.textContent = pad(h);
      if (mEl) mEl.textContent = pad(m);
      if (sEl) sEl.textContent = pad(s);
    }
    updateTimer();
    setInterval(updateTimer, 1000);
  }

  /* ── SEARCH FOCUS ── */
  var searchInput = document.querySelector('.sp-search-bar input');
  if (searchInput) {
    searchInput.addEventListener('focus', function () {
      this.closest('.sp-search-bar').style.boxShadow = '0 0 0 2px rgba(238,77,45,.4)';
    });
    searchInput.addEventListener('blur', function () {
      this.closest('.sp-search-bar').style.boxShadow = '';
    });
  }

  /* ── STICKY HEADER SHADOW ── */
  var header = document.querySelector('.sp-header');
  if (header) {
    window.addEventListener('scroll', function () {
      header.style.boxShadow = window.scrollY > 4 ? '0 2px 8px rgba(0,0,0,.2)' : '0 1px 4px rgba(0,0,0,.15)';
    });
  }
})();
