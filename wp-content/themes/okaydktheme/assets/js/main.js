(function() {
    const cursor = document.querySelector('.animated-cursor');
    const trail = document.querySelector('.cursor-trail');

    document.addEventListener('mousemove', (event) => {
        if (cursor) {
            cursor.style.transform = `translate(${event.clientX}px, ${event.clientY}px)`;
        }
        if (trail) {
            trail.style.transform = `translate(${event.clientX}px, ${event.clientY}px)`;
        }
    });

    const scrollTopBtn = document.querySelector('.scroll-top');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            scrollTopBtn && scrollTopBtn.classList.add('is-visible');
        } else {
            scrollTopBtn && scrollTopBtn.classList.remove('is-visible');
        }
    });

    scrollTopBtn && scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const heroRotators = document.querySelectorAll('.rotating-text span');
    let currentRotator = 0;
    if (heroRotators.length > 1) {
        setInterval(() => {
            heroRotators[currentRotator].classList.remove('is-active');
            currentRotator = (currentRotator + 1) % heroRotators.length;
            heroRotators[currentRotator].classList.add('is-active');
        }, 2500);
    } else if (heroRotators.length === 1) {
        heroRotators[0].classList.add('is-active');
    }

    const locomotiveContainer = document.querySelector('#page');
    if (locomotiveContainer && window.LocomotiveScroll) {
        const locoScroll = new LocomotiveScroll({
            el: locomotiveContainer,
            smooth: true,
            multiplier: 1.1,
            tablet: { smooth: true },
            smartphone: { smooth: true }
        });

        if (window.ScrollTrigger) {
            gsap.registerPlugin(ScrollTrigger);
            ScrollTrigger.scrollerProxy(locomotiveContainer, {
                scrollTop(value) {
                    return arguments.length ? locoScroll.scrollTo(value, 0, 0) : locoScroll.scroll.instance.scroll.y;
                },
                getBoundingClientRect() {
                    return { top: 0, left: 0, width: window.innerWidth, height: window.innerHeight };
                },
                pinType: locomotiveContainer.style.transform ? 'transform' : 'fixed'
            });

            const revealSections = document.querySelectorAll('[data-scroll]');
            revealSections.forEach((section) => {
                gsap.fromTo(section, { autoAlpha: 0, y: 60 }, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 1.1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: section,
                        scroller: locomotiveContainer,
                        start: 'top 80%'
                    }
                });
            });

            ScrollTrigger.addEventListener('refresh', () => locoScroll.update());
            ScrollTrigger.refresh();
        }
    } else if (window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
        const revealSections = document.querySelectorAll('[data-scroll]');
        revealSections.forEach((section) => {
            gsap.fromTo(section, { autoAlpha: 0, y: 60 }, {
                autoAlpha: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 80%'
                }
            });
        });
    }

    const parallaxLayers = document.querySelectorAll('.parallax-layer');
    parallaxLayers.forEach((layer, index) => {
        gsap.to(layer, {
            x: () => index % 2 === 0 ? 120 : -160,
            y: () => index % 2 === 0 ? -80 : 90,
            repeat: -1,
            yoyo: true,
            duration: 8 + index * 2,
            ease: 'sine.inOut'
        });
    });

    if (typeof SimpleLightbox !== 'undefined') {
        new SimpleLightbox('.okaydktheme-lightbox-trigger');
    }
})();
