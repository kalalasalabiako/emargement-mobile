function updatePreview() {
    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;

    document.getElementById('p-nom').innerText = nom || "-";
    document.getElementById('p-prenom').innerText = prenom || "-";
}
