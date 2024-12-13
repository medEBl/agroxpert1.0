<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');

// Instantiate controllers
$forumpostC = new ForumpostController();
$forumcommentC = new ForumCommentController();

// Get all posts
$list = $forumpostC->listpost();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Contact</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesoeet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo">
                <a href="home.html"><img src="images/logo.png"></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.html">Home</a>
                    <a class="nav-item nav-link" href="about.html">Market</a>
                    <a class="nav-item nav-link" href="services.html">Blog</a>
                    <a class="nav-item nav-link" href="products.html">Meteo</a>
                    <a class="nav-item nav-link" href="products.html">Forum</a>
                    <a class="nav-item nav-link" href="contact.html">Contact us</a>
                </div>
            </div>
            <div class="login_menu">
                <ul>
                    <li><a href="#">LOGIN</a></li>
                    <li>
                        <a href="#"><img src="images/search-icon.png"></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- banner section end -->
        <div class="banner_section layout_padding">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital ">Welcome<br> <span style="color: #fff; ">To AgroXpert</span></h1>
                                    <p class="banner_text ">Your Hub for Fresh Produce and Agricultural Expertise</p>

                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                            <div class="custum_menu">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">Market</a></li>
                                    <li><a href="services.html">Blog</a></li>
                                    <li><a href="products.html">Meteo</a></li>
                                    <li class="active"><a href="products.html">Forum</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Explore<br> <span style="color: #fff;">AgroXpert Today!</span></h1>
                                    <p class="banner_text">Sustainably Sourced, Expertly Curated</p>

                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                            <div class="custum_menu">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">Market</a></li>
                                    <li><a href="services.html">Blog</a></li>
                                    <li><a href="products.html">Meteo</a></li>
                                    <li class="active"><a href="products.html">Forum</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Only <br> <span style="color: #fff;">at AgroXpert</span></h1>
                                    <p class="banner_text">Discover Seasonal Flavors and Expert Tips</p>

                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                            <div class="custum_menu">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">Market</a></li>
                                    <li><a href="services.html">Blog</a></li>
                                    <li><a href="products.html">Meteo</a></li>
                                    <li class="active"><a href="products.html">Forum</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- Forum section start  (el header wel footer mayetmashoush) -->
  <!-- Forum section start  (el header wel footer mayetmashoush) -->

  
    

       
    <div class="main-content">
        <header>
            <br><br>
            <h1>Gestion des Forums</h1>
            <div class="add-post">
                <form action="addpostf.php" method="GET" style="text-align: right;">
                    <button type="submit" class="add-comment-btn">Ajouter un Post</button>
                </form>
            </div>

            <div class="search-filters" style="text-align: right;">
    <input type="text" id="searchBar" placeholder="Search Posts..." oninput="filterPosts()">
    
    <!-- Filter by Type User -->
    <select id="filterByTypeUser" onchange="filterByTypeUser()">
        <option value="">Filter by Type User</option>
        <option value="Admin">Admin</option>
        <option value="Member">Member</option>
        
        <!-- Add more options as needed -->
    </select>
    
    <!-- Filter by Type Post -->
    <select id="filterByTypePost" onchange="filterByTypePost()">
        <option value="">Filter by Type Post</option>
       
        <option value="Question">Question</option>
        <option value="Discussion">Discussion</option>
        <!-- Add more options as needed -->
    </select>
    
    <select id="filterByDate" onchange="filterByDate()">
        <option value="">Filter by Date</option>
        <option value="mostRecent">Most Recent First</option>
        <option value="oldestFirst">Oldest First</option>
    </select>
