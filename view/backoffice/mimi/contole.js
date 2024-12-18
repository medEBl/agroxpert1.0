// Attendre que la page soit complètement chargée
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("articleForm");
    const errorElement = document.getElementById("error");

    form.addEventListener("submit", (event) => {
        // Réinitialiser le message d'erreur
        errorElement.textContent = "";

        // Récupérer les champs
        const imageInput = form.querySelector("#image");
        const titreInput = form.querySelector("#titre");
        const contenuInput = form.querySelector("#contenu");
        const dateInput = form.querySelector("#temps");
        const categorieInput = form.querySelector("#categorie");

        // Vérification du titre
        if (titreInput.value.trim().length < 5) {
            errorElement.textContent = "Le titre doit contenir au moins 5 caractères.";
            event.preventDefault();
            return;
        }

        // Vérification du contenu
        if (contenuInput.value.trim().length < 20) {
            errorElement.textContent = "Le contenu doit contenir au moins 20 caractères.";
            event.preventDefault();
            return;
        }

        // Vérification de l'image
        if (!imageInput.files[0]) {
            errorElement.textContent = "Veuillez sélectionner une image.";
            event.preventDefault();
            return;
        }

        // Vérification de la date (elle ne doit pas être dans le futur)
        const inputDate = new Date(dateInput.value);
        const currentDate = new Date();
        if (inputDate > currentDate) {
            errorElement.textContent = "La date ne peut pas être dans le futur.";
            event.preventDefault();
            return;
        }

        // Vérification de la catégorie
        if (categorieInput.value.trim().length < 3) {
            errorElement.textContent = "La catégorie doit contenir au moins 3 caractères.";
            event.preventDefault();
            return;
        }

        // Validation réussie
        alert("Article ajouté avec succès !");
    });
});
