function load() {
    document.getElementById("error").style.display = "none";

    document.getElementById("book_edit").addEventListener("submit", function(e)
    {
        let authorValue = document.getElementById('author').value;

        var result = function () {
            var tmp = null;
            $.ajax({
                async: false,
                url: 'validate.php',
                data: {author: authorValue},
                type: 'post',
                success: function (data) {
                    tmp = data;
                }
            });
            return tmp;
        }();

        if (result === '2') {
            document.getElementById("author").style.border = "solid #cf3838";
            document.getElementById("error").style.display = "block";

            e.preventDefault();
            return false;
        }
    }, false);
}

document.addEventListener('DOMContentLoaded', load);