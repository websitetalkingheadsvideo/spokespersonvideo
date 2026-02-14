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

// Hero play button
const heroPlay = document.getElementById('heroPlay');
const heroVideo = document.getElementById('heroVideo');
if (heroPlay && heroVideo) {
    heroPlay.addEventListener('click', () => {
        heroVideo.play();
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
