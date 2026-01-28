const search = document.getElementById('searchInput');
if (search) {
    search.addEventListener('keyup', function() {
        fetch('ajax_search.php?q=' + encodeURIComponent(this.value))
            .then(r => r.text())
            .then(data => document.getElementById('eventList').innerHTML = data);
    });
}