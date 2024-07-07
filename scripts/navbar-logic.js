const adminTab = document.getElementsByClassName('admin-tab')[0]

const showAdminTabs = (e) => {
    const inscripciones = document.createElement('li')
    const users = document.createElement('li')
    const noticias = document.createElement('li')

    inscripciones.innerHTML = '<a href="../pages/inscripciones_admin.php">INSCRIPCIONES</a>'
    inscripciones.setAttribute('id', 'inscripciones_admin')
    inscripciones.setAttribute('class','admin-dd')

    users.innerHTML = '<a href="../pages/users_admin.php">USERS</a>'
    users.setAttribute('id', 'users_admin')
    users.setAttribute('class','admin-dd')

    noticias.innerHTML = '<a href="../pages/noticias_admin.php">NOTICIAS</a>'
    noticias.setAttribute('id', 'noticias_admin')
    noticias.setAttribute('class','admin-dd')

    const dropdownContainer = document.getElementById('admin-dropdown-container');
    dropdownContainer.appendChild(inscripciones)
    dropdownContainer.appendChild(users)
    dropdownContainer.appendChild(noticias)

    const rect = adminTab.getBoundingClientRect();
    let rectTop = rect.bottom - 10
    let rectLeft = rect.left - 15
    dropdownContainer.style.top = `${rectTop}px`
    dropdownContainer.style.left = `${rectLeft}px`
    dropdownContainer.style.display = 'block'
}

const hideAdminTabs = (e) => {
    const dropdownContainer = document.getElementById('admin-dropdown-container')
    dropdownContainer.innerHTML = ''
    dropdownContainer.style.display = 'none'
}


if (adminTab) adminTab.addEventListener('mouseenter', showAdminTabs)
if (adminTab) adminTab.addEventListener('mouseleave', (e) => {
    if (!dropdownContainer.contains(e.relatedTarget)) {
        hideAdminTabs();
    }
})

const dropdownContainer = document.getElementById('admin-dropdown-container')

dropdownContainer.addEventListener('mouseleave', (e) => {
    if (!dropdownContainer.contains(e.relatedTarget)) {
        hideAdminTabs()
    }
})