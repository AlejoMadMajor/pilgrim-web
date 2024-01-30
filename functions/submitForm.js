require("dotenv").config();
const axios = require("axios");

exports.handler = async function (event) {
  const { nombre, "g-recaptcha-response": recaptchaResponse } = JSON.parse(event.body);

  // Verifica reCAPTCHA
  const recaptchaVerification = await axios.post(
    `https://www.google.com/recaptcha/api/siteverify?secret=${process.env.SECRET_KEY}&response=${recaptchaResponse}`
  );

  if (!recaptchaVerification.data.success) {
    return {
      statusCode: 400,
      body: JSON.stringify({ message: "Error en la verificación reCAPTCHA" }),
    };
  }

  // Aquí puedes agregar el código para procesar y enviar el correo electrónico

  return {
    statusCode: 200,
    body: JSON.stringify({ message: "Formulario enviado con éxito" }),
  };
};
