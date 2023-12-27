$(document).ready(async function () {
    setTimeout(function () {
        window.opener.postMessage(
            { status: STATUS_PAYMENT, message: MESSAGE_PAYMENT },
            URL_SITE
        );
    }, 2000);
});
