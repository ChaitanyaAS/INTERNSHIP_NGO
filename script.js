// Fade-in effects for sections
document.addEventListener('DOMContentLoaded', () => {
    // Constants for animation
    const FADE_IN_DURATION = 1000; // Duration of the fade-in (ms)
    const STAGGER_DELAY = 300; // Delay between each section's animation (ms)

    // Fade-in effect for About Us section
    const aboutUs = document.querySelector('.about-us');
    if (aboutUs) {
        aboutUs.style.opacity = '0';
        aboutUs.style.transition = `opacity ${FADE_IN_DURATION}ms ease-in-out`;
        setTimeout(() => {
            aboutUs.style.opacity = '1';
        }, STAGGER_DELAY);
    }

    // Fade-in effect for other sections
    const sections = document.querySelectorAll('.vision-mission div, .hero');
    sections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transition = `opacity ${FADE_IN_DURATION}ms ease-in-out`;
        setTimeout(() => {
            section.style.opacity = '1';
        }, STAGGER_DELAY * (index + 1));
    });
});
