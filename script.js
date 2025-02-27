// Fonction qui permet d'actualiser la liste des fichiers quand on les supprime
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
            // Analyse le code html de la page pour récupérer la nouvelle liste des fichiers
            var parser = new DOMParser();
            var doc = parser.parseFromString(data, 'text/html');
            var newFileList = doc.getElementById('fileList').innerHTML;

            // Met à jour la liste des fichiers
            document.getElementById('fileList').innerHTML = newFileList;
        })
        .catch(error => console.error('Error:', error));
    }
}