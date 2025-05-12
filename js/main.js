
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


  // Contenu bouton fetch
  document.getElementById('toggleData').addEventListener('click', async function() {
    const animalDataDiv = document.getElementById('animalData');
    const button = document.getElementById('toggleData');

    if (animalDataDiv.style.display === "none") {
        // Fetch solo si no está ya cargado
        if (animalDataDiv.innerHTML.trim() === "") {
            try {
                const response = await fetch('/api/animaux.php');
                const data = await response.json();

                // Contenedor flex
                const container = document.createElement('div');
                container.className = "row justify-content-center"; // <- Bootstrap fila horizontal

                data.forEach(animal => {
                    const card = `
                      <div class="card col-6 col-md-3 m-3 shadow p-3 mb-5 cardZoom" style="width: 18rem;">
                        <img src="/images/${animal.image_path}" class="card-img-top" alt="Image de ${animal.nom}">
                        <div class="card-body">
                          <h5 class="card-title">${animal.nom}</h5>
                          <p class="card-text">Espèce : ${animal.espece}</p>
                        </div>
                      </div>
                    `;
                    container.innerHTML += card;
                });

                animalDataDiv.appendChild(container);

            } catch (error) {
                console.error('Erreur lors du chargement:', error);
                animalDataDiv.innerHTML = "<p>Erreur lors du chargement des animaux.</p>";
            }
        }
        animalDataDiv.style.display = "block";
        button.textContent = "Masquer les animaux";
    } else {
        animalDataDiv.style.display = "none";
        button.textContent = "Afficher les animaux";
    }
});

  