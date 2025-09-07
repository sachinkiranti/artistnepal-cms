jQuery(document).on('click', '.follow-artist-btn', function () {
    var button = jQuery(this);
    var artistId = button.data('artist-id');
    var action = button.hasClass('follow') ? 'follow_artist' : 'unfollow_artist';

    button.prop('disabled', true);
    button.html('<i class="fa fa-spinner fa-spin" style="margin-right: 5px;"></i> ' + (action === 'follow_artist' ? ' Following...' : ' Unfollowing...'));

    jQuery.ajax({
        type: 'POST',
        url: FollowSysData.ajax_url,
        data: {
            action: action,
            artist_id: artistId,
            security: FollowSysData.nonce
        },
        success: function (response) {
            if (response.success) {
                button.text(response.data.button_text);
                button.toggleClass('follow unfollow');
            } else {
                button.html('Error: ' + (response.data.message || 'Something went wrong'));
            }
        },
        error: function () {
            button.html('Error sending request.');
        },
        complete: function() {
            button.prop('disabled', false);
        }
    });
});