</div>

        </header>

        <main>
            <h2>Liste des Posts</h2>
            <section id="postList">
                <div class="cards">
                    <!-- Loop through the posts and display them -->
                    <?php if ($list) { ?>
                        <?php foreach ($list as $post) { ?>
                            <article class="card" data-title="<?= htmlspecialchars($post['titleP']); ?>" data-typeuser="<?= htmlspecialchars($post['typeuser']); ?>" data-typepost="<?= htmlspecialchars($post['typepost']); ?>" data-createdate="<?= htmlspecialchars($post['createDateP']); ?>">
                                <header>
                                    <h3><?= htmlspecialchars($post['titleP']); ?></h3>
                                    <p><strong>Auteur:</strong> <?= htmlspecialchars($post['authorname']); ?></p>
                                    <p><strong>Type d'utilisateur:</strong> <?= htmlspecialchars($post['typeuser']); ?></p>
                                    <p><strong>Type de post:</strong> <?= htmlspecialchars($post['typepost']); ?></p>
                                </header>

                                <button class="view-button" onclick="togglePostDetails(<?= $post['idpost']; ?>)">Voir le Post</button>
                                <div id="post-details-<?= $post['idpost']; ?>" class="post-details" style="display: none;">
                                    <section>
                                        <p><strong>Type de Post:</strong> <?= htmlspecialchars($post['typepost']); ?></p>
                                        <p><?= htmlspecialchars($post['contentP']); ?></p>
                                    </section>

                                    <footer>
                                        <p><strong>Date de création:</strong> <?= htmlspecialchars($post['createDateP']); ?></p>
                                        <?php if (isset($post['updateDateP'])): ?>
                                            <p><strong>Date de mise à jour:</strong> <?= htmlspecialchars($post['updateDateP']); ?></p>
                                        <?php endif; ?>
                                        <p><strong>Vues:</strong> <span id="view-count-<?= $post['idpost']; ?>"><?= htmlspecialchars($post['nbviewsp']); ?></span></p>
                                        <p><strong>Likes:</strong> <?= htmlspecialchars($post['nblikesp']); ?></p>
                                        <p><strong>Dislikes:</strong> <?= htmlspecialchars($post['nbdislikesp']); ?></p>
                                    </footer>

                                    <!-- Like Button -->
                                    <form action="likepost.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="idpost" value="<?= $post['idpost']; ?>">
                                        <button type="submit">Like</button>
                                    </form>

                                    <!-- Dislike Button -->
                                    <form action="dislikepost.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="idpost" value="<?= $post['idpost']; ?>">
                                        <button type="submit">Dislike</button>
                                    </form>
<br><br>
                                    <!-- Button to toggle comments visibility -->
                                    <button class="view-comments-button" onclick="toggleComments(<?= $post['idpost']; ?>)">Voir les Commentaires</button>

                                    <div id="comments-<?= $post['idpost']; ?>" class="comments" style="display: none;">
                                        <?php
                                        $comments = $forumcommentC->getCommentsByPostId($post['idpost']);
                                        if ($comments) {
                                            foreach ($comments as $comment) { ?>
                                                <div class="comment">
                                                    <p><strong>Commentaire par <?= htmlspecialchars($comment['authorname']); ?>:</strong></p>
                                                    <p><?= htmlspecialchars($comment['contentC']); ?></p>
                                                    <p><small>Publié le: <?= htmlspecialchars($comment['createDateC']); ?></small></p>
                                                    <?php if (isset($comment['updateDateC'])): ?>
                                                        <p><small>Mis à jour le: <?= htmlspecialchars($comment['updateDateC']); ?></small></p>
                                                    <?php endif; ?>
                                                    <div class="comment-reactions">
    
                                                    <?php
    // List of all possible emojis and their default count (0)
    $reaction_types = [
        'heart' => '❤️',
        'thumbs_up' => '👍',
        'thumbs_down' => '👎',
        'laugh' => '😂',
    ];

    // Display each emoji with the count of reactions
    foreach ($reaction_types as $emoji => $icon) {
        // If the emoji matches the current one, use the emoji_count, otherwise set to 0
        if ($comment['emoji'] == $emoji) {
            $count = $comment['emoji_count'];
        } else {
            $count = 0;
        }
        // Display only the icon and count without text
        echo "<span class='reaction-icon'>$icon <span class='count'>$count</span></span>";
    }
    ?>
</div>


<style>
    .emoji {
        cursor: pointer; /* Ensures the cursor is a pointer (clickable) */
    }
    .comment-reactions {
    display: flex;
    gap: 15px; /* Adds space between each emoji */
    flex-wrap: wrap; /* Wraps to the next line if there isn't enough space */
    margin-top: 10px;
    align-items: center; /* Vertically align the items */
}

.reaction-icon {
    font-size: 24px; /* Adjust the size of the emojis */
    display: flex;
    align-items: center; /* Vertically align the emoji and count */
}

.count {
    margin-left: 5px; /* Adds a small space between the emoji and the count */
    font-size: 18px; /* Smaller font size for the count */
}

</style>
                                                        
<form action="reactcomment.php" method="POST" id="reaction-form-<?= $comment['idcommentp']; ?>">
    <input type="hidden" name="idcommentp" value="<?= $comment['idcommentp']; ?>">
    <div class="emoji-container">
        <span class="emoji" data-emoji="heart">❤️</span>
        <span class="emoji" data-emoji="thumbs_up">👍</span>
        <span class="emoji" data-emoji="thumbs_down">👎</span>
        <span class="emoji" data-emoji="laugh">😂</span>
    </div>
</form>


<script>
   // Attach event listeners for all emojis in the current comment
document.querySelectorAll('[id^="reaction-form-"]').forEach(function(form) {
    form.querySelectorAll('.emoji').forEach(function(emojiElement) {
        emojiElement.addEventListener('click', function() {
            // Get the emoji value
            var emoji = emojiElement.getAttribute('data-emoji');

            // Check if the hidden emoji input exists in the form
            let emojiInput = form.querySelector('input[name="emoji"]');
            if (!emojiInput) {
                // If not, create a new hidden input
                emojiInput = document.createElement('input');
                emojiInput.type = 'hidden';
                emojiInput.name = 'emoji';
                form.appendChild(emojiInput);
            }

            // Set the emoji value
            emojiInput.value = emoji;

            // Submit the form
            form.submit();
        });
    });
});

</script>



                                                </div>
                                            <?php }
                                        } else {
                                            echo "<p>Aucun commentaire.</p>";
                                        }
                                        ?>
                                    </div>

                                    <!-- Add Comment Form -->
                                    <form action="addcomment.php" method="POST">
                                        <input type="hidden" name="idpostc" value="<?= $post['idpost']; ?>">
                                        <textarea name="contentC" rows="4" required placeholder="Ajoutez un commentaire..."></textarea><br>
                                        <button type="submit">Ajouter Commentaire</button>
                                    </form>
                                </div>
                            </article>
                        <?php } ?>
                    <?php } else { ?>
                        <p>Aucun post n'a été trouvé.</p>
                    <?php } ?>
                </div>
            </section>
        </main>

        <!-- Alphabet Filter -->
        <footer>
            <div class="alphabet">
                <a href="javascript:void(0);" onclick="filterByLetter('A')">A</a>
                <a href="javascript:void(0);" onclick="filterByLetter('B')">B</a>
                <a href="javascript:void(0);" onclick="filterByLetter('C')">C</a>
                <a href="javascript:void(0);" onclick="filterByLetter('D')">D</a>
                <a href="javascript:void(0);" onclick="filterByLetter('E')">E</a>
                <a href="javascript:void(0);" onclick="filterByLetter('F')">F</a>
                <a href="javascript:void(0);" onclick="filterByLetter('G')">G</a>
                <a href="javascript:void(0);" onclick="filterByLetter('H')">H</a>
                <a href="javascript:void(0);" onclick="filterByLetter('I')">I</a>
                <a href="javascript:void(0);" onclick="filterByLetter('J')">J</a>
                <a href="javascript:void(0);" onclick="filterByLetter('K')">K</a>
                <a href="javascript:void(0);" onclick="filterByLetter('L')">L</a>
                <a href="javascript:void(0);" onclick="filterByLetter('M')">M</a>
                <a href="javascript:void(0);" onclick="filterByLetter('N')">N</a>
                <a href="javascript:void(0);" onclick="filterByLetter('O')">O</a>
                <a href="javascript:void(0);" onclick="filterByLetter('P')">P</a>
                <a href="javascript:void(0);" onclick="filterByLetter('Q')">Q</a>
                <a href="javascript:void(0);" onclick="filterByLetter('R')">R</a>
                <a href="javascript:void(0);" onclick="filterByLetter('S')">S</a>
                <a href="javascript:void(0);" onclick="filterByLetter('T')">T</a>
                <a href="javascript:void(0);" onclick="filterByLetter('U')">U</a>
                <a href="javascript:void(0);" onclick="filterByLetter('V')">V</a>
                <a href="javascript:void(0);" onclick="filterByLetter('W')">W</a>
                <a href="javascript:void(0);" onclick="filterByLetter('X')">X</a>
                <a href="javascript:void(0);" onclick="filterByLetter('Y')">Y</a>
                <a href="javascript:void(0);" onclick="filterByLetter('Z')">Z</a>
            </div>
        </footer>
    </div>

    <script>
        // Function to filter posts based on search input
        function filterPosts() {
            let searchQuery = document.getElementById("searchBar").value.toLowerCase();
            let posts = document.querySelectorAll(".card");
            
            posts.forEach(post => {
                let title = post.querySelector("h3").textContent.toLowerCase();
                let typeUser = post.getAttribute("data-typeuser").toLowerCase();
                let typePost = post.getAttribute("data-typepost").toLowerCase();
                let createDate = post.getAttribute("data-createdate").toLowerCase();

                if (title.includes(searchQuery) || typeUser.includes(searchQuery) || typePost.includes(searchQuery) || createDate.includes(searchQuery)) {
                    post.style.display = "block"; // Show post
                } else {
                    post.style.display = "none"; // Hide post
                }
            });
        }

        // Function to filter posts by the first letter of the title
        function filterByLetter(letter) {
            let posts = document.querySelectorAll(".card");
            
            posts.forEach(post => {
                let title = post.querySelector("h3").textContent.trim();
                let firstLetter = title.charAt(0).toUpperCase();
                
                if (firstLetter === letter) {
                    post.style.display = "block"; // Show post
                } else {
                    post.style.display = "none"; // Hide post
                }
            });
        }

       // Function to filter posts by typeUser (using select dropdown)
