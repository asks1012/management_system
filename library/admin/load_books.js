window.onload = function () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("books_div").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "load_books.php", true);
    xhttp.send();
}