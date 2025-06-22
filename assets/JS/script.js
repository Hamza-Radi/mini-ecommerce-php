document.addEventListener('DOMContentLoaded', function() {
    // Gestion des boutons "Ajouter au panier"
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            let quantity = 1;
            
            // Si on est sur la page produit, prendre la quantité saisie
            const quantityInput = document.getElementById('quantity');
            if(quantityInput) {
                quantity = parseInt(quantityInput.value);
            }
            
            // Envoyer la requête
            fetch(`cart.php?action=add&id=${productId}&quantity=${quantity}`, {
                method: 'GET'
            })
            .then(response => {
                if(response.ok) {
                    alert('Produit ajouté au panier');
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});
document.querySelectorAll('.notify-me').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        // Ici vous pourriez faire une requête AJAX ou afficher un formulaire
        alert('Nous vous préviendrons lorsque ce produit sera disponible !');
        // Optionnel: Enregistrer dans localStorage
        localStorage.setItem(`notify_${productId}`, 'true');
    });
});