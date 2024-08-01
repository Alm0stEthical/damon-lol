document.addEventListener("click", function () {
    var video = document.getElementById("background-video");
    var overlay = document.getElementById("overlay");
    var content = document.getElementById("content");

    video.muted = false;
    overlay.classList.add("fade-out");
    content.style.display = "flex";

    gsap.to(".semi-transparent-container", { opacity: 1, duration: 1 });
});

function animateTitle() {
    gsap.to("#dynamic-title", {
        x: "-100%",
        duration: 15,
        repeat: -1,
        ease: "none",
    });
}

animateTitle();

function animateName() {
    const element = document.getElementById("moving-name");
    const fullText = "damon";
    const interval = 300;

    let index = 0;
    let adding = true;

    setInterval(() => {
        if (adding) {
            element.textContent = "@" + fullText.slice(0, index + 1);
            index++;
            if (index === fullText.length) adding = false;
        } else {
            element.textContent = "@" + fullText.slice(0, index);
            index--;
            if (index === 0) adding = true;
        }
    }, interval);
}

animateName();