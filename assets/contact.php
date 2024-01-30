<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica el reCAPTCHA
    $recaptchaSecretKey = "6LfybWApAAAAAFm4iuKQgT1r9m_T7vWV4ZC6RP6X";
    $recaptchaResponse = $_POST["g-recaptcha-response"];

    $recaptchaVerification = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    $recaptchaData = json_decode($recaptchaVerification);

    if (!$recaptchaData->success) {
        // El reCAPTCHA no fue verificado correctamente
        header("Location: 404.html");
        exit();
    }

    // Procesa el formulario y envía el correo
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    // Agrega el procesamiento y el envío del correo aquí
    $destinatario = "diegou.tamb.pol@gmail.com";
    $asunto = "FORMULARIO - PILGRIM";
    mail($destinatario, $asunto, $message);
    // Redirige a una página de éxito
    header("Location: tu_pagina_de_exito.html");
    exit();
}
?>
