document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('popupDismissed') === 'true') {
        return;
    }

    setTimeout(function() {
        var guestPopup = document.getElementById('login-guest-popup');
        guestPopup.style.display = 'flex';

        var closePopupBtn = document.getElementById('login-close-popup');
        closePopupBtn.addEventListener('click', function() {
            guestPopup.style.display = 'none';
            localStorage.setItem('popupDismissed', 'true');
        });
    }, 5000);
});
