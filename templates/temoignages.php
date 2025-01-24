

<section class="container cartEmu">
    <div><h2 class="text-center m-2">TÉMOIGNAGES</h2></div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Témoignange 1 -->
        <?php
        require_once 'includes/config/database.php';
        $db = connectDB();

        $query = "SELECT nom_prenom, qualification, 
                  message, 
                  DATE_FORMAT(date, '%d/%m/%Y') 
                  AS date_formatee 
                  FROM temoignages 
                  ORDER BY date DESC";

        $result = $db->query($query);

        $count = 0;
        while ($temoignage = $result->fetch_assoc()) {
            if ($count >= 6) break;
            echo "
            <div class='col'>
                <div class='card h-100 shadow p-3 mb-5'>
                    <div class='card-body bg_card'>
                        <h5 class='card-title'>{$temoignage['qualification']}</h5>
                        <p class='card-text'>{$temoignage['message']}</p>
                        <p class='card-text'>{$temoignage['date_formatee']}</p>
                        <p class='card-text text-end fst-italic'>{$temoignage['nom_prenom']}</p>
                    </div>
                </div>
            </div>";

            $count++;
        }

        $db->close();
        ?>
</section>
        

    <!-- Form questionaire du témoignage -->
    <section class="container">
        <div class="formeLine rounded mt-4 shadow p-3 mb-5">
            <form method="POST" action="">
                <legend class="mb-2 ">Laisser votre témoignage</legend>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Nom et prènom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prènom">
                </div>

                <div class="mb-2">
                    <legend>Qualification</legend>
                    <input type="radio" class="btn-check" name="options" id="option1" value="Mmm..." autocomplete="off">
                    <label class="btn btn-danger" for="option1">Mmm...</label>

                    <input type="radio" class="btn-check" name="options" id="option2" value="Moyen" autocomplete="off">
                    <label class="btn btn-secondary" for="option2">Moyen</label>

                    <input type="radio" class="btn-check" name="options" id="option4" value="Superbe!" autocomplete="off" checked>
                    <label class="btn btn-success" for="option4">Superbe!</label>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="Votre message"></textarea>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning mt-2 mb-2" id="liveToastBtn">Envoyer</button>
                </div>
            </form> 
        </div>
    </section>
    
    
