<script>
    $('body').toggleClass('is-active');
    $("#login-form").submit(function(event) {
        event.preventDefault();
        var ajaxRequest;
        var data = $(this).serialize();
        ajaxRequest= $.ajax({
            url: "engine/login.php",
            type: "post",
            data: data
        });
        ajaxRequest.done(function (response){
            if (response == "Bad"){
                $(".error").show();
            }
        else if (response == "Succ"){
            $("#login-form").hide();
            //location.reload();
            //window.location = "<?php  echo "http://$_SERVER[HTTP_HOST]";?>";
            
        }
        });
    });
</script>