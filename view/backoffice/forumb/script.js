document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("forumForm");
    const authorName = document.getElementById("authorname");
    const postTitle = document.getElementById("titrePost");
    const postContent = document.getElementById("contenuPost");
    const userType = document.getElementById("typeuser");
    const postType = document.getElementById("typepost");

    // List of bad words for filtering
    const badWords = ["badword1", "badword2", "badword3"]; // Replace with actual bad words

    form.addEventListener("submit", function(event) {
        let isValid = true;
        let errorMessage = "";

        // Validate Author Name
        const authorNameValue = authorName.value.trim();
        if (!/^[a-zA-Z]{5,20}$/.test(authorNameValue)) {
            isValid = false;
            errorMessage += "- Author name must be 5-20 characters long and contain only letters.\n";
        }

        // Validate Post Title
        const postTitleValue = postTitle.value.trim();
        if (!/^[a-zA-Z]{5,20}$/.test(postTitleValue)) {
            isValid = false;
            errorMessage += "- Title must be 5-20 characters long and contain only letters.\n";
        }

        // Validate Post Content
        const postContentValue = postContent.value.trim();
        if (postContentValue.length < 20) {
            isValid = false;
            errorMessage += "- Post content must be at least 20 characters long.\n";
        }
        if (/^\s+$/.test(postContentValue)) {
            isValid = false;
            errorMessage += "- Post content cannot be just spaces or empty paragraphs.\n";
        }
        // Bad words filter
        badWords.forEach((word) => {
            if (postContentValue.toLowerCase().includes(word)) {
                isValid = false;
                errorMessage += `- Post content contains inappropriate language: "${word}".\n`;
            }
        });

        // Validate Type of User Dropdown
        if (userType.value === "") {
            isValid = false;
            errorMessage += "- Please select a valid user type.\n";
        }

        // Validate Post Type Dropdown
        if (postType.value === "") {
            isValid = false;
            errorMessage += "- Please select a valid post type.\n";
        }

        // If validation fails, prevent form submission and show error
        if (!isValid) {
            event.preventDefault();
            alert(errorMessage);
        }
    });
});