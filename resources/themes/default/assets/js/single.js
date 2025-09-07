document.addEventListener('DOMContentLoaded', function () {

    var facebookReact = document.getElementById("tab-comment-activate-facebook");
    if (facebookReact) {
        document.getElementById("tab-comment-activate-facebook").addEventListener("click", function (event) {
            var i, tabcontent, tablinks, commentSection = this.dataset.comment;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(commentSection).style.display = "block";
            event.currentTarget.className += " active";
        });
    }

    var disqusReact = document.getElementById("tab-comment-activate-disqus");
    if (disqusReact) {
        document.getElementById("tab-comment-activate-disqus").addEventListener("click", function (event) {
        var i, tabcontent, tablinks, commentSection = this.dataset.comment;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(commentSection).style.display = "block";
        event.currentTarget.className += " active";
    });
    }

    var pratikiryaReact = document.getElementById("tab-comment-activate-pratikirya");
    if (pratikiryaReact) {
        document.getElementById("tab-comment-activate-pratikirya").addEventListener("click", function (event) {
            var i, tabcontent, tablinks, commentSection = this.dataset.comment;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(commentSection).style.display = "block";
            event.currentTarget.className += " active";
        });
    }

    var readMoreNewsWriter = document.getElementById("read-more-news-writer");
    if (readMoreNewsWriter) {
        readMoreNewsWriter.addEventListener("click", function (event) {
            var element = document.getElementById("writer-news");
            element.classList.add("show-more");
        });
    }

});

$(function () {
    $('.main-news-content').on('click', '.features-image img, .content-news img', function (e) {
        e.preventDefault();
        console.log('dasdadsa')
        $('#overlay-wrapper')
            .css({backgroundImage: `url(${this.src})`})
            .addClass('open')
            .one('click', function() { $(this).removeClass('open'); });
    });
})
