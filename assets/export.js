// Tab switching
document.querySelectorAll('nav.tabs button').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('nav.tabs button').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.tab-content').forEach(sec => sec.classList.remove('active'));
        document.getElementById(btn.dataset.tab).classList.add('active');
    });
});

// Form validation
document.getElementById('export-form').addEventListener('submit', function (e) {
    const exportType = document.getElementById('export-type');
    const typeError = document.getElementById('type-error');
    let valid = true;

    if (!exportType.value) {
        typeError.style.display = 'block';
        valid = false;
    } else {
        typeError.style.display = 'none';
    }

    if (!valid) {
        e.preventDefault();
    }
});
