// Filtrer les produits par catégorie
function filterByCategory() {
    const selectedCategory = document.getElementById("category-filter").value;
    const productCards = document.querySelectorAll(".product-card");

    productCards.forEach(card => {
        const productCategory = card.getAttribute("data-category");
        if (selectedCategory === "all" || productCategory === selectedCategory) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

// Trier les produits par critère (price, rating, discount)
function sortProducts(criteria) {
    const products = Array.from(document.querySelectorAll('.product-card'));
    const container = document.querySelector('.marketplace');

    // Trier les produits en fonction du critère choisi
    products.sort((a, b) => {
        const aValue = parseFloat(a.querySelector(`.${criteria}`).innerText.match(/[\d.]+/)[0]);
        const bValue = parseFloat(b.querySelector(`.${criteria}`).innerText.match(/[\d.]+/)[0]);
        return bValue - aValue; // Tri décroissant
    });

    // Réorganiser les produits dans le DOM
    container.innerHTML = '';
    products.forEach(product => container.appendChild(product));
}
