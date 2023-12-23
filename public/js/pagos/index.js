$(document).ready(function () {
    setTimeout(function () {
        window.opener.postMessage(
            { status: "completed" },
            "http://127.0.0.1:8000"
        );
    }, 10000);
});
