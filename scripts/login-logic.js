const form = document.getElementById('loginForm');

form.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent the default form submission behavior

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const req = new XMLHttpRequest();
    req.open("POST", "../handlers/login_handler.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const res = JSON.parse(req.responseText);
            if (res.success) {
                window.location.href = "home.php";
            } else {
                location.reload(); // Refresh the page if login fails
            }
        }
    };
    req.send(`username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`);
});
