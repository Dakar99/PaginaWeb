const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

app.use(bodyParser.json());

// Configura el transporte de Nodemailer
const transporter = nodemailer.createTransport({
    service: 'gmail',  // Puedes cambiar esto a tu proveedor de correo
    auth: {
        user: 'tuemail@gmail.com',  // Reemplaza con el correo del administrador
        pass: 'tucontraseña'        // Reemplaza con la contraseña del correo
    }
});

// Ruta para manejar el envío de correos
app.post('/send-email', (req, res) => {
    const { nombre, apellido, fecha_nacimiento, correo, descripcion } = req.body;

    const mailOptions = {
        from: 'tuemail@gmail.com',
        to: 'admin@example.com',  // Correo del administrador
        subject: 'Nuevo Registro de Usuario',
        text: `Información del usuario:\n\nNombre: ${nombre}\nApellido: ${apellido}\nFecha de Nacimiento: ${fecha_nacimiento}\nCorreo Electrónico: ${correo}\nDescripción: ${descripcion}`
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.error('Error al enviar el correo:', error);
            res.status(500).send('Error al enviar el correo');
        } else {
            console.log('Correo enviado:', info.response);
            res.status(200).send('Correo enviado correctamente');
        }
    });
});

app.listen(PORT, () => {
    console.log(`Servidor escuchando en http://localhost:${PORT}`);
});
