function load() {
    let button = document.getElementById('bookButton');
    console.log('test');
    document.getElementById("book_edit").addEventListener("submit", function(e)
    {
        let author = document.getElementById('author').value;

        if (author) {
            $.ajax({
                url: "validate.php",
                type: "POST",
                data: "author=" + author,
                success: function(data) {
                    if (data === 1) {
                        e.preventDefault();
                        return false;
                    } else {
                        e.preventDefault();
                        return false;
                    }
                }
            });
        }
    }, false);
}

// The only event handler when page is loaded
document.addEventListener('DOMContentLoaded', load);