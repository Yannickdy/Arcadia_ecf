document.addEventListener('DOMContentLoaded', () => {
    const smoothScroll = (links) => {
        links.forEach(link => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (href.startsWith('#')) {
                    event.preventDefault();
                    const targetId = href.slice(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    };

    const habitatLinks = document.querySelectorAll('.habitatgrid a');
    const animalLinks = document.querySelectorAll('.animauxgrid a');

    smoothScroll(habitatLinks);
    smoothScroll(animalLinks);
});
