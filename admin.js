document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.parentElement.parentElement.firstElementChild.textContent;
            deleteStockItem(productId);
        });
    });
});

function deleteStockItem(product_id) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch('delete_product.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `product_id=${product_id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                console.error('Error deleting item:', data.error);
            }
        })
        .catch(error => {
            console.error('HTTP error:', error);
        });
    }
}