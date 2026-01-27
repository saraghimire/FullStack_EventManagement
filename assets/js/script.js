document.getElementById('searchInput').addEventListener('keyup', function() {
    let query = this.value;

    // Use Fetch API to get data without refreshing
    fetch('ajax_search.php?q=' + encodeURIComponent(query))
        .then(response => response.text())
        .then(data => {
            document.getElementById('eventList').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
});