function filterByTypeUser() {
    let typeUser = document.getElementById("filterByTypeUser").value.toLowerCase();
    let posts = document.querySelectorAll(".card");
    
    posts.forEach(post => {
        let postTypeUser = post.getAttribute("data-typeuser").toLowerCase();
        
        if (typeUser === "" || postTypeUser.includes(typeUser)) {
            post.style.display = "block"; // Show post
        } else {
            post.style.display = "none"; // Hide post
        }
    });
}

// Function to filter posts by typePost (using select dropdown)
function filterByTypePost() {
    let typePost = document.getElementById("filterByTypePost").value.toLowerCase();
    let posts = document.querySelectorAll(".card");
    
    posts.forEach(post => {
        let postTypePost = post.getAttribute("data-typepost").toLowerCase();
        
        if (typePost === "" || postTypePost.includes(typePost)) {
            post.style.display = "block"; // Show post
        } else {
            post.style.display = "none"; // Hide post
        }
    });
}


        // Function to filter posts by date (Most recent first)
       // Function to filter posts by date (Most recent first or Oldest first)
// Function to filter posts by date (Most recent first or Oldest first)
function filterByDate() {
    let posts = Array.from(document.querySelectorAll(".card"));
    
    // Get the selected value from the dropdown
    let selectedOption = document.getElementById("filterByDate").value;
    
    // Sort posts based on the date
    if (selectedOption === "mostRecent") {
        posts.sort((a, b) => {
            let dateA = new Date(a.getAttribute("data-createdate"));
            let dateB = new Date(b.getAttribute("data-createdate"));
            return dateB - dateA; // Sort descending (most recent first)
        });
    } else if (selectedOption === "oldestFirst") {
        posts.sort((a, b) => {
            let dateA = new Date(a.getAttribute("data-createdate"));
            let dateB = new Date(b.getAttribute("data-createdate"));
            return dateA - dateB; // Sort ascending (oldest first)
        });
    }

    // Append sorted posts back to the DOM
    let postList = document.getElementById("postList");
    posts.forEach(post => {
        postList.appendChild(post); // Reorder the posts
    });
}


    </script>
