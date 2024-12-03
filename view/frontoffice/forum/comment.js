document.addEventListener('DOMContentLoaded', function() {
            // Function to validate forms
            function validateCommentForm(form) {
                const errorContainer = document.createElement('div'); // Create a container for error messages
                form.appendChild(errorContainer); // Append error container to the form

                form.addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevent default form submission

                            const errors = [];
                            const contentField = form.querySelector('textarea[name="contentC"]'); // Find the content field
                            const content = contentField.value.trim(); // Get trimmed content

                            // Validation: Length
                            if (content.length < 2) {
                                errors.push('Comment must be at least 2 characters long.');
                            } else if (content.length > 40) {
                                errors.push('Comment cannot exceed 40 characters.');
                            }

                            // Validation: Bad words filtering
                            const badWords = ["badword1", "badword2", "badword3"]; // Add more bad words as needed
                            badWords.forEach(function(badWord) {
                                const regex = new RegExp(`\\b${badWord}\\b`, 'i'); // Case-insensitive whole word match
                                if (regex.test(content)) {
                                    errors.push(`Comment contains inappropriate words like "${badWord}".`);
                                }
                            });

                            // Show errors or submit form
                            if (errors.length > 0) {
                                errorContainer.innerHTML = `<ul style="color: red;">${errors.map(error => `<li>${error}</li>`).join('')}</ul>`;
            } else {
                errorContainer.innerHTML = ''; // Clear previous errors
                form.submit(); // Submit the form if validation passes
            }
        });
    }

    // Apply validation to both forms
    const addCommentForm = document.querySelector('form[action="addcomment.php"]');
    if (addCommentForm) {
        validateCommentForm(addCommentForm);
    }

    const updateCommentForm = document.querySelector('form[action="updatecomment.php"]') || document.querySelector('form[method="POST"]');
    if (updateCommentForm) {
        validateCommentForm(updateCommentForm);
    }
});