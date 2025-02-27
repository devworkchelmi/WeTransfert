function deleteFile(fileName) {
    if (confirm('Voulez-vous vraiment supprimer ce fichier ?')) {
        fetch('telechargement.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'delete=' + encodeURIComponent(fileName)
        })
        .then(response => response.text())
        .then(data => {
            // Parse the response to get the updated file list
            var parser = new DOMParser();
            var doc = parser.parseFromString(data, 'text/html');
            var newFileList = doc.getElementById('fileList').innerHTML;

            // Update the file list in the current page
            document.getElementById('fileList').innerHTML = newFileList;
        })
        .catch(error => console.error('Error:', error));
    }
}