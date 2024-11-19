document.addEventListener('DOMContentLoaded', function() {
    // Get all the view buttons for threads and comments
    const viewThreadButtons = document.querySelectorAll('.view-thread');
    const viewCommentsButtons = document.querySelectorAll('.view-comments');

    // Get all the thread and comment sections
    const fullThreads = document.querySelectorAll('.full-thread');
    const commentsSections = document.querySelectorAll('.comments-section');

    // Initially, hide all full threads and comments
    fullThreads.forEach(thread => thread.style.display = 'none');
    commentsSections.forEach(section => section.style.display = 'none');

    // Show the full thread when the "View Thread" button is clicked
    viewThreadButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            // Toggle the visibility of the current full thread
            fullThreads[index].style.display = fullThreads[index].style.display === 'none' ? 'block' : 'none';
            commentsSections[index].style.display = 'none'; // Hide comments when viewing the thread
        });
    });

    // Show the comments section when the "View Comments" button is clicked
    viewCommentsButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            // Toggle the visibility of the current comments section
            commentsSections[index].style.display = commentsSections[index].style.display === 'none' ? 'block' : 'none';
            fullThreads[index].style.display = 'none'; // Hide the thread when viewing comments
        });
    });
});