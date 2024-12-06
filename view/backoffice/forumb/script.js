// List of bad words (expand this list as needed)
const badWords = ['badword1', 'badword2', 'badword3'];

// Validation function for both forms
function validateForm(event) {
    event.preventDefault(); // Prevent form submission for validation

    // Clear previous error messages
    const errorMessagesDiv = document.getElementById("errorMessages");
    errorMessagesDiv.innerHTML = "";

    // Get the form element
    const form = event.target;

    // Get form values
    const typeUser = form.typeuser.value;
    const typePost = form.typepost.value;
    const title = form.titrePost.value;
    const authorName = form.authorname.value;
    const content = form.contenuPost.value;

    // Validation array to collect error messages
    let errorMessages = [];

    // Validate Type User and Type Post (should not be "Choose...")
    if (typeUser === "" || typePost === "") {
        errorMessages.push("Please select a valid 'Type d'utilisateur' and 'Type de Post'.");
    }

    // Title validation (min 5, max 20 characters, no numbers)
    if (!/^[A-Za-z\s]{5,20}$/.test(title)) {
        errorMessages.push("Title must be between 5 and 20 characters, and contain only letters and spaces.");
    }

    // Author Name validation (alphanumeric and at least 5 characters)
    if (!/^[A-Za-z0-9]{5,}$/.test(authorName)) {
        errorMessages.push("Author name must be at least 5 characters long and contain only letters and numbers.");
    }

    // Content validation (min 10, max 200 characters)
    if (content.length < 10 || content.length > 200) {
        errorMessages.push("Content must be between 10 and 200 characters.");
    }

    // Bad word filtering for content
    for (const word of badWords) {
        if (content.toLowerCase().includes(word)) {
            errorMessages.push("Content contains inappropriate language.");
        }
    }

    // If there are error messages, show them below the form
    if (errorMessages.length > 0) {
        errorMessagesDiv.innerHTML = "<ul>" + errorMessages.map(msg => `<li>${msg}</li>`).join('') + "</ul>";
        return false; // Don't submit the form if there are errors
    }

    // If all validations pass, submit the form
    form.submit();
}

// Attach the validateForm function to both forms
document.getElementById("forumForm").addEventListener("submit", validateForm);
document.getElementById("updateForm").addEventListener("submit", validateForm);