var tbody = document.getElementById("filebody");

function tambahkanData() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/filesharing/get_data.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                data.sort(function(a, b) {
                    var dateA = new Date(a.date);
                    var dateB = new Date(b.date);
                    return dateB - dateA;
                });

                data.forEach(function(item) {
                    var row = document.createElement("tr");
                    
                    row.innerHTML = `
                        <td>${item.no}</td>
                        <td>${item.id}</td>
                        <td>${item.nama_file}</td>
                        <td>${item.date}</td>
                        <td>${item.description}</td>
                        <td><button class="unduhButtons" data-filename="${item.nama_file}" type="button">Download</button> </td>
                    `;
                    tbody.appendChild(row);
                });
                var unduhButtons = document.querySelectorAll('.unduhButtons');
                unduhButtons.forEach(function(button){
                button.addEventListener('click', function(){
                var nama_file = button.getAttribute('data-filename');
                unduhFile(nama_file)
    });
});


            } else {
                console.error('Error:', xhr.statusText);
            }
        }
    };
    xhr.onerror = function() {
        console.error('Request failed');
    };
    xhr.send();
}

tambahkanData();

function showUploadForm() {
    var uploadForm = document.getElementById('uploadForm');
    if (uploadForm.style.display === 'none') {
        uploadForm.style.display = 'block';
    } else {
        uploadForm.style.display = 'none';
    }
}

function unduhFile(nama_file) {
    var linkUnduh = document.createElement('a');
    linkUnduh.href = 'http://localhost/filesharing/uploads/' + nama_file;
    linkUnduh.style.display = 'none';
    linkUnduh.download = nama_file;
    document.body.appendChild(linkUnduh);
    linkUnduh.click();
    document.body.removeChild(linkUnduh);
}


