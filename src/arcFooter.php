<footer class="mt-5 text-dark pt-3 pb-4 border-top border-arcadiaSecondary border-3 bg-arcadia">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-4 col-lg-4 col-xl-4">
              <a href="index.php">  <img src="image/ARCADIA.png" style="height: 300px;" /></a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="mb-4 font-weight-bold text-arcadiaSecondary">LOCALISATION</h5>
                <p>Parc Zoologique De Brocéliande <br> Forêt de Brocéliande, <br> Paimpont (35380) <br> Ille-et-Vilaine
                </p>
                <h5 class="mb-4 font-weight-bold text-arcadiaSecondary">HORAIRE D'OUVERTURE</h5>
                <p>Toute la semaine : <span id="semaine">9h à 18h</span></p>
                <p>Week-End : <span id="weekend">9h à 20h</span></p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 id="contact" class="mb-4 font-weight-bold text-arcadiaSecondary">CONTACT</h5>
                <p>
                    <img src="image/envelope.ico" style="height: 15px;" alt=""><br>
                </p> <i>Vous pouvez contacté par mail en cliquant ici : </i><br>
                <button class="btn btn-outline-arcadiaTertiary mt-4 px-2" data-bs-toggle="modal"
                    data-bs-target="#modalMail">mail</button>
                <!--modal-->
                <div class="modal fade" id="modalMail">
                    <div class="modal-dialog">
                        <div class="modal-content bg-arcadiaLight">
                            <div class="m-3">
                                <button type="button" class="btn-close d-flex" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <h5 class="modal-title p-3">Contactez nous</h5>
                                <form action="src/traitement.php" method="post">
                                    <label for="mailT" class="form-label">Votre mail</label>
                                    <input type="email" name="email"
                                        class="form-control border border-1 border-arcadiaSecondary"
                                        placeholder="name@example.com" required>

                                    <label for="exampleFormControlTextarea1" class="form-label">Sujet</label>
                                    <input type="text" class="form-control border border-1 border-arcadiaSecondary"
                                        name="sujet">

                                    <label for="exampleFormControlTextarea1" class="form-label">Votre message</label>
                                    <textarea name="message"
                                        class="form-control border border-1 border-arcadiaSecondary"
                                        id="exampleFormControlTextarea1" rows="3" required></textarea>

                                    <button type="submit" class="m-3 btn btn-outline-arcadiaTertiary">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="mt-3">
                    <img src="image/phone.ico" style="height: 20px;" alt=""><br>
                </p><i> 01 23 45 67 89</i>
            </div>
        </div>
    </div>
        
</footer>
<div class="p-2 bg-arcadia text-arcadiaTertiary text-center">Copyright © Arcadia - 2024</div>