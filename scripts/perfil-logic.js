const formInputs = ['idUser', 'username' , 'nombre', 'apellidos', 'telefono', 'fechanacimiento', 'sexo', 'direccion']

const inputNodes = {}

for (let input of formInputs) {
    inputNodes[input] = document.querySelector(`input#perfil-${input}`) ? document.querySelector(`input#perfil-${input}`) :
                        document.querySelector(`textarea#perfil-${input}`) ? document.querySelector(`textarea#perfil-${input}`) :
                        document.querySelector(`select#perfil-${input}`)
}

for (let btn of document.querySelectorAll('button')) {
    if (btn.getAttribute('id') && btn.getAttribute('id').includes('editar-perfil'))
        {
            btn.addEventListener('click', (e) => {
                e.preventDefault()

                toggleProfileEdit(e)

            })
        }
    
    if(btn.getAttribute('id') && btn.getAttribute('id').includes('guardar-perfil')){
        btn.addEventListener('click', (s) => {
            s.preventDefault()

            actualizarUsuarioPerfil(s)

        })
    }
}

const actualizarUsuarioPerfil = (s) => {

    const inputValues = {}

    for (let input of formInputs) {
        let box = document.querySelector(`#perfil-${input}`)
        if (box) {inputValues[input] = box.value} else inputValues[input] = ''
    }

    let idUser = inputValues['idUser']
    let username = inputValues['username']
    let nombre = inputValues['nombre']
    let apellidos = inputValues['apellidos']
    let telefono = inputValues['telefono']
    let fecha_nacimiento = inputValues['fechanacimiento']
    let sexo = inputValues['sexo']
    let direccion = inputValues['direccion']

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../handlers/actualizar_usuario_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload()
            toggleProfileEdit(s)
        }
    };

    const data = `idUser=${encodeURIComponent(idUser)}&username=${encodeURIComponent(username)}&nombre=${encodeURIComponent(nombre)}
    &apellidos=${encodeURIComponent(apellidos)}&telefono=${encodeURIComponent(telefono)}
    &fecha_nacimiento=${encodeURIComponent(fecha_nacimiento)}&sexo=${encodeURIComponent(sexo)}&direccion=${encodeURIComponent(direccion)}`;
    xhr.send(data);
}

const toggleProfileEdit = (event) => {

    const targetIdSplit = event.target.id.split('-')

    let inputId = inputNodes[targetIdSplit[2]].id
    let input = inputNodes[targetIdSplit[2]]
    console.log("targetIdSplit: ",targetIdSplit, "\ninputId:", inputId, "\ninput",input)  
    let editBtn = document.getElementById(`editar-${inputId}`)
    let saveBtn = document.getElementById(`guardar-${inputId}`)

    switch (targetIdSplit[0]){
        case 'editar' :
            input.disabled = false
            input.setAttribute('class', 'input-editable')
            editBtn.style.display='none'
            saveBtn.style.display='inline-block'
            break;

        case 'guardar':
            
            break;
        
        default:
            break;
    }    
}

const seePassword = () => {
    const loginPwd = document.getElementById("password") ? document.getElementById("password") : document.createElement('div')
    const pwdInput = document.getElementById("cambiar-password") ? document.getElementById("cambiar-password") : document.createElement('div')
    const pwdConfInput = document.getElementById("confirmar-password") ? document.getElementById("confirmar-password") : document.createElement('div')
    
    loginPwd.setAttribute('type', 'text')
    pwdInput.setAttribute('type', 'text')
    pwdConfInput.setAttribute('type', 'text')
}

const hidePassword = () => {
    const loginPwd = document.getElementById("password") ? document.getElementById("password") : document.createElement('div')
    const pwdInput = document.getElementById("cambiar-password") ? document.getElementById("cambiar-password") : document.createElement('div')
    const pwdConfInput = document.getElementById("confirmar-password") ? document.getElementById("confirmar-password") : document.createElement('div')
    
    loginPwd.setAttribute('type', 'password')
    pwdInput.setAttribute('type', 'password')
    pwdConfInput.setAttribute('type', 'password')
}

const confirmPassword = (idUser) => {
    const pwdInput = document.getElementById("cambiar-password")
    const pwdConfInput = document.getElementById("confirmar-password")

    if (pwdInput.value === pwdConfInput.value) {
        const xhr = new XMLHttpRequest()
        xhr.open('POST', '../handlers/actualizar_usuario_password.php', true)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Contraseña cambiada')
            }
        }

        const data = `idUser=${encodeURIComponent(idUser)}&password=${encodeURIComponent(pwdInput.value)}`

        xhr.send(data)        
    } else {
        alert('Las contraseñas no coinciden.')
    }
}