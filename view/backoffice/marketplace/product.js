document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nameField = document.getElementById("name");
    const priceField = document.getElementById("price");
    const descriptionField = document.getElementById("description");
    const categoryField = document.getElementById("category");
    const stockField = document.getElementById("stock_quantity");
    const ratingField = document.getElementById("rating");
    const discountField = document.getElementById("discount");
    const imageUrlField = document.getElementById("image_url");

    function showError(input, message) {
        let errorDiv = input.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains("error-message")) {
            errorDiv = document.createElement("div");
            errorDiv.classList.add("error-message");
            input.parentNode.insertBefore(errorDiv, input.nextSibling);
        }
        errorDiv.textContent = message;
        input.classList.add("input-error");
    }

    function clearError(input) {
        let errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains("error-message")) {
            errorDiv.remove();
        }
        input.classList.remove("input-error");
    }

    form.addEventListener("submit", function (event) {
        let isValid = true;

        if (nameField.value.trim() === "") {
            showError(nameField, "Le nom du produit est obligatoire.");
            isValid = false;
        } else {
            clearError(nameField);
        }

        const priceValue = parseFloat(priceField.value);
        if (isNaN(priceValue) || priceValue <= 0) {
            showError(priceField, "Le prix doit être un nombre positif.");
            isValid = false;
        } else {
            clearError(priceField);
        }

        if (descriptionField.value.trim() === "") {
            showError(descriptionField, "La description est obligatoire.");
            isValid = false;
        } else {
            clearError(descriptionField);
        }

        if (!categoryField.value) {
            showError(categoryField, "Veuillez sélectionner une catégorie.");
            isValid = false;
        } else {
            clearError(categoryField);
        }

        const stockValue = parseInt(stockField.value);
        if (isNaN(stockValue) || stockValue < 0) {
            showError(stockField, "La quantité en stock doit être un nombre positif ou zéro.");
            isValid = false;
        } else {
            clearError(stockField);
        }

        const ratingValue = parseFloat(ratingField.value);
        if (isNaN(ratingValue) || ratingValue < 0 || ratingValue > 5) {
            showError(ratingField, "La note doit être entre 0 et 5.");
            isValid = false;
        } else {
            clearError(ratingField);
        }

        const discountValue = parseFloat(discountField.value);
        if (isNaN(discountValue) || discountValue < 0 || discountValue > 100) {
            showError(discountField, "La réduction doit être entre 0% et 100%.");
            isValid = false;
        } else {
            clearError(discountField);
        }

        if (imageUrlField.value.trim() === "") {
            showError(imageUrlField, "L'URL de l'image est obligatoire.");
            isValid = false;
        } else {
            clearError(imageUrlField);
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
