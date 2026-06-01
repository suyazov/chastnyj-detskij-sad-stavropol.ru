document.addEventListener("DOMContentLoaded", function () {

  // Vanilla JS phone mask — replaces jQuery.maskedinput
  document.querySelectorAll("input[data-mask]").forEach(function(input) {
    var mask = input.getAttribute("data-mask");
    if (!mask) return;

    function applyMask(val) {
      var result = "", vi = 0;
      for (var i = 0; i < mask.length && vi < val.length; i++) {
        if (mask[i] === "_") {
          if (/[0-9]/.test(val[vi])) { result += val[vi]; vi++; }
          else break;
        } else {
          result += mask[i];
          if (val[vi] === mask[i]) vi++;
        }
      }
      return result;
    }

    input.addEventListener("input", function(e) {
      var digits = input.value.replace(/\D/g, "");
      input.value = applyMask(digits);
      var pos = input.selectionStart;
      if (pos > input.value.length) pos = input.value.length;
      input.setSelectionRange(pos, pos);
    });

    input.addEventListener("focus", function() {
      if (!input.value) {
        var prefix = "";
        for (var i = 0; i < mask.length; i++) {
          if (mask[i] !== "_") prefix += mask[i];
          else break;
        }
        if (prefix) input.value = prefix;
      }
    });
  });

  // Defer Swiper init to avoid forced reflow
  function initSwipers() {
    if (typeof Swiper === "undefined") return;
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

  function initFancybox() {
    if (typeof Fancybox === "undefined") return;
    Fancybox.bind("[data-fancybox=\"gallery\"]", {
      infinite: true,
      dragToClose: true
    });
    Fancybox.bind("[data-fancybox=\"gallery-1\"]", {
      infinite: true,
      dragToClose: true
    });
    Fancybox.bind("[data-fancybox=\"gallery-2\"]", {
      infinite: true,
      dragToClose: true
    });
    Fancybox.bind("[data-fancybox=\"videopresentation\"]", {
      infinite: false,
      videoAutoplay: true
    });
  }

  // With defer, libraries may not be ready at DOMContentLoaded.
  // Use requestIdleCallback with polling fallback.
  function initDeferred() {
    initOffcanvas();
    initAccordions();
    initTooltips();
    initSmoothScroll();
    initLcpOptimization();
    fixCf7Aria();
    initLazyLibraries();
  }

  function pollUntilReady(fn, maxAttempts) {
    var attempts = 0;
    function tryInit() {
      attempts++;
      fn();
      if (attempts < maxAttempts) {
        if (window.requestIdleCallback) {
          requestIdleCallback(tryInit, { timeout: 500 });
        } else {
          setTimeout(tryInit, 100);
        }
      }
    }
    tryInit();
  }

  // Init immediately, then poll for deferred libraries
  initDeferred();
  // Swiper + Fancybox loaded dynamically via initLazyLibraries (no more polling)


  // Accordion — chevron rotates via CSS on .icon
  function initAccordions() {
    document.querySelectorAll(".accordeon__head").forEach(function (item) {
      if (item.dataset.initialized) return;
      item.dataset.initialized = "true";
      item.addEventListener("click", function () {
        var body = this.nextElementSibling;
        body.style.display = body.style.display === "block" ? "none" : "block";
        var icon = this.querySelector(".icon");
        if (icon) {
          icon.style.transform = icon.style.transform === "rotate(180deg)" ? "rotate(0deg)" : "rotate(180deg)";
        }
      });
    });
  }

  // Simple tooltip fallback
  function initTooltips() {
    document.querySelectorAll("[data-bs-toggle=\"tooltip\"]").forEach(function (el) {
      if (el.dataset.initialized) return;
      el.dataset.initialized = "true";
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
  }

  // Smooth scroll for anchor links
  function initSmoothScroll() {
    document.querySelectorAll("a[href^=\"#\"]").forEach(function(link) {
      if (link.dataset.initialized) return;
      link.dataset.initialized = "true";
      link.addEventListener("click", function(e) {
        var targetId = this.getAttribute("href");
        if (targetId === "#" || targetId.length < 2) return;
        var target = document.querySelector(targetId);
        if (!target) return;
        e.preventDefault();
        var formArea = target.querySelector(".cta_row-row") || target;
        formArea.scrollIntoView({ behavior: "smooth", block: "center" });
      });
    });
  }

  // LCP image optimization — fetchpriority (main.webp is now the LCP hero)
  function initLcpOptimization() {
    var lcpImg = document.querySelector("img.main-section__bg");
    if (lcpImg) {
      lcpImg.removeAttribute("loading");
    }
  }

  // Vanilla Offcanvas — replaces Bootstrap JS (~80KB)
  function initOffcanvas() {
    document.querySelectorAll("[data-bs-toggle=\"offcanvas\"][data-bs-target]").forEach(function(trigger) {
      trigger.addEventListener("click", function(e) {
        e.preventDefault();
        var target = document.querySelector(this.getAttribute("data-bs-target"));
        if (!target) return;
        target.classList.add("show");
        document.body.style.overflow = "hidden";
      });
    });
    document.querySelectorAll("[data-bs-dismiss=\"offcanvas\"]").forEach(function(btn) {
      btn.addEventListener("click", function() {
        var oc = this.closest(".offcanvas");
        if (oc) {
          oc.classList.remove("show");
          document.body.style.overflow = "";
        }
      });
    });
    document.querySelectorAll(".offcanvas").forEach(function(oc) {
      oc.addEventListener("click", function(e) {
        if (e.target === this) {
          this.classList.remove("show");
          document.body.style.overflow = "";
        }
      });
    });
  }

  // Lazy load Swiper + Fancybox JS/CSS only when gallery section is near viewport
  var libsLoaded = false;
  function loadScripts(src, cb) {
    var s = document.createElement("script");
    s.src = src;
    s.onload = cb;
    document.head.appendChild(s);
  }
  function initLazyLibraries() {
    var gallerySection = document.querySelector(".gallery-inter, .review");
    if (!gallerySection || typeof IntersectionObserver === "undefined") {
      // Fallback: load immediately if no observer support
      if (!libsLoaded) { libsLoaded = true; loadLibs(); }
      return;
    }

    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !libsLoaded) {
          libsLoaded = true;
          observer.disconnect();
          loadLibs();
        }
      });
    }, { rootMargin: "300px" });

    observer.observe(gallerySection);
  }
  function loadLibs() {
    // Activate async CSS
    var swiperLink = document.querySelector('link[href*="swiper"]');
    if (swiperLink && swiperLink.media === "print") swiperLink.media = "all";
    var fancyLink = document.querySelector('link[href*="fancybox"]');
    if (fancyLink && fancyLink.media === "print") fancyLink.media = "all";

    var templateUri = document.querySelector('[src*="main.js"]');
    var base = templateUri ? templateUri.src.replace(/js\/main\.js.*/, "") : "/wp-content/themes/testerossa/";

    loadScripts(base + "js/swiper-bundle.min.js", function() {
      initSwipers();
      loadScripts(base + "js/fancybox.umd.js", function() {
        initFancybox();
      });
    });
  }

  // Fix ARIA attributes in CF7 form
  function fixCf7Aria() {
    document.querySelectorAll("input[name=\"mask-713\"]").forEach(function(input) {
      if (input.getAttribute("aria-required") === "1") {
        input.setAttribute("aria-required", "true");
      }
      if (input.getAttribute("aria-invalid") === "") {
        input.setAttribute("aria-invalid", "false");
      }
    });
  }

});
