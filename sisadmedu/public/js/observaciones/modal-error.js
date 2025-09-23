document.addEventListener("DOMContentLoaded", function () {
    const hasErrors = document.querySelector('meta[name="has-errors"]').content === "true";
    
    if (hasErrors) {
        const modalObservacion = new bootstrap.Modal(document.getElementById("modalObservacion"));
        const modal = bootstrap.Modal.getOrCreateInstance(modalObservacion);
        modal.show();
    }
});
