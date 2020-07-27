$('.count').each(function () {
    $(this).prop('Counter', 0).animate({
        Counter: $(this).data('target')
    }, {
        duration: 5000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
