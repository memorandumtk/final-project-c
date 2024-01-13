<?php
function findISBN($data)
{
    if (is_array($data) || is_object($data)) {
        foreach ($data as $key => $value) {
            if ($key === 'industryIdentifiers' && is_array($value)) {
                foreach ($value as $identifier) {
                    if (isset($identifier['type']) && $identifier['type'] === 'ISBN_13') {
                        return $identifier['identifier'];
                    }
                }
            } else {
                $result = findISBN($value);
                if ($result) {  // Check if the recursive call found an ISBN
                    return $result;
                }
            }
        }
    }
    return null; // Return null if no ISBN is found
}

$query = 'PHP';
$url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query);
$response = file_get_contents($url);
if ($response !== false) {
    $data = json_decode($response, true);
    $json = $data['items'];
    for ($i = 0; $i < count($json); $i++) {
        $returnValue = findISBN($json[$i]);
        echo $returnValue;
        echo "\n";
    }
} else {
    echo 'failed to fetch.';
}

// function findISBN($data)
// {

//     if (is_array($data) || is_object($data)) {
//         foreach ($data as $key => $value) {
//             if ($key === 'industryIdentifiers' && is_array($value)) {
//                 foreach ($value as $identifier) {
//                     if (isset($identifier["type"]) && $identifier["type"] === 'ISBN_13') {
//                         return $identifier["identifier"];
//                         break;
//                     }
//                 }
//             } else {
//                 findISBN($value);
//             }
//         }
//     }
// }
