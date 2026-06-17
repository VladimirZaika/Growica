document.addEventListener( 'DOMContentLoaded', () => {
    let navLinks = document.querySelectorAll('.header .menu-item a');
    let bodyLockVibeStatus = true;
    let bodyLockVibeToggleVibe = (delay = 500) => {
        if (document.documentElement.classList.contains('lock')) {
            bodyUnlockVibe(delay);
        } else {
            bodyLockVibe(delay);
        }
    };

    let bodyUnlockVibe = (delay = 500) => {
        let body = document.querySelector("body");
        let stickyHeader = document.querySelector("header._header-scroll");

        if (bodyLockVibeStatus) {
            let lock_padding = document.querySelectorAll("[data-lp]");

            setTimeout(() => {
                for (let index = 0; index < lock_padding.length; index++) {
                    const el = lock_padding[index];
                    el.style.paddingRight = '0px';
                }
                body.style.paddingRight = '0px';
                if(stickyHeader){
                    stickyHeader.style.right = '0px';
                }
                document.documentElement.classList.remove("lock");
            }, delay);
            bodyLockVibeStatus = false;
            setTimeout(function () {
                bodyLockVibeStatus = true;
            }, delay);
        }
    };

    let bodyLockVibe = (delay = 500) => {
        let body = document.querySelector("body");
        let stickyHeader = document.querySelector("header._header-scroll");

        if (bodyLockVibeStatus) {
            let lock_padding = document.querySelectorAll("[data-lp]");

            for (let index = 0; index < lock_padding.length; index++) {
                const el = lock_padding[index];
                el.style.paddingRight = window.innerWidth - document.documentElement.scrollWidth + 'px';
            }

            body.style.paddingRight = window.innerWidth - document.documentElement.scrollWidth + 'px';

            if (stickyHeader) {
                stickyHeader.style.right = (window.innerWidth - document.documentElement.scrollWidth) / 2 + 'px';
            }

            document.documentElement.classList.add("lock");
    
            bodyLockVibeStatus = false;
            
            setTimeout(function () {
                bodyLockVibeStatus = true;
            }, delay);
        }
    }

    (function menuInit() {
        if (document.querySelector(".icon-menu")) {
            document.addEventListener("click", function (e) {
                if (bodyLockVibeStatus && e.target.closest('.icon-menu')) {
                    bodyLockVibeToggleVibe();
                    document.documentElement.classList.toggle("menu-open");
                }
            });

            if (navLinks.length > 0) {
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        if (document.documentElement.classList.contains('menu-open')) {
                            bodyLockVibeToggleVibe();
                            document.documentElement.classList.remove("menu-open");
                        }
                    });
                });
            }
        };
    })();
} );