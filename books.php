<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Project</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/Article-Clean.css">
        <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
        <link rel="stylesheet" href="assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body style="background-color: rgb(56,66,67);color: #ffffff;font-family: Amaranth, sans-serif;">
        <?php require 'header.php' ?>
        <div>
            <div class="container">
                <h1 class="text-center" style="height: 151px;">Books of the Bible</h1>
                <div class="row" style="margin: 15px 0px;">
                    <div class="col-md-12" style="padding: 0px;">
                        <form class="border rounded-0" style="padding: 10px;">
                            <div class="form-group d-flex d-xl-flex align-items-center align-items-sm-center align-items-lg-center align-items-xl-center" style="margin: 15px 0px;">
                                <select class="form-control" id="filter" style="width: 129px;padding: 6px 0px;">
                                    <option value="" selected="" id="test" hidden="" disabled="" color="#ba2575">Search/Filter</option>
                                    <option value="author">Author</option>
                                    <option value="date">Date</option>
                                    <option value="name">Name</option>
                                    <option value="testament">Testament</option>
                                </select>
                            </div>
                            <div class="form-group" id="FGTestament">
                                <select class="form-control" id="testament" style="width: 129px;padding: 6px 0px;">
                                    <option value="0" selected="">Old Testament</option>
                                    <option value="1">New Testament</option>
                                </select>
                            </div>
                            <div class="form-group" id="FGName" style="height: 30px;">
                                <label class="d-xl-flex align-items-xl-center" style="margin-bottom: 0px;width: 43px;">Name:&nbsp;</label>
                                <input class="form-control" type="text" id="name" style="width: 200px;height: 100%;margin: 0px 10px;" required="">
                            </div>
                            <div id="FGDate">
                                <div class="form-group d-flex">
                                    <label class="d-xl-flex align-items-xl-center" style="margin-bottom: 0px;width: 43px;">From:&nbsp;</label>
                                    <input class="form-control" type="number" id="from" style="margin: 0px 10px;width: 100px;height: 100%;" required="" max="4000">
                                    <select class="form-control" id="fromBA" style="height: 100%;margin: 0px 10px;width: 74px;">
                                        <option value="0">B.C.</option>
                                        <option value="1">A.D.</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex">
                                    <label class="d-xl-flex align-items-xl-center" style="margin-bottom: 0px;width: 43px;">To:&nbsp;</label>
                                    <input class="form-control" type="number" id="to" style="margin: 0px 10px;width: 100px;height: 100%;" required="" max="4000">
                                    <select class="form-control" id="toBA" style="height: 100%;margin: 0px 10px;width: 74px;">
                                        <option value="0">B.C.</option>
                                        <option value="1">A.D.</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-secondary" id="search" type="button" style="background-color: rgba(220,53,69,0.83);width: 93px;margin: 0px 15px;">SEARCH</button>
                        </form>
                        <h2 id="message">Message</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <ul id="booksList" class="list">

                            </ul>
                        </div>
                    </div>
                    <?php if ($_SESSION['admin']): ?>
                        <div class="col">
                            <a href="edit_book.php" style="font-size: 20px;">Add a new book</a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <?php require 'footer.php' ?>
        <script src="Javascript/books.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>