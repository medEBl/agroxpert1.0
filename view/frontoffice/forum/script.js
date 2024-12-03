document.addEventListener('DOMContentLoaded', function() {
    // Function to set up validation for a form
    function setupFormValidation(formId) {
        const form = document.getElementById(formId);
        if (!form) return; // Skip if the form doesn't exist

        const errorContainer = document.createElement('div'); // Create a container for errors
        form.appendChild(errorContainer); // Append the error container to the form

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form submission immediately

            let errors = [];

            // Get values from form fields
            const userType = document.getElementById('typeuser').value.trim();
            const postType = document.getElementById('typepost').value.trim();
            const authorName = document.getElementById('authorname').value.trim();
            const title = document.getElementById('titrePost').value.trim();
            const content = document.getElementById('contenuPost').value.trim();

            // Bad words list for content filtering
            const badWords = ["badword1", "badword2", "badword3"]; // Add more words as needed

            // Validate User Type (must select either Admin or Member)
            if (userType === '') {
                errors.push('Please select a user type.');
            }

            // Validate Post Type (must select either Discussion or Question)
            if (postType === '') {
                errors.push('Please select a post type.');
            }

            // Validate Author Name (5-20 characters, letters only)
            const authorNameRegex = /^[a-zA-Z]{5,20}$/;
            if (authorName === '') {
                errors.push('Author name is required.');
            } else if (!authorNameRegex.test(authorName)) {
                errors.push('Author name must be between 5 to 20 characters and contain only letters.');
            }

            // Validate Title (5-255 characters, allows letters, spaces, apostrophes, and periods)
            const titleRegex = /^[a-zA-Z0-9\s.'-]{5,255}$/;
            if (title === '') {
                errors.push('Title is required.');
            } else if (!titleRegex.test(title)) {
                errors.push('Title must be between 5 to 255 characters and may contain letters, spaces, apostrophes, and periods.');
            }

            // Validate Content (at least 20 characters)
            if (content === '') {
                errors.push('Content is required.');
            } else if (content.length < 20) {
                errors.push('Content must be at least 20 characters long.');
            }

            // Filter content for bad words
            badWords.forEach(function(badWord) {
                const regex = new RegExp(`\\b${badWord}\\b`, 'i');
                if (regex.test(content)) {
                    errors.push(`Content contains inappropriate words like "${badWord}".`);
                }
            });

            // If there are validation errors, show them and prevent form submission
            if (errors.length > 0) {
                errorContainer.innerHTML = '<ul style="color: red;">' + errors.map(error => `<li>${error}</li>`).join('') + '</ul>';
            } else {
                // Clear previous error messages
                errorContainer.innerHTML = '';

                // No errors, submit the form
                form.submit(); // This triggers form submission if there are no errors
            }
        });
    }

    // Set up validation for both forms
    setupFormValidation('forumForm'); // For adding posts
    setupFormValidation('updatePostForm'); // For updating posts

});