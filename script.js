// Fade-in effect for sections
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.vision-mission div, .hero');
    sections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transition = 'opacity 1s ease-in-out';
        setTimeout(() => {
            section.style.opacity = '1';
        }, 500 + index * 300);
    });
});

// Simple fade-in effect for About Us section
document.addEventListener('DOMContentLoaded', () => {
    const aboutUs = document.querySelector('.about-us');
    aboutUs.style.opacity = '0';
    aboutUs.style.transition = 'opacity 1s ease-in-out';
    setTimeout(() => {
        aboutUs.style.opacity = '1';
    }, 300);
});