<!-- Loader oculto -->
<div id="loaderOverlay" style="
  display:none;
  position:fixed;
  top:0; left:0;
  width:100%; height:100%;
  background: rgba(33, 37, 41, 0.75); /* Gris oscuro Bootstrap con transparencia */
backdrop-filter: blur(6px);  
  z-index:9999;
  display:flex;
  justify-content:center;
  align-items:center;
  flex-direction:column;
">
    <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Cargando...</span>
    </div>
    <p class="mt-3 fw-bold text-white">Cargando...</p>
</div>