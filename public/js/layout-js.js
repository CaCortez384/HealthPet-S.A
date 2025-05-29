$(document).ready(function () {
    const menuToggle = $('#menu-toggle');
    const navBar = $('#nav-bar');

    menuToggle.click(function () {
        navBar.toggleClass('show');
    });

    // Show or hide sidebar based on window width
    function checkWindowSize() {
        if ($(window).width() > 768) {
            navBar.removeClass('hidden');
            navBar.removeClass('show');
        } else {
            navBar.addClass('hidden');
        }
    }

    // Check window size on load and resize
    checkWindowSize();
    $(window).resize(checkWindowSize);
});
