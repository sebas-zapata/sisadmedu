document.addEventListener("DOMContentLoaded", function () {
    const hasErrors = document.querySelector('meta[name="has-errors"]')?.content === "true";

    if (hasErrors) {
        // Busca todos los modales que pidan auto-abrirse
        const modals = document.querySelectorAll('[data-auto-show="true"]');

        modals.forEach(modalElement => {
            const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
            modal.show();
        });
    }
});
