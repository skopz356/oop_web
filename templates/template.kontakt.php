<?php
session_start();
?>
<!DOCTYPE html>
<?php
include('engine/obsah.php');
echo $head;?>
<body>
    <?php render_menu(); ?>
    

    <script>function initMap(){
        var location = {lat:50.636004, lng:15.607271 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location
        });
        var marker = new google.maps.Marker({
        position:location,
        map:map
        })
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmHT7KusONVtRmx2I_qZxDYpdJ8ggwFU4&&callback=initMap">
    </script>



    <div class="contact">
        <header>
            <h1>Kontakt</h1>
        </header>
        <section>
            <div class="container">
                <div class="row">
                    <aside class="col-xl-6">
                    <address class="tel ver-align font30">
                            <?php echo getDates(1);?>
                    </address>
                         
                        <form id="ajax-contact" method="post">
                            <div class="text-left">
                                <h3>Napište mi </h3>
                            </div>
                            <div class="field">
                                <input type="text" id="name" name="name" placeholder="Jméno" required>
                            </div>

                            <div class="field">
                                <input type="email" id="email" placeholder="Email" name="email" required>
                            </div>

                            <div class="field w-100">
                                <textarea id="message" placeholder="Zpráva" name="message" required></textarea>
                            </div>
                            <div class="field">
                                <div class="g-recaptcha" data-sitekey="6LfQhHAUAAAAAACnFRocHawJxnabD6GVzhuoF_EP"></div>
                            </div>
                            <div class="field">
                                    <button class="btn-black" ype="submit">Odeslat</button>
                                </div>
                        <div class="notification">Děkuji za zpravu</div>
                    </aside>
                    <script>
                        $('#ajax-contact').submit(function(event) {
                        event.preventDefault();
                        var ajaxRequest;
                        if(grecaptcha.getResponse()){
                            console.log(grecaptcha.getResponse());
                            var data = $(this).serialize();
                            ajaxRequest = $.ajax({
                                        url: "engine/mailer.php",
                                        type: 'post',
                                        data: data     
                                        }); 
                            ajaxRequest.done(function(response){
                                if(response == "Succ"){
                                    $('#ajax-contact').hide();
                                }
                            });
                        }
                        else{
                            $('.g-recaptcha').css('border', 'solid 1px red');
                        }              
                        });
                    </script>
                    <div class="col-xl-6">
                        <address class="home">
                            <?php echo getDates(2);?>
                        </address>
                        <div id="map" class="image-res"></div> 
                    <div>
                <div>
            </div>        
        </section>
    <div>
        <?php echo $footer; 
            require_once("engine/textedit.php");
            ?>
</body>
</html>
