function handlePeticion(url) {
    window.open(url, "_blank");

    // Define the event listener as a named function
    function handleMessage(event) {
        if (event.data.status) {
            Swal.fire({
                title: event.data.message,
                icon: event.data.status,
                showClass: {
                    popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                    `,
                },
                hideClass: {
                    popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                    `,
                },
            });
        }
    }

    // Add the event listener
    window.addEventListener("message", handleMessage, false);
}
