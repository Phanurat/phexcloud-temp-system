<div class="upload-container">
    <form id="uploadForm" action="/apps/tempapp/api/uploadTempFile" method="post" enctype="multipart/form-data">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Expire (minutes):</label>
        <input type="number" name="expire_minutes" value="60" required>

        <label>File:</label>
        <input type="file" name="file" required>

        <input type="submit" value="Upload Temp File">
        <p class="info">Maximum file size: 1GB. Default file expiration: 1 hour.</p>
    </form>
    <div id="progressWrapper">
        <div id="progressBar" style="width:0%; height:8px; background:#0078d4; margin-top:10px;"></div>
        <p id="statusText"></p>
        <p id="countdown"></p>
    </div>
</div>

<!-- Include JS -->
<script src="/apps/tempapp/js/upload.js"></script>
<link rel="stylesheet" href="/apps/tempapp/css/styles.css">
