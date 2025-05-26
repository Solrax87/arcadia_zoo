
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

// Bouton pour afficher/masquer les cartes d'animaux
// Afficher/Masquer les cartes d'animaux
document.addEventListener('DOMContentLoaded', () => {
  const btn    = document.getElementById('toggleData');
  const cards  = document.getElementById('animalCardContainer');
  
  if (!btn || !cards) return;

  btn.addEventListener('click', () => {
    const isHidden = cards.style.display === 'none';
    cards.style.display = isHidden ? 'flex' : 'none';
    // Ajuste flex/row selon ton CSS (ici flex pour une rangée horizontale)
    btn.textContent = isHidden ? 'Masquer les animaux' : 'Afficher les animaux';
  });
});

  