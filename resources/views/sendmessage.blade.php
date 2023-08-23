<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>tg_bot</title>
</head>

<body>

    <input type="text" placeholder="message" id="textInput">
    <button onclick="send()"> send </button>

    <script>
        async function send() {
            const res = await fetch('/api/sendmessage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    text: document.getElementById('textInput').value
                })
            })

            const data = await res.text()

            alert(data)
        }
    </script>
</body>

</html>