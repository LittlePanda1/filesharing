function validateForm() {
    var username = document.getElementById("usn").value;
    var password = document.getElementById("pw").value;
    if (username == "" || password == "") {
        alert("Username dan password harus diisi");
        return false;
    }
    return true;
}
