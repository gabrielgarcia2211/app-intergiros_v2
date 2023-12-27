$(document).ready(async function () {
    setTimeout(function () {
        window.opener.postMessage(
            { status: STATUS_PAYMENT, message: MESSAGE_PAYMENT },
            "http://127.0.0.1:80"
        );
    }, 2000);
});
