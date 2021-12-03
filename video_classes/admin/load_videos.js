window.onload = load_all_videos();

function load_all_videos () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("videos_div").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "load_videos.php", true);
    xhttp.send();
}

$(document).ready(function() {
  $("#search_input").keyup(function() {
      var user_input = $("#search_input").val();
      $.post("search_videos.php",
        {
            input: user_input
        }, 
        function(data) {
            if(user_input == '') {
                load_all_videos();
            } else {
                let json_data = JSON.parse(data);
                if(json_data == "") {
                    $("#videos_div").text("No Results Found");
                } else {
                    $("#videos_div").text("");
                    for (let i = 0; i < json_data.length; i++) {
                        let a = document.createElement("a");
                        a.className = "video";
                        $(a).attr("href","manage_video/index.php?b="+json_data[i]['TITLE']);
                        let div = document.createElement("div");
                        let title = "<p class='video_headings'>Title :</p><p class='video_text'>"+json_data[i]['TITLE']+"</p>";
                        let description = "<p class='video_headings'>Description :</p><p class='video_text'>"+json_data[i]['DESCRIPTION']+"</p>";
                        let course_code = "<p class='video_headings'>Title :</p><p class='video_text'>"+json_data[i]['COURSE_CODE']+"</p>";
                        let iframe = "<div class='iframe-container'><iframe frameborder='0' allowfullscreen src="+json_data[i]['URL']+"></iframe></div>";
                        $(div).append(title,description,course_code,iframe);
                        $(a).append(div);
                        $("#videos_div").append(a);
                    }
                }
            }
        })
  })
})