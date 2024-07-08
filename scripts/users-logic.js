const toggleAdminUserEdit = (idUser) => {
    const viewMode = document.getElementById(idUser)
    const editMode = document.getElementById(`${idUser}-edit`)

    if (viewMode.style.display === 'none') {
        viewMode.style.display = 'table-row'
        editMode.style.display = 'none'
    } else {
        viewMode.style.display = 'none'
        editMode.style.display = 'table-row'
    }
}

const guardarUsuario = (idUser) => {
    const currentUsername = document.getElementById(`currentUsername-${idUser}`)
    const currentNombre = document.getElementById(`currentNombre-${idUser}`)
    const currentApellidos = document.getElementById(`currentApellidos-${idUser}`)
    
    const newUsername = document.getElementById(`newUsername-${idUser}`)
    const newNombre = document.getElementById(`newNombre-${idUser}`)
    const newApellidos = document.getElementById(`newApellidos-${idUser}`)

    currentUsername.innerText = newUsername.value
    currentNombre.innerText = newNombre.value
    currentApellidos.innerText = newApellidos.value

    toggleAdminUserEdit(idUser)
}

const actualizarUsuario = (idUser) => {
    const newUsername = document.getElementById(`newUsername-${idUser}`).value
    const newNombre = document.getElementById(`newNombre-${idUser}`).value
    const newApellidos = document.getElementById(`newApellidos-${idUser}`).value

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../handlers/actualizar_usuario_handler.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    };

    const data = `idUser=${encodeURIComponent(idUser)}&username=${encodeURIComponent(newUsername)}&nombre=${encodeURIComponent(newNombre)}&apellidos=${encodeURIComponent(newApellidos)}`;
    xhr.send(data);
}

const verifyDeleteUser = (idUser) => {
    if (confirm("¿Estás seguro de que deseas borrar este usuario?")) {
        borrarUsuario(idUser)
    }
}

const borrarUsuario = (idUser) => {
    const xhr = new XMLHttpRequest()
    xhr.open('POST', '../handlers/borrar_usuario_handler.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    }

    const data = `idUser=${encodeURIComponent(idUser)}`
    xhr.send(data)
}