document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#uploadForm");
    const progressBar = document.querySelector("#progressBar");
    const statusText = document.querySelector("#statusText");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.open("POST", form.action, true);

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percent = (e.loaded / e.total) * 100;
                progressBar.style.width = percent + "%";
                statusText.textContent = `Uploading: ${Math.round(percent)}%`;
            }
        };

        xhr.onload = function () {
            if (xhr.status === 200) {
                statusText.textContent = "Upload complete!";
                progressBar.style.width = "0%";
                // Optional: start countdown for file expiration
                const expireMinutes = formData.get("expire_minutes");
                startCountdown(expireMinutes);
            } else {
                statusText.textContent = "Upload failed: " + xhr.status;
            }
        };

        xhr.send(formData);
    });

    function startCountdown(minutes) {
        let timeLeft = minutes * 60;
        const countdown = document.querySelector("#countdown");
        const interval = setInterval(() => {
            const mins = Math.floor(timeLeft / 60);
            const secs = timeLeft % 60;
            countdown.textContent = `File expires in ${mins}m ${secs}s`;
            timeLeft--;
            if (timeLeft < 0) clearInterval(interval);
        }, 1000);
    }
});
