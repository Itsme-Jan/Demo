document.getElementById('searchForm').addEventListener('submit', function(e){
    e.preventDefault();
    const title = document.getElementById('searchTitle').value.toLowerCase();
    const priceRange = document.getElementById('searchPrice').value;

    // Redirect to properties.php with query params
    let url = 'properties.php?';
    if(title) url += 'title=' + encodeURIComponent(title) + '&';
    if(priceRange) url += 'price=' + encodeURIComponent(priceRange);
    window.location.href = url;
});
