const toggleTournamentCreation = () => {
    const tournamentCreationDiv = document.getElementById("tournament-creation-div")

    tournamentCreationDiv.style.display === 'none' ? tournamentCreationDiv.style.display = 'block' :
    tournamentCreationDiv.style.display = 'none'
}

const toggleTournamentEdition = (idTorneo) => {
    const tournamentEditionDiv = document.getElementById(`tournament-edition-div-${idTorneo}`)
    const tournamentEditionBtn = document.getElementById(`tournament-edition-btn-${idTorneo}`)

    tournamentEditionDiv.style.display === 'none' ? tournamentEditionDiv.style.display = 'block' :
    tournamentEditionDiv.style.display = 'none'

    tournamentEditionBtn.style.display === 'none' ? tournamentEditionBtn.style.display = 'block' :
    tournamentEditionBtn.style.display = 'none'
}

const buscarUsuarios = (value, idTorneo, fecha) => {
    const searchResults = document.getElementById('searchResults-' + idTorneo)
        if (value.trim() === '') {
            searchResults.innerHTML = ' '
            return;
        }
        const xhr = new XMLHttpRequest()
        xhr.open('POST', '../handlers/actualizar_torneo_handler.php', true)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                searchResults.innerHTML = xhr.responseText;
            }
        };
        
        xhr.send('query=' + encodeURIComponent(value) + '&idTorneo=' + encodeURIComponent(idTorneo) + '&fecha=' + fecha);
    
}

const buscarTorneos = (value) => {
    const searchResults = document.getElementById('lista-torneos-buscados')
    const general = document.getElementById('lista-torneos-general')


    if (value.trim() === '') {
        general.style.display = 'block'
        searchResults.style.display = 'none'
        searchResults.innerHTML = ' '
        return;
    }

    const xhr = new XMLHttpRequest()
    xhr.open('POST', '../handlers/buscar_torneos_handler.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            general.style.display = 'none'
            searchResults.style.display = 'block'
            searchResults.innerHTML = xhr.responseText;
        }
    };
    
    xhr.send('query=' + encodeURIComponent(value));
}

const inscribirUsuario = (idUser, idTorneo, fecha) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../handlers/inscribir_usuario_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
        }
    };

    xhr.send('idUser=' + idUser + '&idTorneo=' + idTorneo + '&fecha=' + fecha);
}

const borrarInscripcion = (idUser, idTorneo, fecha) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../handlers/borrar_inscripcion_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
        }
    };

    xhr.send('idUser=' + idUser + '&idTorneo=' + idTorneo + '&fecha=' + fecha);
}

const editarTorneo = () => {
    const idTorneo = document.getElementById('idTorneo').value
    const titulo = document.getElementById('titulo').value
    const fecha = document.getElementById('fecha').value
    const hora = document.getElementById('hora').value

    const xhr = new XMLHttpRequest()
    xhr.open('POST', '../handlers/editar_torneo_handler.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Torneo editado correctamente.")
            location.reload()
        }
    };

    xhr.send('idTorneo=' + idTorneo + '&titulo=' + titulo + '&fecha=' + fecha + '&hora=' + hora)

    return false
}