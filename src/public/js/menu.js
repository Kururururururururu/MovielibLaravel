document.addEventListener("DOMContentLoaded", function() {
    const searchbutton = document.getElementById("searchbutton");
    const search = document.getElementById("search");
    });

    searchbutton.addEventListener("click", function(event) {

      if (!isValidSearch(search.value)) {
        event.preventDefault();
        return;
      }
    
    function isValidSearch(search) {
        if (search === '') {
            alert('Search is required.');
            return false;
        }
        if ([A-Za-z0-9].test(search)) {
            alert('Search must only contain letters and numbers.');
            return false;
        }
        return true;
        }
});



