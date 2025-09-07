$(function () {

    var FeedbackManager = {
        init: function () {
            this.cacheDom();
            this.bind();
            if ($('.feedback-reaction-wrapper').length) {
                this.initReactor();
            }

            if ($('#commentForm').length) {
                this.initSiteComment();
            }
        },

        cacheDom: function () {
            this.$feedbackReactionWrapper = $('.feedback-reaction-wrapper');
        },

        bind: function () {
            this.$feedbackReactionWrapper.on('click', '.do-react', this.react);
        },

        react: function () {
            var reactionType = $(this).data('reaction'), // type
                postIdentifier = $(this).data('identifier'),
                reactionSignature = FeedbackManager.getClient();

            FeedbackManager.initReactHttp(
                reactionType,
                reactionSignature,
                postIdentifier
            );
        },

        initReactor: function () {
            var reactionType = null, // type
                postIdentifier = this.$feedbackReactionWrapper.data('identifier'),
                reactionSignature = FeedbackManager.getClient();

            FeedbackManager.initReactHttp(
                reactionType,
                reactionSignature,
                postIdentifier
            );
        },

        initReactHttp: function (reactionType, reactionSignature, postIdentifier) {
            utils.http.post( router.get('feedback.reaction'), {
                'post-reaction-type': reactionType,
                'post-signature': reactionSignature,
                'post-id': postIdentifier
            }).done(function (data) {
                var summary = data.body.summary;

                if( typeof data.body.current === 'undefined' || data.body.current === null ){
                    return;
                }

                $('.reaction-percentage-0').text(FeedbackManager.resolveReactionPercentage(summary.happy_percentage));
                $('.reaction-percentage-1').text(FeedbackManager.resolveReactionPercentage(summary.sad_percentage));
                $('.reaction-percentage-2').text(FeedbackManager.resolveReactionPercentage(summary.excited_percentage));
                $('.reaction-percentage-3').text(FeedbackManager.resolveReactionPercentage(summary.sleepy_percentage));
                $('.reaction-percentage-4').text(FeedbackManager.resolveReactionPercentage(summary.angry_percentage));
                $('.reaction-percentage-5').text(FeedbackManager.resolveReactionPercentage(summary.surprise_percentage));

                $('.reaction-text-' + data.body.current).css({
                    'text-decoration': 'underline',
                    'font-weight': '900'
                });

                var i;
                for (i = 0; i < 6; i++) {

                    if (data.body.current == i) {
                        return;
                    }

                    $('.reaction-text-' + i).css({
                        'text-decoration': 'none',
                        'font-weight': ''
                    });
                }

                // utils.toast('Reacted successfully!');
            }).fail(function (jqXHR, textStatus) {

            });
        },

        getClient: function () {
            var client = new ClientJS();

            return client.getFingerprint();
        },

        resolveReactionPercentage: function (percentage) {
            return parseInt(percentage).toFixed(0) + '%';
        },

        initSiteComment: function () {
            $('input[name=signature]').val(FeedbackManager.getClient());
        }
    };

    FeedbackManager.init();

});
