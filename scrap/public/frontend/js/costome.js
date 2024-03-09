document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('.animate-on-load');

    elements.forEach(function(element, index) {
        if (index % 2 === 0) {
            element.classList.add('slide-in-left');
        } else {
            element.classList.add('slide-in-right');
        }
    });
});