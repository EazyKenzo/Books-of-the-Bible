function display(data) {
    console.log(data['message']);
    let message = document.getElementById("message");

    let books = data['books'];
    let ul = document.getElementById("booksList");
    ul.innerHTML = '';

    for (let book of books) {
        let newLi = document.createElement('li');
        let newA = document.createElement('a');

        newA.innerHTML = book['Name'];
        newA.setAttribute("href", "book.php?id=" + book['Id']);

        newLi.appendChild(newA);
        ul.appendChild(newLi);
    }

    message.innerHTML = data['message'];
    message.style.display = "block";
}

function fetch_books() {
    let filter = document.getElementById("filter").value;

    if (filter === "author" || filter === "name") {
        let search = document.getElementById("name").value;

        fetch('fetch.php?filter=' + filter + '&search=' + search)
            .then(function(result) {
                return result.json();
            })
            .then(function(retrieved) {
                display(retrieved);
            });
    }
    else if (filter === "date") {
        let from = document.getElementById("from").value;
        let to = document.getElementById("to").value;
        let fromBA = document.getElementById("fromBA").value;
        let toBA = document.getElementById("toBA").value;

        from = fromBA == 0 ? from * -1 : from;
        to = toBA == 0 ? to * -1 : to;

        fetch('fetch.php?filter=' + filter + '&from=' + from + '&to=' + to)
            .then(function(result) {
                return result.json();
            })
            .then(function(retrieved) {
                display(retrieved);
            });
    }
    else {
        let testament = document.getElementById("testament").value;

        fetch('fetch.php?filter=' + filter + '&testament=' + testament)
            .then(function(result) {
                return result.json();
            })
            .then(function(retrieved) {
                display(retrieved);
            });
    }
}

function show() {
    hide();

    let filter = document.getElementById("filter").value;

    if (filter == "author") {
        document.getElementById("FGName").style.display = "flex";
    }
    else if (filter == "date") {
        document.getElementById("FGDate").style.display = "block";
    }
    else if (filter == "name") {
        document.getElementById("FGName").style.display = "flex";
    }
    else {
        document.getElementById("FGTestament").style.display = "block";
    }

    document.getElementById("search").style.display = "block";
}

function hide() {
    document.getElementById("FGTestament").style.display = "none";
    document.getElementById("FGDate").style.display = "none";
    document.getElementById("FGName").style.display = "none";
}

function load() {
    hide();
    document.getElementById("search").style.display = "none";
    document.getElementById("message").style.display = "none";

    document.getElementById("filter").addEventListener("change", show);
    document.getElementById("search").addEventListener("click", fetch_books);
}

document.addEventListener('DOMContentLoaded', load);