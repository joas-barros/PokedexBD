document.addEventListener('DOMContentLoaded', function () {
    const passIn = document.getElementById('password');
    const btn = document.getElementById('togglePassword');
    btn.addEventListener('click', function () {
        const type =
            passIn.getAttribute('type') ===
            'password' ? 'text' : 'password';
        passIn.setAttribute('type', type);
    });
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();
        loginForm.reset(); // Reset the form
        alert('Form submitted');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const passIn = document.getElementById('password1');
    const btn = document.getElementById('togglePassword1');
    btn.addEventListener('click', function () {
        const type =
            passIn.getAttribute('type') ===
            'password' ? 'text' : 'password';
        passIn.setAttribute('type', type);
    });
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();
        loginForm.reset(); // Reset the form
        alert('Form submitted');
    });
});