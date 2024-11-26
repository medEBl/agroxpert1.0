// Add event listener to handle validation for all comment forms
document.addEventListener("DOMContentLoaded", () => {
    const commentForms = document.querySelectorAll("form[action='addcomment.php']");

    commentForms.forEach((form) => {
        const textarea = form.querySelector("textarea[name='contentC']");
        const submitButton = form.querySelector("button[type='submit']");

        // Real-time validation feedback
        textarea.addEventListener("input", () => {
            const value = textarea.value.trim();

            // Clear previous error messages
            let errorDiv = form.querySelector(".error-message");
            if (!errorDiv) {
                errorDiv = document.createElement("div");
                errorDiv.className = "error-message";
                form.insertBefore(errorDiv, submitButton);
            }
            errorDiv.textContent = "";

            // Validation rules
            if (value === "") {
                errorDiv.textContent = "The comment cannot be empty.";
                submitButton.disabled = true;
            } else if (value.length > 500) {
                errorDiv.textContent = "The comment must not exceed 500 characters.";
                submitButton.disabled = true;
            } else if (/[^a-zA-Z0-9 .,!?'-]/.test(value)) {
                errorDiv.textContent = "The comment contains forbidden characters.";
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        });

        // Prevent submission if invalid
        form.addEventListener("submit", (event) => {
            const value = textarea.value.trim();
            if (value === "" || value.length > 500 || /[^a-zA-Z0-9 .,!?'-]/.test(value)) {
                event.preventDefault();
                alert("Please correct the errors before submitting.");
            }
        });
    });

    // Confirmation for delete links
    const deleteLinks = document.querySelectorAll("a.delete");
    deleteLinks.forEach((link) => {
        link.addEventListener("click", (event) => {
            const confirmed = confirm("Are you sure you want to delete this item?");
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("forumForm");

    // Form fields
    const authorNameInput = document.getElementById("authorname");
    const titleInput = document.getElementById("titrePost");
    const contentTextarea = document.getElementById("contenuPost");
    const submitButton = form.querySelector("button[type='submit']");

    // Error messages
    const errorMessages = {
        authorname: "Author name must only contain letters and spaces, and be between 2 and 50 characters long.",
        titrePost: "Title must be between 5 and 100 characters and cannot contain special symbols.",
        contenuPost: "Content must be at least 10 characters and no more than 1000 characters.",
        badLanguage: "The content contains inappropriate language. Please revise."
    };

    // List of banned words (extend this list as needed)
    const bannedWords = ["badword1", "badword2", "inappropriate", "offensive"];

    // Helper to display error
    const displayError = (input, message) => {
        let errorDiv = input.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains("error-message")) {
            errorDiv = document.createElement("div");
            errorDiv.className = "error-message";
            input.parentNode.insertBefore(errorDiv, input.nextSibling);
        }
        errorDiv.textContent = message;
        input.classList.add("invalid");
    };

    // Helper to clear error
    const clearError = (input) => {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains("error-message")) {
            errorDiv.textContent = "";
        }
        input.classList.remove("invalid");
    };

    // Validation functions
    const validateAuthorName = () => {
        const value = authorNameInput.value.trim();
        if (!/^[a-zA-Z ]{2,30}$/.test(value)) {
            displayError(authorNameInput, errorMessages.authorname);
            return false;
        }
        clearError(authorNameInput);
        return true;
    };

    const validateTitle = () => {
        const value = titleInput.value.trim();
        if (value.length < 5 || value.length > 60 || /[^a-zA-Z0-9 .,!?'-]/.test(value)) {
            displayError(titleInput, errorMessages.titrePost);
            return false;
        }
        clearError(titleInput);
        return true;
    };

    const validateContent = () => {
        const value = contentTextarea.value.trim();

        // Length validation
        if (value.length < 10 || value.length > 1000) {
            displayError(contentTextarea, errorMessages.contenuPost);
            return false;
        }

        // Bad language filtering
        const lowerCasedValue = value.toLowerCase();
        const containsBadLanguage = bannedWords.some((word) =>
            lowerCasedValue.includes(word)
        );

        if (containsBadLanguage) {
            displayError(contentTextarea, errorMessages.badLanguage);
            return false;
        }

        clearError(contentTextarea);
        return true;
    };

    // Real-time validation
    authorNameInput.addEventListener("input", validateAuthorName);
    titleInput.addEventListener("input", validateTitle);
    contentTextarea.addEventListener("input", validateContent);

    // Form submission validation
    form.addEventListener("submit", (event) => {
        const isAuthorValid = validateAuthorName();
        const isTitleValid = validateTitle();
        const isContentValid = validateContent();

        if (!isAuthorValid || !isTitleValid || !isContentValid) {
            event.preventDefault();
            alert("Please fix the errors in the form before submitting.");
        }
    });
});