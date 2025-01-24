<?php 

  require 'includes/functions.php';
  incluTemplate('header');
?>
   

    <section class="container container-fluide">
        <!-- Titre h2 -->
        <h2 class="text-center mb-3">RESTAURATION</h2>

        <!-- Cards restauration -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card h-100 shadow p-3 mb-5">
                    <img src="/img/servicios/resto_snack.jpeg" class="card-img-top" alt="image restaurant snack">
                    <div class="card-body">
                        <h5 class="card-title">Menu Arcadia's Snack</h5>
                        <p class="card-text">
                            - Le Croque Lion <br>
                            Un croque-monsieur juteux avec du jambon, du fromage fondant et une couche croustillante de pain doré. Un classique puissant, comme le roi de la savane ! <br>
                            <br>
                            - Jungle Wrap<br>
                            Un wrap frais et savoureux avec du poulet grillé, de l’avocat, de la laitue croquante et une touche de sauce exotique. Parfait pour une aventure rapide.<br>
                            <br>
                            - Savane Burger<br>
                            Un burger gourmet avec de la viande grillée, du fromage cheddar, de la laitue, des tomates et une sauce spéciale qui te transporte directement dans la savane africaine.<br>
                            <br>
                            - Salade du Marais<br>
                            Une salade fraîche avec un mélange de feuilles vertes, de concombre, de carottes, de noix et du fromage de chèvre. Un plat léger inspiré des marais paisibles.<br>
                            <br>
                            - Frites Safari<br>
                            Des frites dorées avec une touche d’épices maison. Parfaites pour accompagner ton expédition culinaire !<br>
                        </p>
                    </div>
                    <h5 class="text-center">Pour faire une reservation</h5>
                    <a href="tel:+33637822946" class="text-center">Tel : (+33) 6 37 82 29 46</a>
                </div>
            </div>
            <div class="col">
            <div class="card h-100 shadow p-3 mb-5">
                    <img src="/img/servicios/resto_gourmet.jpeg" class="card-img-top" alt="image restaurant zoo gourmet">
                    <div class="card-body">
                        <h5 class="card-title">Menu Zoo Gourmet</h5>
                        <p class="card-text">
                            - L'Éléphant Rôti<br>
                            Une généreuse portion de viande rôtie à la perfection, servie avec des pommes de terre fondantes et des légumes de saison. Puissant et savoureux !<br>
                            <br>
                            - Croquant de Tigre<br>
                            Un sandwich croustillant rempli de poulet épicé, garni de fromage fondu et de légumes frais. Un repas rapide et féroce !<br>
                            <br>
                            - Flamand Rose Burger<br>
                            Un burger délicat à base de poisson grillé, accompagné de salade fraîche et d’une sauce citronnée légère. Parfait pour une pause gourmande.<br>
                            <br>
                            - Salade Girafe<br>
                            Une salade colorée avec des fruits frais, des légumes croquants et une touche de vinaigrette maison. Longue sur le goût, légère sur le ventre !<br>
                            <br>
                            - Frites Crocodile<br>
                            Des frites croustillantes avec une sauce piquante qui mord ! L'accompagnement idéal pour les aventuriers du goût.<br>
                        </p>
                    </div>
                    <h5 class="text-center">Pour faire une reservation</h5>
                    <a href="tel:+33637822946" class="text-center">Tel : (+33) 6 37 82 29 46</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container container-fluide mb-4">
        <h2 class="text-center m-4">ACTIVITÉS EN FAMILLE</h2>

        <?php incluTemplate('services'); ?>
    </section>

    <?php  incluTemplate('footer'); ?>