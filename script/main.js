//Show error message for 3 seconds. This has to be handled by the browser 
setTimeout(function() {
    var row = document.getElementById("errorRow");
    if (row) {
        row.style.display = "none";
    }
}, 3000);