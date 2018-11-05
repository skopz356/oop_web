<?php 

if (isset($_SESSION["login"])){
		if ($_SESSION["login"] == TRUE){            
			echo '<script>'."\xA";
            echo '$(".editable").each(function(i){
                var input = $("<input>").attr({
                    type: "hidden",
                    name: "id",
                    value: $(this).attr("value")
                });
                var inputPage = $("<input>").attr({
                    type: "hidden",
                    name: "page",
                    value: '."'".getPageName()."'".'
                });
                var parent = "text";
                if ($(this).parent().is("h2")){
                parent = "heading"
                }
                var inputType = $("<input>").attr({
                    type: "hidden",
                    name: "type",
                    value: parent 
                });
                var s = document.getElementsByClassName("textareedit");
                $(this).after("<form method='."'post'".'class='."'change-form'".'><textarea class='."'textareedit' ".'name='."'editarea' ".'></textarea><input value='."'Odeslat'".'type='."'submit'".'><form>");
                var x = s[i];
                x.value = $(this).text();
                var form = $(this).next();
                form.append(input, inputPage, inputType);
                
            
            });
            $(".change-form").submit(function(event){
                event.preventDefault();
                var data = $(this).serialize();
                var ajaxRequest;
                ajaxRequest= $.ajax({
                    url: "engine/insert.php",
                    type: "post",
                    data: data
                });
                ajaxRequest.done(function(res){
                    if(res == "Succ"){
                    var succ = $("body").append("<div class='."'succSave'".'>Uspesne</div>");
                    location.reload();
                }
                console.log(res);


                    
                
                
                });

            });
				</script>
				
				';
		}
    }
    ?>

    