<style>/* General Styling for Main Content */
.main-content {
    padding: 20px;
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.main-content h1 {
    color: #28a745;
    text-align: center;
    margin-bottom: 20px;
}

.main-content h2 {
    color: #2c3e50;
    margin-bottom: 15px;
}

/* Add Post Form Styling */
.add-post form {
    margin-bottom: 20px;
    text-align: right;
}

.add-post .add-comment-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.add-post .add-comment-btn:hover {
    background-color: #218838;
}

/* Cards for Posts */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card h3 {
    color: #2c3e50;
    margin-bottom: 10px;
}

.card p {
    color: #6c757d;
    margin: 5px 0;
}

/* Footer Section of Cards */
.card footer {
    border-top: 1px solid #ddd;
    margin-top: 15px;
    padding-top: 10px;
    color: #6c757d;
}

/* Actions Styling */
.actions {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

.actions a {
    text-decoration: none;
    padding: 5px 10px;
    color: white;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.actions .edit {
    background-color: #55a73f;

}

.actions .edit:hover {
    background-color: #e0a800;
}

.actions .delete {
    background-color: #55a73f;

}

.actions .delete:hover {
    background-color: #c82333;
}

/* Comments Section */
.comment {
    background-color: #f1f1f1;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
}

.comment p {
    margin: 5px 0;
}

.comment-actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.comment-actions a {
    font-size: 12px;
    padding: 5px 8px;
    text-decoration: none;
    color: white;
    border-radius: 3px;
}

.comment-actions .edit {
    background-color: #007bff;
}

.comment-actions .edit:hover {
    background-color: #0056b3;
}

.comment-actions .delete {
    background-color: #dc3545;
}

.comment-actions .delete:hover {
    background-color: #c82333;
}

/* Add Comment Form */
form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

form button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #218838;
}
/* Search and Filters Section */
.search-filters {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
    align-items: center;
    margin-bottom: 20px;
}

/* Search Bar Styling */
.search-filters input[type="text"] {
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
    width: 250px;
    max-width: 100%;
}

.search-filters input[type="text"]:focus {
    border-color: #007bff;
}

/* Sort and Filter Buttons */
.search-filters select, .search-filters button {
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
    background-color: #fff;
    cursor: pointer;
}

.search-filters select:focus, .search-filters button:focus {
    border-color: #007bff;
}

/* Hover effect for the buttons */
.search-filters button:hover, .search-filters select:hover {
    background-color: #f1f1f1;
}

/* Alphabetical Filter Section */
.alphabet-filter {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

/* Alphabet Buttons */
.alphabet-filter a {
    text-decoration: none;
    color: #007bff;
    font-size: 18px;
    font-weight: bold;
    padding: 5px 10px;
    border: 1px solid #007bff;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.alphabet-filter a:hover {
    background-color: #007bff;
    color: white;
}
</style>

    
    <!-- contact section end  (el header wel footer mayetmashoush)-->


    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">About</h2>
                    <p class="ipsum_text">Welcome to AgroXpert, your trusted hub for fresh, local produce, expert agricultural advice, and a thriving community of farmers and consumers. Our mission is to bridge the gap between farm and table, helping you make informed decisions
                        about the food you eat and the way it's grown.</p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">Services</h2>
                    <div class="footer_links">
                        <ul>
                            <li><a href="#">MarketPlace</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Weather Alerts</a></li>
                            <li class="active"><a href="#">Forum</a></li>
                            <li><a href="#">And more</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">Our Products</h2>
                    <div class="footer_links">
                        <ul>
                            <li><a href="#">Seasonal Produce</a></li>
                            <li><a href="#">Organic Foods</a></li>
                            <li><a href="#">Gardening Supplies</a></li>
                            <li><a href="#">Meal Kits</a></li>
                            <li><a href="#">And more</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">contact us</h2>
                    <div class="addres_link">
                        <ul>
                            <li>
                                <a href="#"><img src="images/map-icon.png"><span class="padding_left_10">Esprit ,El ghazela</span></a>
                            </li>
                            <li>
                                <a href="#"><img src="images/call-icon.png"><span class="padding_left_10">+216 52522736</span></a>
                            </li>
                            <li>
                                <a href="#"><img src="images/mail-icon.png"><span class="padding_left_10">AgroXpert@gmail.com</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">Copyright 2024 All Right Reserved By.<a href="https://html.design"> TeachTech</p>
         </div>
      </div>
      <!-- copyright section end -->    
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
        function example() {
  if (true) {
    console.log('Hello');
  } // Closing the 'if' block
} // Closing the function block

            
      </script>
       <script>
        // Function to handle toggle post details visibility and increment views
        function togglePostDetails(postId) {
            const postDetails = document.getElementById('post-details-' + postId);
            const viewCount = document.getElementById('view-count-' + postId);

            // Toggle visibility of the post details
            if (postDetails.style.display === "none") {
                postDetails.style.display = "block";

                // Increment the view count (you can also call the backend to update the view count in the database)
                fetch('incrementview.php?idpost=' + postId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            viewCount.innerText = data.newViewCount;
                        }
                    });
            } else {
                postDetails.style.display = "none";
            }
        }

        // Function to handle toggle comments visibility
        function toggleComments(postId) {
            const comments = document.getElementById('comments-' + postId);

            // Toggle visibility of comments
            if (comments.style.display === "none") {
                comments.style.display = "block";
            } else {
                comments.style.display = "none";
            }
        }
    </script>
      
   </body>
</html>