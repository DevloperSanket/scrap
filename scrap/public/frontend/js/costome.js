document.addEventListener('DOMContentLoaded', function () {
    var elements = document.querySelectorAll('.animate-on-load');

    elements.forEach(function (element, index) {
        if (index % 2 === 0) {
            element.classList.add('slide-in-left');
        } else {
            element.classList.add('slide-in-right');
        }
    });
});

$(document).ready(function () {
    $('.toggle-password').click(function () {
        const $passwordField = $('#password');
        const type = $passwordField.attr('type') === 'password' ? 'text' : 'password';
        $passwordField.attr('type', type);
        $(this).find('i').toggleClass('fa-eye-slash fa-eye');
    });
});

$(document).ready(function () {
    $('.toggle-password-icon').click(function () {
        const $passwordField = $('#form3Example5');
        const type = $passwordField.attr('type') === 'password' ? 'text' : 'password';
        $passwordField.attr('type', type);
        $(this).find('i').toggleClass('fa-eye-slash fa-eye');
    });
});