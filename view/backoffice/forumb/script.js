document.addEventListener('DOMContentLoaded', () => {
    const forumForm = document.getElementById('forumpost');
    const postList = document.getElementById('listpost').querySelector('.cards');

    // Array to hold posts
    let posts = [];

    // Function to render posts
    function renderPosts() {
        postList.innerHTML = '';
        posts.forEach((post, postIndex) => {
            const postCard = document.createElement('div');
            postCard.classList.add('card');
            postCard.innerHTML = `
                <h3>${post.title}</h3>
                <p>${post.content}</p>
                <p><strong>Date de création :</strong> ${post.createdAt}</p>
                <div class="actions">
                    <a href="#" class="edit" data-index="${postIndex}">Modifier</a>
                    <a href="#" class="delete" data-index="${postIndex}">Supprimer</a>
                </div>
                <div class="comments">
                    <h4>Commentaires</h4>
                    <div class="commentList" id="commentList-${postIndex}"></div>
                    <form class="commentForm" data-index="${postIndex}">
                        <input type="text" placeholder="Votre commentaire" required>
                        <button type="submit">Ajouter</button>
                    </form>
                </div>
            `;
            postList.appendChild(postCard);
            renderComments(postIndex);
        });
    }

    // Function to render comments
    function renderComments(postIndex) {
        const commentList = document.getElementById(`commentList-${postIndex}`);
        const comments = posts[postIndex].comments || [];
        commentList.innerHTML = '';
        comments.forEach((comment, commentIndex) => {
            const commentDiv = document.createElement('div');
            commentDiv.classList.add('comment');
            commentDiv.innerHTML = `
                <p><strong>Auteur :</strong> Utilisateur${commentIndex + 1}</p>
                <p>${comment}</p>
                <div class="actions">
                    <a href="#" class="edit-comment" data-post="${postIndex}" data-index="${commentIndex}">Modifier</a>
                    <a href="#" class="delete-comment" data-post="${postIndex}" data-index="${commentIndex}">Supprimer</a>
                </div>
            `;
            commentList.appendChild(commentDiv);
        });
    }

    // Handle post submission
    forumForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const title = forumForm.titleP.value;
        const content = forumForm.contentP.value;
        const createdAt = new Date().toLocaleString();

        posts.push({ title, content, createdAt, comments: [] });
        forumForm.reset();
        renderPosts();
    });

    // Handle post deletion
    postList.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete')) {
            const index = e.target.dataset.index;
            posts.splice(index, 1);
            renderPosts();
        }
    });

    // Handle post editing
    postList.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit')) {
            const index = e.target.dataset.index;
            const post = posts[index];
            const newTitle = prompt("Modifier le titre du post :", post.title);
            const newContent = prompt("Modifier le contenu du post :", post.content);

            if (newTitle !== null && newContent !== null) {
                posts[index].title = newTitle;
                posts[index].content = newContent;
                renderPosts();
            }
        }
    });

    // Handle comment submission
    postList.addEventListener('submit', (e) => {
        if (e.target.classList.contains('commentForm')) {
            e.preventDefault();
            const postIndex = e.target.dataset.index;
            const comment = e.target.querySelector('input').value;

            posts[postIndex].comments.push(comment);
            e.target.reset();
            renderComments(postIndex);
        }
    });

    // Handle comment deletion
    postList.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-comment')) {
            const postIndex = e.target.dataset.post;
            const commentIndex = e.target.dataset.index;

            posts[postIndex].comments.splice(commentIndex, 1);
            renderComments(postIndex);
        }
    });

    // Handle comment editing
    postList.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-comment')) {
            const postIndex = e.target.dataset.post;
            const commentIndex = e.target.dataset.index;
            const comment = posts[postIndex].comments[commentIndex];

            const newComment = prompt("Modifier votre commentaire :", comment);
            if (newComment !== null) {
                posts[postIndex].comments[commentIndex] = newComment;
                renderComments(postIndex);
            }
        }
    });
});