<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@damon</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
      body {
        background-color: black;
        color: white;
        font-family: Arial, sans-serif;
      }
      .neon-text {
        font-size: 2em;
        color: #fff;
        text-shadow: 0 0 5px #0fa, 0 0 10px #0fa, 0 0 20px #0fa, 0 0 40px #0fa, 0 0 80px #0fa, 0 0 90px #0fa, 0 0 100px #0fa, 0 0 150px #0fa;
      }
      .neon-icons i,
      .neon-icons img {
        color: #0fa;
        text-shadow: 0 0 5px #0fa, 0 0 10px #0fa, 0 0 20px #0fa, 0 0 40px #0fa;
      }
      .overlay,
      .content {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 1s;
      }
      .overlay {
        background-color: black;
        color: white;
        font-size: 5em;
        z-index: 1000;
        opacity: 1;
      }
      .fade-out {
        opacity: 0;
        pointer-events: none;
      }
      .content {
        display: none;
        flex-direction: column;
        align-items: center;
        color: white;
        z-index: 500;
      }
      .profile-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
      }
      .profile-info img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
      }
      .social-icons {
        display: flex;
        gap: 20px;
      }
      .social-icons a {
        font-size: 2em;
      }
    </style>
  </head>
  <body>
    <div id="overlay" class="overlay">CLICK TO CONTINUE</div>
    <div id="content" class="content">
      <div class="profile-info">
        <img src="https://cdn.discordapp.com/avatars/127171956138049536/e3a5c4b0524a60d353442b11b95a0673.png?size=1024" alt="User Avatar" />
        <h1 class="neon-text" id="dynamic-title"></h1>
        <div class="user-stats">
          <span id="view-count"><i class="fas fa-eye neon-icons"></i> Loading views...</span> | <span>Joined 3 months ago</span>
        </div>
      </div>
      <div class="social-icons neon-icons">
        <a href="https://discord.com/.540hz" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="https://youtube.com/channel/UCTExaJhoWqmUN6V-H5YWZmA" target="_blank"><i class="fab fa-youtube"></i></a>
        <a href="https://open.spotify.com/user/dachlerbruno?si=bb6887a1b7ec45de" target="_blank"><i class="fab fa-spotify"></i></a>
        <a href="https://snapchat.com/add/joouskaa" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://twitch.tv/iwokedup" target="_blank"><i class="fab fa-twitch"></i></a>
        <a href="https://x.com/Q3VYT" target="_blank"><i class="fab fa-x-twitter"></i></a>
      </div>
    </div>
    <video id="background-video" loop autoplay muted>
      <source src="https://images.damon.lol/videos/bg.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <script>
      document.addEventListener("click", function () {
        var video = document.getElementById("background-video");
        var overlay = document.getElementById("overlay");
        var content = document.getElementById("content");

        video.muted = false;
        overlay.classList.add("fade-out");
        content.style.display = "flex";

        anime({
          targets: content,
          opacity: [0, 1],
          duration: 1000,
          easing: "easeOutQuad",
          complete: function () {
            overlay.style.display = "none";
          },
        });
      });

      fetch("update_views.php")
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.json();
        })
        .then((data) => {
          if (data.error) {
            throw new Error(data.error);
          }
          if (data.views !== undefined) {
            document.getElementById("view-count").innerHTML = `<i class="fas fa-eye neon-icons"></i> ${data.views} views`;
          } else {
            console.error("Views data not found");
            document.getElementById("view-count").textContent = "Unable to load views";
          }
        })
        .catch((error) => {
          console.error("Error fetching view count:", error);
          document.getElementById("view-count").textContent = "Unable to load views";
        });

      var titleElement = document.getElementById("dynamic-title");
      var fullText = "@ d a m o n";
      var index = 0;
      var adding = true;

      function animateTitle() {
        if (adding) {
          if (index < fullText.length) {
            titleElement.textContent += fullText.charAt(index);
            document.title = titleElement.textContent;
            index++;
          } else {
            adding = false;
          }
        } else {
          if (index > 0) {
            titleElement.textContent = titleElement.textContent.slice(0, -1);
            document.title = titleElement.textContent;
            index--;
          } else {
            adding = true;
          }
        }
        setTimeout(animateTitle, 200);
      }

      animateTitle();
    </script>
  </body>
</html>
