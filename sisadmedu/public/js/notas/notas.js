document.addEventListener("DOMContentLoaded", () => {

    const inputs = document.querySelectorAll('.nota-input');

    // Escuchar en tiempo real
    inputs.forEach(input => {
        input.addEventListener('input', calcularPromedio);
    });

    // Calcular todos los promedios al cargar la página
    calcularTodosLosPromedios();

    function calcularTodosLosPromedios() {
        // Obtener todos los estudiantes distintos
        const estudiantes = new Set();

        inputs.forEach(input => {
            estudiantes.add(input.dataset.estudiante);
        });

        estudiantes.forEach(id => calcularPromedioPorEstudiante(id));
    }

    function calcularPromedio(e) {
        const idEstudiante = this.dataset.estudiante;
        calcularPromedioPorEstudiante(idEstudiante);
    }

    function calcularPromedioPorEstudiante(idEstudiante) {
        const notas = document.querySelectorAll(`input[data-estudiante="${idEstudiante}"]`);

        let total = 0;
        let count = 0;

        notas.forEach(n => {
            const valor = parseFloat(n.value);
            if (!isNaN(valor)) {
                total += valor;
                count++;
            }
        });

        const promedio = count > 0 ? (total / count).toFixed(1) : "0.0";

        document.getElementById(`promedio-${idEstudiante}`).textContent = promedio;
    }

});
document.addEventListener('DOMContentLoaded', function () {

    const rawJson = document.getElementById('notas-data').textContent.trim();
    const notasExistentes = JSON.parse(rawJson);

    const detallesDiv = document.getElementById('detalles');
    const selectPeriodo = document.getElementById('selectPeriodo');
    const resultadoDiv = document.getElementById('resultadoPromedio');
    const boton = document.getElementById('contenedorBoton');

    // Ocultar al cargar
    boton.classList.add('d-none');
    detallesDiv.classList.add('d-none');

    // ----------- FUNCIÓN PARA LIMITAR A 1 DECIMAL ------------
    function limitarUnDecimal(input) {
        let valor = input.value;

        // Solo números y punto
        valor = valor.replace(/[^0-9.]/g, "");

        // Evitar doble punto
        valor = valor.replace(/(\..*)\./g, '$1');

        // Limitar a un decimal
        const partes = valor.split('.');
        if (partes[1]?.length > 1) {
            valor = partes[0] + '.' + partes[1].substring(0, 1);
        }

        input.value = valor;
    }

    // ----------------------------- EVENTO SELECT -----------------------------
    selectPeriodo.addEventListener('change', function () {
        const periodoId = this.value;

        // Opción "-- seleccionar periodo --"
        if (!periodoId) {
            boton.classList.add('d-none');
            detallesDiv.classList.add('d-none');
            detallesDiv.innerHTML = "";
            resultadoDiv.innerHTML = "";
            return;
        }

        // Mostrar botón y tarjetas
        boton.classList.remove('d-none');
        detallesDiv.classList.remove('d-none');

        detallesDiv.innerHTML = "";
        resultadoDiv.innerHTML = "";

        // Datos desde backend
        const data = notasExistentes[periodoId] || { detalles: [], promedio: null };
        const detalles = data.detalles || [];
        const promedio = Number(data.promedio);

        // ---------------------- CREAR LAS 4 TARJETAS ----------------------
        for (let i = 0; i < 4; i++) {
            const nombre = detalles[i] ? detalles[i].nombre_detalle : '';
            const valor = detalles[i] ? detalles[i].valor : '';

            const col = document.createElement('div');
            col.classList.add('col-md-3');

            col.innerHTML = `
                <div class="card p-3 shadow-sm border rounded h-100">
                    <h6 style="color: #461c68;" class="fw-bold mb-2">Nota ${i + 1}</h6>

                    <label class="small text-secondary fw-bold">Descripción</label>
                    <input type="text" class="form-control mb-2"
                        name="detalles[${i}][nombre_detalle]"
                        value="${nombre}"
                        
                        >

                    <label class="small text-secondary fw-bold">Nota</label>
                    <input type="text" class="form-control nota-input"
                        name="detalles[${i}][valor]"
                        value="${valor}">
                </div>
            `;

            detallesDiv.appendChild(col);
        }

        // ---------------------- APLICAR VALIDACIÓN A LOS NUEVOS INPUTS ----------------------
        document.querySelectorAll('.nota-input').forEach(input => {
            input.addEventListener('input', function () {
                limitarUnDecimal(this);
            });
        });

        // ---------------------- PROMEDIO ----------------------
        // Mostrar estado del promedio
        if (detalles.length === 0) {
            resultadoDiv.innerHTML = `
        <span class="text-secondary">Aún no hay notas registradas en este periodo.</span>
    `;
        } else if (!isNaN(promedio)) {
            let color = promedio >= 3 ? "text-success" : "text-danger";
            let textoEstado = promedio >= 3 ? "aprobó" : "reprobó";

            resultadoDiv.innerHTML = `
        Promedio actual:
        <span class="${color}">${promedio} (${textoEstado})</span>
    `;
        }

    });

});
