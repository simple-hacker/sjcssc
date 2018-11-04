
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <footer class="footer pt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                <?php
                    if (!empty($data['club']->emails)) {
                ?>
                        <div class="row mb-3">
                            <div class="col-2">
                                <i class="fa fa-envelope border"></i>
                            </div>
                            <div class="col-10">
                <?php
                            foreach($data['club']->emails as $email) {
                ?>
                                <div class="row pt-2">
                                    <div class="col-5"><?php echo $email->email_title; ?></div>
                                    <div class="col-7"><?php echo $email->email; ?></div>
                                </div>
                <?php
                            }
                ?>
                            </div>
                        </div>
                <?php
                    }
                ?>
                <?php
                    if (!empty($data['club']->addresses)) {
                ?>
                        <div class="row mb-3">
                            <div class="col-2">
                                <i class="fas fa-map-marker-alt border"></i>
                            </div>
                            <div class="col-10">
                <?php
                            foreach($data['club']->addresses as $address) {
                ?>
                                <div class="row pt-2">
                                    <div class="col-5"><?php echo $address->address_title; ?></div>
                                    <div class="col-7"><?php echo $address->address; ?></div>
                                </div>
                <?php
                            }
                ?>
                            </div>
                        </div>
                <?php
                    }
                ?>
                <?php
                    if (!empty($data['club']->phone_numbers)) {
                ?>
                        <div class="row mb-3">
                            <div class="col-2">
                                <i class="fa fa-phone border"></i>
                            </div>
                            <div class="col-10">
                <?php
                            foreach($data['club']->phone_numbers as $phone_number) {
                ?>
                                <div class="row pt-2">
                                    <div class="col-5"><?php echo $phone_number->phone_number_title; ?></div>
                                    <div class="col-7"><?php echo $phone_number->phone_number; ?></div>
                                </div>
                <?php
                            }
                ?>
                            </div>
                        </div>
                <?php
                    }
                ?>
                </div>
                <div class="col-12 col-lg-6 mt-5 text-center">
                    <p><span class="text-muted">St Joseph's Sports and Catholic Social Club</span></p>
                    <p><span>Designed by <a href="http://www.simplehacker.co.uk" target="_blank">Michael Perks</a></span></p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>