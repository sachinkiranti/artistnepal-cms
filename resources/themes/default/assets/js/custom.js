var btn = $('#button-top');
$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: 0
    }, '300');
});

(function() {
    try {
        var $_console$$ = console;
        Object.defineProperty(window, "console", {
            get: function() {
                if ($_console$$._commandLineAPI) {
                    var bug = String.fromCodePoint(0x1F41E);
                    var flame = String.fromCodePoint(0x1F525);

                    var logoStyle = [
                        'color: #298ac2',
                        'text-shadow: 2px 2px #298ac2',
                        'background: white',
                        'font-size: 3em',
                        'border: 2px solid #298ac2',
                        'padding: 25px',
                        'font-family: Mukta,sans-serif',
                        'font-weight: bold'
                    ].join(';');

                    var messageStyle = [
                        'background: white',
                        // 'border: 1px solid #298ac2',
                        'color: #298ac2',
                        'display: block',
                        'line-height: 40px',
                        'text-align: center',
                        'font-weight: bold',
                        'width: 100%'
                    ].join(';');

                    console.info('%c'+flame + ' Hi there! The console '+ bug +' is not accessible right now !', messageStyle);
                    console.log('%cHimalaya Khabar', logoStyle);
                    throw "Sorry, for security reasons, the script console is deactivated on himalayakhabar.com";
                }
                return $_console$$
            },
            set: function($val$$) {
                $_console$$ = $val$$
            }
        })
    } catch ($ignore$$) {
    }
})();


console.log('Show the message ..!')
