// script.js

var currentCategory = ''; // Variable to store the currently selected category ID

function toggleCategory(categoryId) {
    // Get all category sections
    var categories = document.querySelectorAll('.product-list');

    // Hide all category sections
    categories.forEach(function(category) {
        category.style.display = 'none';
    });

    // Show the selected category section
    var selectedCategory = document.getElementById(categoryId);
    if (selectedCategory) {
        selectedCategory.style.display = 'block';
        currentCategory = categoryId; // Update the current category
        
        // Get all color buttons in the selected category and reapply selection
        selectedCategory.querySelectorAll('.color-container .button').forEach(button => {
            var productId = button.getAttribute('data-product-id');
            var selectedColor = document.getElementById(`product_color_${productId}`).value;
            
            if (button.classList.contains(selectedColor)) {
                button.classList.add('selected');
            } else {
                button.classList.remove('selected');
            }
        });
    }
}

// Function to hide the previously selected category when clicking a new category
function hidePreviousCategory() {
    if (currentCategory !== '') {
        var previousCategory = document.getElementById(currentCategory);
        if (previousCategory) {
            previousCategory.style.display = 'none';
        }
    }
}

function selectColor(product_id, color) {
    // Check if any color is already selected for this product
    var selectedColor = document.getElementById(`product_color_${product_id}`).value;
    
    // If the selected color is different from the newly selected color, update the selection
    if (selectedColor !== color) {
        // Remove 'selected' class from all color buttons of the same product
        document.querySelectorAll(`.color-container [id^='${selectedColor}_button_${product_id}']`).forEach(button => {
            button.classList.remove('selected');
        });

        // Add 'selected' class to the clicked color button
        document.getElementById(`${color}_button_${product_id}`).classList.add('selected');

        // Update the hidden input field with the selected color
        document.getElementById(`product_color_${product_id}`).value = color;
    }
}