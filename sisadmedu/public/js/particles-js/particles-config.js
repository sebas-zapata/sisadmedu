particlesJS("particles-js", {
    particles: {
        number: {
            value: 150,
            density: { enable: true, value_area: 900 }
        },
        color: {
            value: "#ffffff" // todas blancas para un efecto limpio
        },
        shape: {
            type: "circle", // solo bolitas
            stroke: { width: 0, color: "#000" }
        },
        opacity: {
            value: 0.8,
            random: true,
            anim: { enable: true, speed: 1.2, opacity_min: 0.3, sync: false }
        },
        size: {
            value: 5,
            random: true,
            anim: { enable: true, speed: 2, size_min: 1.5, sync: false }
        },
        line_linked: {
            enable: true,
            distance: 160,
            color: "#ffffff",
            opacity: 0.2,
            width: 1
        },
        move: {
            enable: true,
            speed: 3,
            direction: "none",
            random: true,
            straight: false,
            out_mode: "out",
            bounce: false
        }
    },
    interactivity: {
        detect_on: "canvas",
        events: {
            onhover: { enable: true, mode: "grab" }, // efecto de atracción al pasar
            onclick: { enable: true, mode: "push" }, // agrega nuevas bolitas al click
            resize: true
        },
        modes: {
            grab: { distance: 200, line_linked: { opacity: 0.5 } },
            push: { particles_nb: 4 }
        }
    },
    retina_detect: true
});
