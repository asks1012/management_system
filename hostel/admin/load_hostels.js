window.onload = load_all_hostels();

function load_all_hostels () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("hostels_div").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "load_hostels.php", true);
    xhttp.send();
}

$(document).ready(function() {
  $("#search_input").keyup(function() {
      var user_input = $("#search_input").val();
      $.post("search_hostels.php",
        {
            input: user_input
        }, 
        function(data) {
            if(user_input == '') {
                load_all_hostels();
            } else {
                let json_data = JSON.parse(data);
                if(json_data == "") {
                    $("#hostels_div").text("No Results Found");
                } else {
                    $("#hostels_div").text("");
                    for (let i = 0; i < json_data.length; i++) {
                        let a = document.createElement("a");
                        a.className = "hostel";
                        $(a).attr("href","manage_hostel/index.php?b="+json_data[i]['NAME']);
                        let div = document.createElement("div");
                        let name = "<h3>"+json_data[i]['NAME']+"</h3>";
                        let total_rooms = "<p class='hostel_text'><span class='hostel_headings'>No. of Rooms : </span>"+json_data[i]['TOTAL_ROOMS']+"</p>";
                        let total_free_rooms = "<p class='hostel_text'><span class='hostel_headings'>Rooms Free : </span>"+json_data[i]['FREE_ROOMS']+"</p>";
                        $(div).append(name,total_rooms,total_free_rooms);
                        $(a).append(div);
                        $("#hostels_div").append(a);
                    }
                }
            }
        })
  })
})