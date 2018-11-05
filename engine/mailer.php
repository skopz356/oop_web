<?php

    // Only process POST reqeusts.
    if(isset($_POST["name"])){
        
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "empty";
            exit;
        }

        //Adress to send
        $to = "tomkobat@gmail.com";

        // Set the email subject.

        $subject = "New contact from $name";
        $email_content = "Jméno: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Zpráva:\n$message\n";
        $email_headers = "Nová zprava z $_SERVER[HTTP_HOST]";

        $result = mail($to, $email_headers, $email_content);
        
        if($result){
            echo "Succ";
        }
        else{
            echo "Bad";
        }
    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
