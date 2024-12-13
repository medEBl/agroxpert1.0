// Fonction de validation du formulaire
function validateForm(event) {
    // Effacer les messages d'erreur précédents
    clearErrors();

    let isValid = true;

    // Récupérer les valeurs des champs du formulaire
    const datereclamation = document.getElementById("datereclamation").value;
    const description = document.getElementById("description").value;
    const statut = document.getElementById("statut").value;
    const id_user = document.getElementById("id_user").value;
    const tel = document.getElementById("tel").value;
    const adresse = document.getElementById("adresse").value;

    // Validation de la date de réclamation : vérifier si la date est renseignée
    if (!datereclamation) {
        displayError("dateReclamationError", "La date de réclamation est requise.");
        isValid = false;
    }

    // Validation de la description : min 10 caractères, max 299 caractères
    if (description.length < 10 || description.length > 299) {
        displayError("descriptionError", "La description doit avoir entre 10 et 299 caractères.");
        isValid = false;
    }

    // Validation du statut : doit être l'une des valeurs spécifiées
    if (!["non_traite", "en_cours", "traite"].includes(statut)) {
        displayError("statutError", "Statut invalide.");
        isValid = false;
    }

    // Validation de l'ID utilisateur : doit être un nombre valide et supérieur à 0
    if (isNaN(id_user) || id_user <= 0) {
        displayError("idUserError", "L'ID utilisateur doit être un nombre valide.");
        isValid = false;
    }

    // Validation du téléphone : doit être un nombre
    if (!/^\d+$/.test(tel)) {
        displayError("telError", "Le téléphone doit être un nombre valide.");
        isValid = false;
    }

    // Validation de l'email : vérifier qu'il contient "@" et ".com"
    if (!adresse.includes("@") || !adresse.includes(".com")) {
        displayError("emailError", "L'adresse email doit être valide (ex: exemple@domaine.com).");
        isValid = false;
    }

    // Si la validation échoue, empêcher l'envoi du formulaire
    if (!isValid) {
        event.preventDefault(); // Empêcher l'envoi du formulaire si invalidité
    }

    return isValid;
}

// Fonction pour afficher un message d'erreur sous un champ
function displayError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
        errorElement.textContent = message;
    }
}

// Fonction pour effacer les messages d'erreur précédents
function clearErrors() {
    const errorElements = document.querySelectorAll(".error-message");
    errorElements.forEach((el) => {
        el.textContent = "";
    });
}

// Ajouter un écouteur d'événements pour la soumission du formulaire
const form = document.getElementById("reclamationForm");
if (form) {
    form.addEventListener("submit", validateForm);
}
