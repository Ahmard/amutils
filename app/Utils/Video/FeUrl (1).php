<html>
<head>
    <title>Feurl Sample</title>
</head>
<body>
    <fieldset>
        <legend>Extract link</legend>
        <form method="get" action="">
            <input name="u" placeholder="Enter page url :)" />
            <button type="submit">Get link</button>
        </form>
    </fieldset>
    <?php
    use GuzzleHttp\Client;

    $url = $_GET['u'] ?? null;
    if (isset($_GET['u'])) {
        require('vendor/autoload.php');

        $expUrl = explode('/', $url);
        $url = 'https://feurl.com/api/source/'.end($expUrl);

        $client = new Client();
        $request = $client->request('POST', $url);
        $jsonResponse = $request->getBody();
        $objectResponse = json_decode($jsonResponse);

        $videoDatas = $objectResponse->data;

        foreach ($videoDatas as $video) {
            echo "
            <fieldset>
                <legend>Lin Extracted</legend>
                <ul>
                    <li>Type: {$video->type}</li>
                    <li>Format: {$video->label}</li>
                    <li>File: <a href=\"{$video->file}\">Download</a></li>
                </ul>
            </fieldset>
            ";
        }
    }
    ?>
</body>
</html>