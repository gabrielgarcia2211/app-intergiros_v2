function handlePeticion(url){
    window.open(url, "_blank");
    /* window.addEventListener(
        "message",
        (event) => {
            if (event.data.status === "completed") {
                alert("melo");
                //window.removeEventListener("message", handleMessage, false);
            }
        },
        false
    ); */
}