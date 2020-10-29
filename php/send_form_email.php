<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "bo.eamonn@gmail.com";
    $email_subject = "Contact Portfolio SIte";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Dit emailadres lijkt niet geldig te zijn.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Uw voornaam lijkt niet te kloppen.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'Uw achternaam lijkt niet te kloppen.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'U moet waarschijnlijk meer characters gebruiken.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->

    <style>
      body { text-align: center; padding: 0px; 	background-color: #292c2f; }
      h1 { font-size: 50px; }
      body { font: 20px Helvetica, sans-serif; color: #333; }
      article { display: block; text-align: left; width: 650px; margin: 0 auto; color: white;}
      p { text-align: justify; }
      a { color: #dc8100; text-decoration: none; }
      a:hover { color: #333; letter-spacing: 2px; font-weight: 500;}
      #name{ color: #db0b10; text-align: unset;}
      #date{ text-align: right; }
    </style>
    <article>
    <h1>Email is verzonden</h1>
      <p>
        Uw contact email is verzonden. Ik zal zo spoedig mogelijk contact met u opnemen. U word binnen enkele seconden terug gestuurd naar de home page. Om direct terug te gaan klik <a href="/index.html">hier</a>.
      </p>
      <p id="name">
        - Bo-Eamonn
      </p>
    </article>
<?php
 
}
?>
