document.addEventListener('DOMContentLoaded', function () {

    var body = document.body;

    document.getElementById("main-wrapper").addEventListener("click", function () {
        body.classList.remove("expandMenu");
    });

    document.getElementById("close-side-menu").addEventListener("click", function () {
        body.classList.remove("expandMenu");
    });

    document.getElementById("expand-primary-menu").addEventListener("click", function () {
        body.classList.add("expandMenu");
    });
});

