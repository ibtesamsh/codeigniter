# codeigniter
<p>
     //     public function upload()
    // {
    //     $file = $this->request->getFile('csv_file');
    //     $invalidRows = []; // Array to store invalid rows

    //     // Check if file is uploaded
    //     if ($file->isValid() && !$file->hasMoved()) {
    //         $filePath = $file->getTempName();
    //         $invalidRows = $this->processCSV($filePath); // Pass to processCSV and get invalid rows
    //     } else {
    //         return redirect()->to('/user-upload')->with('error', 'File upload failed.');
    //     }

    //     // After processing, if there are any invalid rows, create a CSV for them
    //     if (!empty($invalidRows)) {
    //         // Generate and download CSV for invalid rows
    //         return $this->generateInvalidCSV($invalidRows); // Create CSV and trigger download
    //     } else {
    //         return redirect()->to('/dashboard')->with('success', 'Users successfully registered and synced with MongoDB.');
    //     }
    // }
    //--------------------------------------------------
   // private function processCSV($filePath)
// {
//     $csvFile = fopen($filePath, 'r');
//     $userModel = new UserModel();
//     $invalidRows = []; // Array to store invalid rows
//     $validUserData = []; // Array to collect valid users for batch insert

//     // Skip the header row if there is one
//     $header = fgetcsv($csvFile);

//     // Read each row from CSV
//     while (($row = fgetcsv($csvFile)) !== false) {

//         $username = $row[0];
//         $email = $row[1];
//         $password = $row[2];

//         // If any required field is empty, mark this row as invalid
//         if (empty($username) || empty($email) || empty($password)) {
//             $invalidRows[] = $row; // Add the whole row to invalid rows
//             continue; // Skip processing this row for database insertion
//         }

//         // Hash the password before storing
//         $passwordHash = password_hash($password, PASSWORD_BCRYPT);

//         // Prepare data for insertion into MySQL
//         $userData = [
//             'username' => $username,
//             'email' => $email,
//             'password' => $passwordHash,
//         ];

//         // Check if the user already exists in MySQL based on email
//         $existingUser = $userModel->where('email', $email)->first();

//         if ($existingUser) {
//             log_message('info', 'User already exists in MySQL: ' . $email);
//         } else {
//             // Add to valid user data array for batch insert
//             $validUserData[] = $userData;
//         }

//         // Now, also sync with MongoDB (same as before)
//         $this->syncMongoDB($userData);
//     }

//     // If there are valid users, insert them in batch
//     if (!empty($validUserData)) {
//         $userModel->insertBatch($validUserData); // Perform batch insert
//     }

//     fclose($csvFile);
//     return $invalidRows; // Return invalid rows to be processed later
// }
    //------------------------------------



    //------------------------------
    // private function syncMongoDB($userData)
    // {
    //     $client = new Client(); // Guzzle client

    //     try {
    //         $response = $client->post('http://localhost:3000/register', [
    //             'json' => [
                    
    //                 'name' => $userData['username'],
    //                 'email' => $userData['email'],
    //                 'password' => $userData['password']
    //             ]
    //         ]);

    //         // Check response from the Node.js API
    //         if ($response->getStatusCode() == 200) {
    //             // Success in syncing with MongoDB
    //             log_message('info', 'User successfully synchronized with MongoDB.');
    //         } else {
    //             // Handle error
    //             log_message('error', 'Failed to sync with MongoDB.');
    //         }
    //     } catch (\Exception $e) {
    //         // Handle exception (e.g., Node.js server is down)
    //         log_message('error', 'Error syncing with MongoDB: ' . $e->getMessage());
    //     }
    // }
    //-----------------------------
</p>