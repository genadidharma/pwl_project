var toast = function(error, message) {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "center",
        backgroundColor: (error ? "#d65656" : "#4fbe87"),
    }).showToast();
};
