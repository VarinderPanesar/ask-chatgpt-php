<?php
// Set your OpenAI API key
$apiKey = "";

// Define the context and question
$context = "Last night, I watched a documentary about space exploration. It was fascinating to learn about the history of space travel and the challenges that astronauts face.";
$question = "What are some of the most significant milestones in the history of space exploration?";

// Prepare the data for the API request
$data = array(
    "model" => "text-davinci-002",
    "prompt" => $context . " " . $question,
    "max_tokens" => 50, // You can adjust the number of tokens as needed
);

// Convert the data to JSON
$data = json_encode($data);

// Set up the cURL request
$ch = curl_init("https://api.openai.com/v1/engines/text-davinci-002/completions");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json",
));

// Make the API request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Decode the response
    $response = json_decode($response, true);

    if (isset($response['choices'][0]['text'])) {
        $answer = $response['choices'][0]['text'];
        echo "Response: " . $answer;
    } else {
        echo "Error: No valid response from the model.";
    }
}

// Close the cURL request
curl_close($ch);
?>
