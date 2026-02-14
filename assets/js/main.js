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
