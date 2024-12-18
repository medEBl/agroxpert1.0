document.querySelector('form').addEventListener('submit', function (event) {
    const name = document.querySelector('[name="name"]').value.trim();
    const email = document.querySelector('[name="email"]').value.trim();
    const password = document.querySelector('[name="password"]').value.trim();
    const adresse = document.querySelector('[name="adresse"]').value.trim();
    const typeUser = document.querySelector('[name="typeUser"]').value.trim();

    let errors = [];

    // Vérification des champs vides
    if (!name) errors.push("Le champ Nom est requis.");
    if (!email) errors.push("Le champ Email est requis.");
    if (!password) errors.push("Le champ Mot de passe est requis.");
    if (!adresse) errors.push("Le champ Adresse est requis.");
    if (!typeUser) errors.push("Veuillez sélectionner un rôle.");

    // Validation de l'email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email && !emailPattern.test(email)) {
        errors.push("L'adresse email est invalide.");
    }

    // Validation du mot de passe (au moins 8 caractères)
    if (password && password.length < 8) {
        errors.push("Le mot de passe doit contenir au moins 8 caractères.");
    }

    // Si des erreurs sont détectées, on empêche l'envoi du formulaire
    if (errors.length > 0) {
        event.preventDefault(); // Empêche la soumission du formulaire
        alert(errors.join("\n")); // Affiche les erreurs
    }
});
