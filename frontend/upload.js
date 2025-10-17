document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("uploadForm");
    const progressBar = document.getElementById("progressBar");
    const statusText = document.getElementById("statusText");
    const countdown = document.getElementById("countdown");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const username = formData.get("username");
        const expireMinutes = formData.get("expire_minutes");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/apps/tempapp/api/uploadTempFile", true);

        xhr.upload.onprogress = (event) => {
            if (event.lengthComputable) {
                const percent = (event.loaded / event.total) * 100;
                progressBar.style.width = percent + "%";
                statusText.textContent = `Uploading: ${Math.round(percent)}%`;
            }
        };

        xhr.onload = () => {
            if (xhr.status === 200) {
                statusText.textContent = "Upload complete!";
                progressBar.style.width = "0%";

                // เริ่ม countdown
                startCountdown(expireMinutes);
            } else {
                statusText.textContent = "Upload failed: " + xhr.status;
            }
        };

        xhr.onerror = () => {
            statusText.textContent = "Upload error!";
        };

        xhr.send(formData);
    });

    function startCountdown(minutes) {
        let timeLeft = minutes * 60;
        countdown.textContent = formatTime(timeLeft);

        const interval = setInterval(() => {
            timeLeft--;
            countdown.textContent = formatTime(timeLeft);
            if (timeLeft <= 0) {
                countdown.textContent = "File expired!";
                clearInterval(interval);
            }
        }, 1000);
    }

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `File expires in ${mins}m ${secs}s`;
    }
});
