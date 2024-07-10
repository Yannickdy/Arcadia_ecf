document.querySelectorAll('.habitat img').forEach(img => {
    img.addEventListener('click', () => {
        document.querySelectorAll('.info-section').forEach(section => {
            section.classList.remove('active');
        });
        document.getElementById(img.getAttribute('data-info')).classList.add('active');
    });
});
