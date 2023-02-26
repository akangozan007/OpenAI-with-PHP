<!-- header -->
<?php include "header.php"; ?>

<!-- ./header -->

<!--body -->
<main class="px-3 h-100 py-5">
    <div class="card bg-transparent" style="width:100%;">
        <img src="img/robot.png" class="card-img-top w-25 mx-auto" alt="...">
        <div class="card-body bg-none">
            <h5 class="card-title">Ketikan apapun dibawah</h5>
            <p class="card-text lead">
                <code>
                    Tools ini saya buat, untuk mempelajari API Request dengan JSON dan PHP menggunakan layanan Open Source ChatGPT OpenAI kecerdasan buatan.
                </code>
            </p>
            <a href="https://wa.me/+62895356100304" class="btn btn-transparent"><ion-icon class="display-3 text-success" name="logo-whatsapp" alt="via wa"></ion-icon></a>
        </div>
    </div>
    <!-- post data -->
    <form action="index.php" method="post">
        <div class="form-floating">
            <textarea name="tanya" class="form-control bg-dark text-primary" placeholder="Silahkan Chat disini.." id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Silahkan Chat Disini</label>
        </div>
        <div class="container mt-5 form-floating">
            <p class="lead">
                <button type="submit" class="btn btn-lg btn-outline-info fw-bold border-info text-light">Kirim</button>
            </p>
        </div>
    </form>
    <?php
    // Set the API endpoint URL and API key
    $api_url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    $api_key = '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';

    // Get the message from the form data
    $message = $_POST['tanya'];

    // Create the request data
    $data = array(
        'prompt' => 'Q: ' . $message . '\nA:',
        'temperature' => 0.7,
        'max_tokens' => 150,
        'stop' => '\n'
    );

    // Create the cURL request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ));

    // Send the request and get the response
    $response = curl_exec($ch);
    curl_close($ch);

    // Parse the response JSON and get the completed text
    $response_data = json_decode($response, true);
    $completed_text = $response_data['choices'][0]['text'];

    // Output the completed text as a chat message
    if (!empty($response)) {
        $syntax1 = '<div class="form-floating py-0"><div class="form-control bg-dark text-primary py-5 my-auto" placeholder="Silahkan Chat disini.." id="floatingTextarea2" style="height: 100px"><p>';
        $syntax2 = '</p><p>ChatGPT:';
        $syntax3 = '</p></div><label for="floatingTextarea2">Disini Respon API Berada</label></div>';
        echo $syntax1 . htmlspecialchars($message) . $syntax2 . htmlspecialchars($completed_text) . $syntax3;
        //' . htmlspecialchars($message) . ' 
        // ' . htmlspecialchars($completed_text) .

    }

    ?>
</main>
<!-- ./body -->


<?php
include "footer.php";
?>