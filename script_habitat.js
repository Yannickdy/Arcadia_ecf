document.addEventListener('DOMContentLoaded', () => {
    const habitatImages = document.querySelectorAll('.habitat img');

    habitatImages.forEach(image => {
        image.addEventListener('click', () => {
            const infoId = image.getAttribute('data-info');
            const infoSection = document.getElementById(infoId);

            document.querySelectorAll('.info-section').forEach(section => {
                section.classList.remove('active');
            });

            if (infoSection) {
                infoSection.classList.add('active');
                infoSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});