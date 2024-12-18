// Liste des mots interdits (ajoutez plus de mots si nécessaire)
const badWords = ["badword1", "badword2", "badword3"];

function validateReponseForm(event) {
    // Effacer les messages d'erreur précédents
    clearErrors();

    let isValid = true;

    // Récupérer les valeurs des champs
    const reponse = document.getElementById("reponse").value.trim();
    const dateReponse = document.getElementById("date_reponse").value;

    // Validation de la réponse : min 10 caractères, max 500 caractères
    if (reponse.length < 10 || reponse.length > 500) {
        displayError("reponse", "La réponse doit contenir entre 10 et 500 caractères.");
        isValid = false;
    }

    // Vérification des mots interdits dans la réponse
    if (containsBadWords(reponse)) {
        displayError("reponse", "La réponse contient des mots inappropriés.");
        isValid = false;
    }

    // Validation de la date de réponse : doit être remplie et ne pas être une date future
    if (!dateReponse) {
        displayError("date_reponse", "La date de réponse est obligatoire.");
        isValid = false;
    } else if (new Date(dateReponse) > new Date()) {
        displayError("date_reponse", "La date de réponse ne peut pas être dans le futur.");
        isValid = false;
    }

    // Empêcher l'envoi du formulaire si une validation échoue
    if (!isValid) {
        event.preventDefault();
    }

    return isValid;
}

// Fonction pour afficher un message d'erreur sous un champ
function displayError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.createElement("p");
    errorElement.className = "error-message";
    errorElement.textContent = message;

    // Ajouter le message d'erreur après le champ
    if (field) {
        const parent = field.parentNode;
        const existingError = parent.querySelector(".error-message");
        if (!existingError) {
            parent.appendChild(errorElement);
        }
    }
}

// Fonction pour effacer les messages d'erreur précédents
function clearErrors() {
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach((error) => error.remove());
}

// Fonction pour vérifier la présence de mots interdits
function containsBadWords(inputText) {
    const lowerCaseText = inputText.toLowerCase();
    return badWords.some((word) => lowerCaseText.includes(word));
}

// Ajouter un écouteur d'événements pour la soumission du formulaire
const formReponse = document.getElementById("formReponse");
if (formReponse) {
    formReponse.addEventListener("submit", validateReponseForm);
}
