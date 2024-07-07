// document.getElementById("registerForm").addEventListener("submit", event => {
//     event.preventDefault()
//     console.log("button works")
//     // Get the form inputs
//     const username = document.getElementById("username").value
//     const password = document.getElementById("password").value

//     console.log("username:"+username)
//     console.log(window.location.href)

//     const req = new XMLHttpRequest()
//     req.open("POST", "../handlers/login_handler.php", true)
//     req.setRequestHeader("Content-Type", "multipart/form-data")
//     req.onreadystatechange = () => {
//         if (req.readyState === 4 && req.status === 200) {
//             const res = JSON.parse(req.responseText)
//             if (res.success) {
//                 document.cookie = `username=${res.user.username}; path=/; expires=${new Date(Date.now() + 86400e3).toUTCString()}`;
//                 document.cookie = `role=${res.user.role}; path=/; expires=${new Date(Date.now() + 86400e3).toUTCString()}`;
//                 window.location.href = "home.php";
//             }
//         } else {
//             //document.getElementById("error-message").style.display = "block";
//             //document.getElementById("error-message").classList.add("error");

//             //alert("Login failed. Please check your username and password.");
//         }
//     }
//     console.log(req)
//     req.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
// });
