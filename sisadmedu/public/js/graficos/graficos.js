document.addEventListener("DOMContentLoaded", () => {
    const datosDiv = document.getElementById("datos-dashboard");
    if (!datosDiv) return;

    const datos = {
        estudiantes: parseInt(datosDiv.dataset.estudiantes, 0),
        usuarios: parseInt(datosDiv.dataset.usuarios, 0),
        docentes: parseInt(datosDiv.dataset.docentes, 0),
        grados: parseInt(datosDiv.dataset.grados, 0),
        horarios: parseInt(datosDiv.dataset.horarios, 0),
        materias: parseInt(datosDiv.dataset.materias, 0),
        asignaciones: parseInt(datosDiv.dataset.asignaciones, 0)
    };

    const etiquetas = ["Estudiantes", "Usuarios", "Docentes", "Grados", "Horarios", "Materias", "Asignaciones"];
    const valores = [
        datos.estudiantes,
        datos.usuarios,
        datos.docentes,
        datos.grados,
        datos.horarios,
        datos.materias,
        datos.asignaciones,
    ];

    const colores = ["#461c68", "#7E08CA", "#333", "#6c4a83", "#9c6bdc", "#b89fe1", "#d4c7f0"];

    // PIE
    if (document.getElementById("pieChart")) {
        new Chart(document.getElementById("pieChart"), {
            type: "pie",
            data: {
                labels: etiquetas,
                datasets: [{
                    data: valores,
                    backgroundColor: colores
                }]
            },
            options: { responsive: true }
        });
    }

    // LINE
    if (document.getElementById("lineChart")) {
        new Chart(document.getElementById("lineChart"), {
            type: "line",
            data: {
                labels: etiquetas,
                datasets: [{
                    label: "Evolución",
                    data: valores,
                    borderColor: "#461c68",
                    backgroundColor: "white",
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    // BARRAS (RECTOR)
    if (document.getElementById("barChart")) {
        new Chart(document.getElementById("barChart"), {
            type: "bar",
            data: {
                labels: etiquetas,
                datasets: [{
                    label: "Cantidad",
                    data: valores,
                    backgroundColor: colores
                }]
            },
            options: { responsive: true }
        });
    }

    // HORIZONTAL (RECTOR)
    if (document.getElementById("horizontalChart")) {
        new Chart(document.getElementById("horizontalChart"), {
            type: "bar",
            data: {
                labels: etiquetas,
                datasets: [{
                    label: "Valores",
                    data: valores,
                    backgroundColor: colores
                }]
            },
            options: {
                responsive: true,
                indexAxis: "y"
            }
        });
    }

    // RADAR (RECTOR)
    if (document.getElementById("radarChart")) {
        new Chart(document.getElementById("radarChart"), {
            type: "radar",
            data: {
                labels: etiquetas,
                datasets: [{
                    label: "Comparativa",
                    data: valores,
                    backgroundColor: "rgba(70,28,104,0.3)",
                    borderColor: "#461c68"
                }]
            },
            options: { responsive: true }
        });
    }

    // DONUT (RECTOR)
    if (document.getElementById("donutChart")) {
        new Chart(document.getElementById("donutChart"), {
            type: "doughnut",
            data: {
                labels: etiquetas,
                datasets: [{
                    data: valores,
                    backgroundColor: colores
                }]
            },
            options: { responsive: true }
        });
    }

});
