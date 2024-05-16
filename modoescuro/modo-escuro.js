document.addEventListener('DOMContentLoaded', (event) => {
    const chk = document.getElementById('chk');

    // Carregar tema salvo no localStorage
    const theme = localStorage.getItem('theme');
    if (theme === 'light') {
        document.body.classList.add('light');
        chk.checked = true;
    }

    chk.addEventListener('change', () => {
        document.body.classList.toggle('light');
        if (document.body.classList.contains('light')) {
            localStorage.setItem('theme', 'light');
        } else {
            localStorage.removeItem('theme');
        }
    });
});
