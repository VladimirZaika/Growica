(function () {
  'use strict';

  function _classCallCheck(a, n) {
    if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function");
  }
  function _defineProperties(e, r) {
    for (var t = 0; t < r.length; t++) {
      var o = r[t];
      o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o);
    }
  }
  function _createClass(e, r, t) {
    return r && _defineProperties(e.prototype, r), Object.defineProperty(e, "prototype", {
      writable: !1
    }), e;
  }
  function _toPrimitive(t, r) {
    if ("object" != typeof t || !t) return t;
    var e = t[Symbol.toPrimitive];
    if (void 0 !== e) {
      var i = e.call(t, r);
      if ("object" != typeof i) return i;
      throw new TypeError("@@toPrimitive must return a primitive value.");
    }
    return (String )(t);
  }
  function _toPropertyKey(t) {
    var i = _toPrimitive(t, "string");
    return "symbol" == typeof i ? i : i + "";
  }

  document.addEventListener('DOMContentLoaded', function () {
    var stickyHeaderBrand = /*#__PURE__*/function () {
      function stickyHeaderBrand(headerSelector) {
        _classCallCheck(this, stickyHeaderBrand);
        this.navbar = document.querySelector(headerSelector);
        this.lastScrollTop = 0;
        this.headerHeight = this.navbar.scrollHeight;
        window.addEventListener('scroll', this.onScroll.bind(this));
        window.addEventListener('load', this.onScroll.bind(this));
      }
      return _createClass(stickyHeaderBrand, [{
        key: "onScroll",
        value: function onScroll() {
          var scroll = window.scrollY || document.documentElement.scrollTop;
          if (scroll < 0) scroll = 0;
          if (Math.abs(scroll - this.lastScrollTop) < 2) return;
          if (scroll > this.lastScrollTop) {
            this.navbar.classList.add("scrolled-down");
            this.navbar.classList.remove("scrolled-up");
          } else if (scroll === 0) {
            this.navbar.classList.remove("scrolled-down");
            this.navbar.classList.remove("scrolled-up");
          } else if (scroll < this.lastScrollTop && scroll > 100) {
            this.navbar.classList.remove("scrolled-down");
            this.navbar.classList.add("scrolled-up");
          }
          this.lastScrollTop = scroll;
        }
      }]);
    }();
    if (document.querySelector('header')) {
      new stickyHeaderBrand('.header');
      var header = document.querySelector('header');
      var hasChildrenItem = header.querySelectorAll('.menu-item-has-children');
      if (hasChildrenItem.length > 0) {
        hasChildrenItem.forEach(function (item) {
          var link = item.querySelector('a');
          var itemHref = link.getAttribute('href');
          if (itemHref === '#' || itemHref === '') {
            link.addEventListener('click', function (e) {
              e.preventDefault();
            });
          }
          item.addEventListener('pointerdown', function (e) {
            e.preventDefault();
            e.stopPropagation();
            hasChildrenItem.forEach(function (i) {
              if (i !== item) i.classList.remove('active');
            });
            item.classList.toggle('active');
          });
        });
        document.addEventListener('click', function (e) {
          hasChildrenItem.forEach(function (item) {
            if (!item.contains(e.target)) {
              item.classList.remove('active');
            }
          });
        });
        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape') {
            hasChildrenItem.forEach(function (item) {
              return item.classList.remove('active');
            });
          }
        });
      }
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var navLinks = document.querySelectorAll('.header .menu-item a');
    var bodyLockBrandStatus = true;
    var bodyLockBrandToggleBrand = function bodyLockBrandToggleBrand() {
      var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 500;
      if (document.documentElement.classList.contains('lock')) {
        bodyUnlockBrand(delay);
      } else {
        bodyLockBrand(delay);
      }
    };
    var bodyUnlockBrand = function bodyUnlockBrand() {
      var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 500;
      var body = document.querySelector("body");
      var stickyHeader = document.querySelector("header._header-scroll");
      if (bodyLockBrandStatus) {
        var lock_padding = document.querySelectorAll("[data-lp]");
        setTimeout(function () {
          for (var index = 0; index < lock_padding.length; index++) {
            var el = lock_padding[index];
            el.style.paddingRight = '0px';
          }
          body.style.paddingRight = '0px';
          if (stickyHeader) {
            stickyHeader.style.right = '0px';
          }
          document.documentElement.classList.remove("lock");
        }, delay);
        bodyLockBrandStatus = false;
        setTimeout(function () {
          bodyLockBrandStatus = true;
        }, delay);
      }
    };
    var bodyLockBrand = function bodyLockBrand() {
      var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 500;
      var body = document.querySelector("body");
      var stickyHeader = document.querySelector("header._header-scroll");
      if (bodyLockBrandStatus) {
        var lock_padding = document.querySelectorAll("[data-lp]");
        for (var index = 0; index < lock_padding.length; index++) {
          var el = lock_padding[index];
          el.style.paddingRight = window.innerWidth - document.documentElement.scrollWidth + 'px';
        }
        body.style.paddingRight = window.innerWidth - document.documentElement.scrollWidth + 'px';
        if (stickyHeader) {
          stickyHeader.style.right = (window.innerWidth - document.documentElement.scrollWidth) / 2 + 'px';
        }
        document.documentElement.classList.add("lock");
        bodyLockBrandStatus = false;
        setTimeout(function () {
          bodyLockBrandStatus = true;
        }, delay);
      }
    };
    (function menuInit() {
      if (document.querySelector(".icon-menu")) {
        document.addEventListener("click", function (e) {
          if (bodyLockBrandStatus && e.target.closest('.icon-menu')) {
            bodyLockBrandToggleBrand();
            document.documentElement.classList.toggle("menu-open");
          }
        });
        if (navLinks.length > 0) {
          navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
              if (document.documentElement.classList.contains('menu-open')) {
                bodyLockBrandToggleBrand();
                document.documentElement.classList.remove("menu-open");
              }
            });
          });
        }
      }
    })();
  });

  document.addEventListener('DOMContentLoaded', function () {
    var heroWraps = document.querySelectorAll('.section-js .hero-container');
    if (heroWraps.length > 0) {
      var changePosition = function changePosition(wrap) {
        var leftBlock = wrap.querySelector('.left-block-desk');
        var rightBlock = wrap.querySelector('.right-block-desk');
        var leftBlockBtn = leftBlock ? leftBlock.querySelector('.btn-wrapper') : null;
        if (leftBlockBtn && rightBlock && rightBlock.dataset.position === 'mob-left') {
          if (window.innerWidth < 768) {
            leftBlockBtn.insertAdjacentElement('afterend', rightBlock);
          } else {
            wrap.appendChild(rightBlock);
          }
        }
      };
      heroWraps.forEach(function (wrap) {
        changePosition(wrap);
        window.addEventListener('resize', function () {
          return changePosition(wrap);
        });
      });
    }
  });

})();
