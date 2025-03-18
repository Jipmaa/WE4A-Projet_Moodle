let texte = document.getElementById("texte")
let fichier = document.getElementById("fichier")
let formulaire = document.getElementById("formulaire")

texte.addEventListener("click", () => {
    formulaire.innerHTML = `<div>
<h2>Message Texte</h2>

<form>
<label for="titre">Titre :</label>
<input type="text" id="titre" name="titre"> <br>
<p>
        Type du message :
        <input type="radio" name="age" value="information" id="information"> <label for="information">Information</label>
        <input type="radio" name="age" value="important" id="important"> <label for="important">Important</label><br>    
</p>
<label for="description">Description :</label>
<textarea id="description" name="description"></textarea> <br><br>
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
<p>
        Type du message :
        <input type="radio" name="age" value="information" id="information"> <label for="information">Information</label>
        <input type="radio" name="age" value="important" id="important"> <label for="important">Important</label><br>    
</p>
<label for="description">Description :</label>
<textarea id="description" name="description"></textarea> <br><br>
<label for="fichier">Sélectionner un fichier :</label> 
<input type="file" id="upload" name="upload" required> <br><br>
<button type="submit">Publier</button>
</form>
</div>

`;
});