<?php 

  require 'includes/functions.php';
  
  incluTemplate('header');
?>

    <!-- Titre -->
    <div class="shadow p-3 mb-5">
        <h1 class="text-center"><strong>NOS CONTACTER</strong></h1>
    </div>

    <!-- Image de lion -->
    <div class="img_contact"></div>

    <!-- formulaire du contact -->
    <section class="container container fluide">
        <div class="container formeLine rounded mt-4 shadow p-3 mb-5">
            <form action="POST">
                <legend class="mb-2 ">Contactez-nous !</legend>
                <!-- Nom -->
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom et prènom</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre prènom">
                </div>    
                <!-- E-mail -->
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <!-- Message -->
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Votre message"></textarea>
                </div>

                <!-- Button envoyer -->
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-warning mt-2 mb-2 " id="liveToastBtn">Envoyer</button>
                </div>
                <!-- Message modale sucess -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="/img/success.png" class="rounded me-2" alt="success">
                            <strong class="me-auto">Bien reçu !</strong>
                            <small>il y a 2 secondes</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                        Merci, votre message sera verifiée et traité le plus vite possible.
                        </div>
                    </div>
                </div>                
            </form>
        </div>
        <div>
            <div class="card shadow p-3 mb-5">
                <div class="card-body">
                    <h4 class="card-text">Nos coordonnées</h4>
                    <p class="card-text">Adresse : Forêt de Brocéliande, 35380 Paimpont, Bretagne.</p>
                    <p class="card-text">Téléphone : 06 37 82 29 46</p>
                    <p class="card-text">Email : solrac.sr7@gmail.com</p>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2971.2704049679223!2d-2.1796059705630872!3d48.01505047291391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sfr!2sfr!4v1728284913791!5m2!1sfr!2sfr" width="max" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </section>
            





<?php   incluTemplate('footer'); ?>
  