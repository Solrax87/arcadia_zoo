
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  toastTrigger.addEventListener('click', () => {
    toastBootstrap.show()
  })
}


// Poniendo la fecha (no es necesario)
  const fechaElemento = document.querySelectorAll('.fecha');

  // Crear una nueva instancia de Date (fecha actual)
  const fechaActual = new Date();

  // Formatear la fecha (puedes personalizar el formato según prefieras)
  const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
  const fechaFormateada = fechaActual.toLocaleDateString('fr-FR', opciones);

  fechaElemento.forEach((elemento) => {
    elemento.textContent += fechaFormateada;
  });

  