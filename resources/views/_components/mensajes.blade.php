

 @if (session('success'))
    <script>
        let mensaje = document.createElement("p");
        mensaje.innerHTML = "{{ session('success') }}";
        mensaje.style.backgroundColor = 'green';
        mensaje.style.height = '100%';
        mensaje.style.width = '100%';
        mensaje.classList.add("centrar")
        let mensajes = document.getElementById("mensajes");
        mensajes.appendChild(mensaje);
        setTimeout(() => {
            mensajes.innerHTML = "";
        }, 3000);
    </script>
@endif

