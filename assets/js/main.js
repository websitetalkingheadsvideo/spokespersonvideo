// Scroll-triggered fade-in
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

// Nav scroll state
window.addEventListener('scroll', () => {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
});

// Hero: Vimeo iframe – on overlay click, add autoplay and hide overlay
const heroPlay = document.getElementById('heroPlay');
const heroVideo = document.getElementById('heroVideo');
if (heroPlay && heroVideo && heroVideo.tagName === 'IFRAME') {
    heroPlay.addEventListener('click', () => {
        const src = heroVideo.getAttribute('src') || '';
        heroVideo.setAttribute('src', src + (src.includes('?') ? '&' : '?') + 'autoplay=1');
        heroPlay.style.opacity = '0';
        heroPlay.style.pointerEvents = 'none';
    });
}

// Portfolio: hover-to-play for native video thumbs, modal for Vimeo
document.querySelectorAll('.portfolio-card').forEach(card => {
    const video = card.querySelector('video');
    const hasVimeo = card.hasAttribute('data-vimeo');
    if (!hasVimeo && video?.querySelector('source')?.src) {
        card.addEventListener('mouseenter', () => video.play());
        card.addEventListener('mouseleave', () => { video.pause(); video.currentTime = 0; });
    }
});
document.getElementById('portfolioModal')?.addEventListener('show.bs.modal', (e) => {
    const card = e.relatedTarget;
    const src = card?.classList.contains('portfolio-card') ? card.getAttribute('data-vimeo') : null;
    const iframe = document.getElementById('portfolioModalIframe');
    if (iframe && src) iframe.src = src.replace(/&amp;/g, '&');
});
document.getElementById('portfolioModal')?.addEventListener('hidden.bs.modal', () => {
    const iframe = document.getElementById('portfolioModalIframe');
    if (iframe) iframe.src = '';
});

// Spokesperson demo modal (MP4 from websitetalkingheads.com)
const spokespersonModal = document.getElementById('spokespersonModal');
const spokespersonVideo = document.getElementById('spokespersonModalVideo');
const spokespersonChooseBtn = document.getElementById('spokespersonModalChooseBtn');
let spokespersonModalTrigger = null;
if (spokespersonModal && spokespersonVideo) {
    spokespersonModal.addEventListener('show.bs.modal', (e) => {
        const trigger = e.relatedTarget;
        spokespersonModalTrigger = trigger;
        const src = trigger?.getAttribute('data-video-src');
        const poster = trigger?.getAttribute('data-poster') || '';
        const name = trigger?.getAttribute('data-name') || '';
        if (!src) return;
        spokespersonVideo.poster = poster;
        spokespersonVideo.src = src;
        spokespersonVideo.load();
        spokespersonModal.querySelector('#spokespersonModalLabel').textContent = name ? name + ' – Video Spokesperson' : 'Video Spokesperson';
        if (spokespersonChooseBtn) spokespersonChooseBtn.href = '/contact.php?spokesperson=' + encodeURIComponent(name);
    });
    spokespersonModal.addEventListener('hide.bs.modal', () => {
        if (spokespersonModalTrigger && typeof spokespersonModalTrigger.focus === 'function') {
            spokespersonModalTrigger.focus();
        }
        spokespersonModalTrigger = null;
    });
    spokespersonModal.addEventListener('hidden.bs.modal', () => {
        spokespersonVideo.pause();
        spokespersonVideo.currentTime = 0;
        spokespersonVideo.removeAttribute('src');
        spokespersonVideo.poster = '';
    });
}

// Spokespeople filter: Men / Women (uses data-gender on each card; works with static data or DB-driven)
(function () {
    const section = document.getElementById('top-spokespeople');
    const filterGroup = document.getElementById('spokesperson-filter');
    if (!section || !filterGroup) return;
    const buttons = filterGroup.querySelectorAll('button[data-filter]');
    const cards = section.querySelectorAll('.col[data-gender]');
    if (!buttons.length || !cards.length) return;

    function applyFilter(filter) {
        buttons.forEach((btn) => {
            const isActive = btn.getAttribute('data-filter') === filter;
            btn.classList.toggle('active', isActive);
            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
        cards.forEach((col) => {
            const gender = col.getAttribute('data-gender');
            const show = filter === 'all' || gender === filter;
            col.style.display = show ? '' : 'none';
        });
    }

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            applyFilter(btn.getAttribute('data-filter'));
        });
    });
})();

// Cookie notice: show until Accept, then remember for 1 year
(function () {
    const COOKIE_NAME = 'cookie_consent';
    const COOKIE_DAYS = 365;
    const notice = document.getElementById('cookieNotice');
    const acceptBtn = document.getElementById('cookieAccept');
    if (!notice || !acceptBtn) return;

    function getCookie(name) {
        const v = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
        return v ? v.pop() : '';
    }
    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = name + '=' + value + ';path=/;expires=' + d.toUTCString() + ';SameSite=Lax';
    }

    if (getCookie(COOKIE_NAME)) {
        notice.classList.add('d-none');
    }
    acceptBtn.addEventListener('click', () => {
        setCookie(COOKIE_NAME, '1', COOKIE_DAYS);
        notice.classList.add('d-none');
    });
})();

// Testimonials: show 3 random on each page load
(function () {
    const row = document.getElementById('testimonialsRow');
    if (!row) return;
    const columns = Array.from(row.querySelectorAll('.testimonial-column'));
    if (columns.length < 4) return;

    function shuffle(arr) {
        const a = arr.slice();
        for (let i = a.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [a[i], a[j]] = [a[j], a[i]];
        }
        return a;
    }

    const shuffled = shuffle(columns);
    const showCount = 3;
    shuffled.forEach((col, i) => {
        col.style.display = i < showCount ? '' : 'none';
    });
})();
