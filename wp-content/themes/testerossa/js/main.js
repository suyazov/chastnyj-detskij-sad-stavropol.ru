document.addEventListener("DOMContentLoaded", function () {

  // Vanilla JS phone mask — replaces jQuery.maskedinput
  document.querySelectorAll('input[data-mask]').forEach(function(input) {
    var mask = input.getAttribute('data-mask');
    if (!mask) return;
    var defs = {'_':'[0-9]'};

    function applyMask(val) {
      var result = '', vi = 0;
      for (var i = 0; i < mask.length && vi < val.length; i++) {
        if (mask[i] === '_') {
          if (/[0-9]/.test(val[vi])) { result += val[vi]; vi++; }
          else break;
        } else {
          result += mask[i];
          if (val[vi] === mask[i]) vi++;
        }
      }
      return result;
    }

    input.addEventListener('input', function(e) {
      var digits = input.value.replace(/\D/g, '');
      input.value = applyMask(digits);
      var pos = input.selectionStart;
      if (pos > input.value.length) pos = input.value.length;
      input.setSelectionRange(pos, pos);
    });

    input.addEventListener('focus', function() {
      if (!input.value) {
        var prefix = '';
        for (var i = 0; i < mask.length; i++) {
          if (mask[i] !== '_') prefix += mask[i];
          else break;
        }
        if (prefix) input.value = prefix;
      }
    });
  });

  // Defer Swiper init to avoid forced reflow
  function initSwipers() {
    if (document.querySelector(".swiper1")) {
      new Swiper(".swiper1", {
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: { 768: { slidesPerView: 4, spaceBetween: 40 } },
        loop: true,
        slidesPerView: 2,
        spaceBetween: 20,
      });
    }
    if (document.querySelector(".swiper2")) {
      new Swiper(".swiper2", {
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: { 768: { slidesPerView: 3, spaceBetween: 30 } },
        loop: true,
        slidesPerView: 2,
        spaceBetween: 20,
      });
    }
  }
  if (window.requestIdleCallback) {
    requestIdleCallback(initSwipers, { timeout: 2000 });
  } else {
    setTimeout(initSwipers, 100);
  }

  // Accordion — chevron rotates via CSS on .icon
  document.querySelectorAll(".accordeon__head").forEach(function (item) {
    item.addEventListener("click", function () {
      var body = this.nextElementSibling;
      body.style.display = body.style.display === "block" ? "none" : "block";
      var icon = this.querySelector(".icon");
      if (icon) {
        icon.style.transform = icon.style.transform === "rotate(180deg)" ? "rotate(0deg)" : "rotate(180deg)";
      }
    });
  });

  // Simple tooltip fallback (no Bootstrap needed)
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
    el.addEventListener("mouseenter", function () {
      var tip = this.getAttribute("data-bs-title") || this.getAttribute("title");
      if (!tip) return;
      var box = document.createElement("div");
      box.className = "bs-tooltip";
      box.textContent = tip;
      box.style.cssText = "position:absolute;background:#000;color:#fff;padding:6px 12px;border-radius:4px;font-size:13px;z-index:9999;white-space:nowrap;pointer-events:none";
      document.body.appendChild(box);
      var r = this.getBoundingClientRect();
      box.style.top = r.top - box.offsetHeight - 8 + window.scrollY + "px";
      box.style.left = r.left + r.width / 2 - box.offsetWidth / 2 + "px";
      this._tooltip = box;
    });
    el.addEventListener("mouseleave", function () {
      if (this._tooltip) { this._tooltip.remove(); this._tooltip = null; }
    });
  });

  // Smooth scroll for anchor links — scroll to form inside #cta block
  document.querySelectorAll('a[href^="#"]').forEach(function(link) {
    link.addEventListener('click', function(e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#' || targetId.length < 2) return;
      var target = document.querySelector(targetId);
      if (!target) return;
      e.preventDefault();
      var formArea = target.querySelector('.cta_row-row') || target;
      formArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  });

  // LCP image optimization - fetchpriority
  var lcpImg = document.querySelector('img[src*="screenshot_4"]');
  if (lcpImg) {
    lcpImg.setAttribute('fetchpriority', 'high');
    lcpImg.removeAttribute('loading');
  }

  // Fix ARIA attributes in CF7 form
  document.querySelectorAll('input[name="mask-713"]').forEach(function(input) {
    if (input.getAttribute('aria-required') === '1') {
      input.setAttribute('aria-required', 'true');
    }
    if (input.getAttribute('aria-invalid') === '') {
      input.setAttribute('aria-invalid', 'false');
    }
  });

  // Add honeypot spam protection to CF7 forms
  var cf7Form = document.querySelector('.wpcf7-form');
  if (cf7Form) {
    var now = Math.floor(Date.now() / 1000);
    var honeypot = document.createElement('div');
    honeypot.style.position = 'absolute';
    honeypot.style.left = '-9999px';
    honeypot.innerHTML = '<label>Do not fill: <input type="text" name="hp_website" tabindex="-1" autocomplete="off"></label>';
    var timestamp = document.createElement('input');
    timestamp.type = 'hidden';
    timestamp.name = 'form_start_time';
    timestamp.value = now;
    
    var hiddenDiv = cf7Form.querySelector('div[style*="display: none"]');
    if (hiddenDiv) {
      hiddenDiv.appendChild(honeypot);
      hiddenDiv.appendChild(timestamp);
    }
  }

  // Initialize Fancybox for galleries and videos
  if (typeof Fancybox !== 'undefined') {
    console.log('Fancybox loaded, initializing...');
    Fancybox.bind('[data-fancybox]', {
      infinite: false,
      videoAutoplay: true
    });
  } else {
    console.log('Fancybox not found');
  }

});
