// Función para abrir el modal de registro
function openRegisterModal() {
    document.getElementById("registerModal").style.display = "flex";
}

// Función para cerrar el modal de registro
function closeRegisterModal() {
    document.getElementById("registerModal").style.display = "none";
    document.getElementById("registerForm").reset(); // Limpiar el formulario
}

// Función para registrar el usuario
function registerUser() {
    // Capturar los valores de los campos de entrada
    const name = document.getElementById("register-name").value;
    const surname = document.getElementById("register-surname").value;
    const email = document.getElementById("register-email").value;
    const password = document.getElementById("register-password").value;
    const birthdate = document.getElementById("register-birthdate").value;
    const description = document.getElementById("register-description").value;
    const type = document.getElementById("register-type").value;

    // Crear el objeto de datos para enviar
    const userData = {
        name: name,
        surname: surname,
        email: email,
        password: password,
        birthdate: birthdate,
        description: description,
        type: type
    };

    // Enviar los datos a la API (reemplaza 'URL_DE_TU_API' con la URL de tu backend)
    fetch('../admin/admin.html', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(userData)
    })
    .then(response => {
        if (response.ok) {
            alert("Usuario registrado con éxito");
            closeRegisterModal();
            document.getElementById("registerForm").reset();
        } else {
            alert("Error al registrar el usuario");
        }
    })
    .catch(error => {
        console.error("Error al registrar el usuario:", error);
    });
}

//botom de editar
// Función para abrir el modal de edición y rellenar los campos con datos del usuario
function openModal(name, surname, description, type) {
    document.getElementById("edit-name").value = name;
    document.getElementById("edit-surname").value = surname;
    document.getElementById("edit-description").value = description;
    document.getElementById("edit-type").value = type;

    document.getElementById("editModal").style.display = "flex";
}

// Función para cerrar el modal de edición
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
    document.getElementById("editForm").reset(); // Limpiar el formulario
}

// Función para guardar los cambios
function saveChanges() {
    // Obtener los valores de los campos editados
    const name = document.getElementById("edit-name").value;
    const surname = document.getElementById("edit-surname").value;
    const description = document.getElementById("edit-description").value;
    const type = document.getElementById("edit-type").value;

    // Lógica para guardar los cambios en la base de datos o backend (aquí puedes implementar la llamada a tu API)
    const updatedUser = {
        name: name,
        surname: surname,
        birthdate: birthdate,
        description: description,
        category: category
    };

    // Simulación de guardar cambios
    console.log("Usuario actualizado:", updatedUser);

    // Cerrar el modal
    closeEditModal();
}

//botom eliminar
let rowToDelete = null;

function confirmDelete(button) {
    // Guarda la fila del botón que se va a eliminar
    rowToDelete = button.parentNode.parentNode;

    // Muestra el modal
    document.getElementById("deleteModal").style.display = "block";
}

function closeModal() {
    // Oculta el modal
    document.getElementById("deleteModal").style.display = "none";
}

function deleteUser() {
    if (rowToDelete) {
        // Elimina la fila del usuario
        rowToDelete.parentNode.removeChild(rowToDelete);
        console.log("Usuario eliminado.");
        closeModal(); // Cierra el modal después de eliminar
    }
}