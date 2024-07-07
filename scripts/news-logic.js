const editBtn = document.getElementById("btn-editar-noticia")
const cancelarNoticiaBtn = document.getElementById("cancelar-noticia")

const toggleEdition = () => {
    const viewMode = document.getElementById('view-mode')
    const editMode = document.getElementById('edit-mode')

    if (editMode.style.display === 'none') {
        editMode.style.display = 'block'
        viewMode.style.display = 'none'
    } else {
        editMode.style.display = 'none'
        viewMode.style.display = 'block'
    }
}

const guardarInfo = () => {
    const infoText = document.getElementById('infoText')
    const infoInput = document.getElementById('infoInput')
    
    infoText.textContent = infoInput.value
    toggleEditMode()
}

function confirmDelete() {
    if (confirm("¿Estás seguro de que deseas borrar esta noticia?")) {
        document.getElementById('borrarNoticiaForm').submit()
    }
}

editBtn.addEventListener("click", () => toggleEdition())
cancelarNoticiaBtn.addEventListener("click", () => toggleEdition())