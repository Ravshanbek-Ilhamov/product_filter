<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send File</title>
</head>

<body>
    <h1>Send File to Telegram Bot</h1>
    <form action="{{ route('send') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="message">Message:</label>
            <input type="text" id="message" name="message" required>
        </div>
        <div>
            <label for="file">File (Image/Video):</label>
            <input type="file" id="file" name="file" accept="image/*,video/*,audio/*,application/pdf,text/plain,file/*" required>
        </div>
        <button type="submit">Send to Bot</button>
    </form>
</body>

</html>