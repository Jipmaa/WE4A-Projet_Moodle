let texte = document.getElementById("texte")
let fichier = document.getElementById("fichier")
let formulaire = document.getElementById("formulaire")

texte.addEventListener("click", () => {
    formulaire.innerHTML = `<div>
<h2>Message Texte</h2>

<form>
<label for="titre">Titre</label>
<input type="text" id="titre" name="titre"> <br>
<label for="description">Description</label>
<textarea id="description" name="description"></textarea> <br>
<button type="submit">Publier</button>
</form>
</div>

`;
});

fichier.addEventListener("click", () => {
    formulaire.innerHTML = `<div>
<h2>Partager un fichier</h2>

<form>
<label for="titre">Titre :</label>
<input type="text" id="titre" name="titre"> <br>
<label for="description">Description :</label>
<textarea id="description" name="description"></textarea> <br>
<label for="fichier">Sélectionner un fichier :</label>
<input type="file" id="upload" name="upload" required> <br>
<button type="submit">Publier</button>
</form>
</div>

`;
});