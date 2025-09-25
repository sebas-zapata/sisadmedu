document.addEventListener("DOMContentLoaded", function () {
    const inputBusqueda = document.getElementById("buscar_acudiente");
    const resultadosDiv = document.getElementById("resultados_acudientes");
    const inputHidden = document.getElementById("acudiente_id");

    inputBusqueda.addEventListener("keyup", function () {
        const query = inputBusqueda.value;

        if (query.length < 2) {
            resultadosDiv.innerHTML = "";
            return;
        }

        fetch(`/buscar-acudientes?query=${query}`)
            .then(response => response.json())
            .then(data => {
                resultadosDiv.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(acudiente => {
                        const li = document.createElement("li");
                        li.classList.add("list-group-item", "list-group-item-action");
                        li.textContent = `${acudiente.nombres} ${acudiente.apellidos} - ${acudiente.documento}`;

                        li.addEventListener("click", function () {
                            inputBusqueda.value = `${acudiente.nombres} ${acudiente.apellidos}`;
                            inputHidden.value = acudiente.id;
                            resultadosDiv.innerHTML = "";
                        });

                        resultadosDiv.appendChild(li);
                    });
                } else {
                    resultadosDiv.innerHTML = '<li class="list-group-item">No se encontraron acudientes</li>';
                }
            });
    });
});