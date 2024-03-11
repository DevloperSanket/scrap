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
        const $passwordField = $('#form3Example4');
        const type = $passwordField.attr('type') === 'password' ? 'text' : 'password';
        $passwordField.attr('type', type);
        $(this).find('i').toggleClass('fa-eye-slash fa-eye');
    });
});