# codeigniter
<p>
    // private function processCSV($filePath)
    // {
    //     $csvFile = fopen($filePath, 'r');
    //     $userModel = new UserModel();
    //     $invalidRows = []; 
    
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
    //             $userModel->save($userData);
    //         }
    
    //         // Now, also sync with MongoDB
    //         $this->syncMongoDB($userData);
    //     }
    
    //     fclose($csvFile);
    //     return $invalidRows; // Return invalid rows to be processed later
    // }
</p>