<?php
require_once('authCheck.php');

$pageTitle = "Search";
include('../assets/includes/header.php');
?>

<div class="content-box">
    <h2>Search AgriSmart</h2>
    
    <div class="search-box">
        <input type="text" id="globalSearch" placeholder="Search products, tips, questions..." style="width: 100%; padding: 15px; font-size: 1.1em;">
    </div>
</div>

<div class="content-box" id="searchResults">
    <p>Start typing to search across products, tips, and Q&A...</p>
</div>

<script>
// Simple global search (you can expand this)
document.getElementById('globalSearch').addEventListener('keyup', function() {
    let query = this.value;
    if(query.length < 2) {
        document.getElementById('searchResults').innerHTML = '<p>Start typing to search...</p>';
        return;
    }
    
    // You can implement AJAX search here
    document.getElementById('searchResults').innerHTML = '<p>Searching for: <strong>' + query + '</strong>...</p>';
});
</script>

<?php include('../assets/includes/footer.php'); ?>
