window.onload = load_all_books();

function load_all_books() {
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

$(document).ready(function() {
    $("#search_input").keyup(function() {
        var user_input = $("#search_input").val();
        $.post("search_books.php",
          {
              input: user_input
          }, 
          function(data) {
              if(user_input == '') {
                  load_all_books();
              } else {
                  let json_data = JSON.parse(data);
                  if(json_data == "") {
                      $("#books_div").text("No Results Found");
                  } else {
                      $("#books_div").text("");
                      for (let i = 0; i < json_data.length; i++) {
                          let div = document.createElement("div");
                          div.className = "book";
                          let title = "<p class='book_text'><span class='book_headings'>Title : </span>"+json_data[i]['TITLE']+"</p>";
                          let author = "<p class='book_text'><span class='book_headings'>Author : </span>"+json_data[i]['AUTHOR']+"</p>";
                          let country = "<p class='book_text'><span class='book_headings'>Country : </span>"+json_data[i]['COUNTRY']+"</p>";
                          let language = "<p class='book_text'><span class='book_headings'>Language : </span>"+json_data[i]['LANGUAGE']+"</p>";
                          let pages = "<p class='book_text'><span class='book_headings'>Pages : </span>"+json_data[i]['PAGES']+"</p>";
                          let year = "<p class='book_text'><span class='book_headings'>Year : </span>"+json_data[i]['YEAR']+"</p>";
                          let copies = "<p class='book_text'><span class='book_headings'>Copies : </span>"+json_data[i]['COPIES']+"</p>";
                          $(div).append(title,author,country,language,pages,year,copies);
                          $("#books_div").append(div);
                      }
                  }
              }
          })
    })
})