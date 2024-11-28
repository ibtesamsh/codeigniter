<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
      <!-- Flash messages -->
      <?php if(session()->getFlashdata('error')): ?>
    <div class="text-red-500 mb-4 p-2 bg-red-100 border border-red-400 rounded relative">
        <button onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 p-2 text-red-700 hover:text-red-900 bg-transparent border-none">
            ×
        </button>
        <?php echo session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="text-green-500 mb-4 p-2 bg-green-100 border border-green-400 rounded relative">
        <button onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 p-2 text-green-700 hover:text-green-900 bg-transparent border-none">
            ×
        </button>
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>


    <!-- Main Container -->
    <div class="max-w-screen-lg mx-auto p-6">

        <!-- Dashboard Header -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>
            <h2 class="text-2xl text-gray-600 mt-2">Registered Users</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-sm font-medium uppercase">ID</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">mongoId</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Username</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Email</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">
                            Actions
                            <!-- Filter Input with more space -->

                            <input
                                type="text"
                                id="filterInput"
                                placeholder="Search"
                                class="ml-8 px-2 py-1 border rounded-md text-sm text-black" />

                        </th>
                    </tr>
                </thead>
                <div class="flex justify-end">
                    <button id="downloadCsvButton" class="ml-4 py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Download CSV
                    </button>
                    <button class="ml-4 py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"><a href="/user-upload">upload</a></button>
                </div>


                <tbody class="text-gray-700" id="userTableBody">
                    <!-- Loop through users and display their data -->
                    <?php foreach ($users as $user)
                    // echo '<pre>'; 
                    // print_r($users); die;
                    // echo '</pre>';
                    { ?>

                        <tr class="border-t border-gray-200">
                            <td class="px-6 py-4 text-sm"><?php echo $user->id; ?></td>
                            <td class="px-6 py-4 text-sm"><?php echo isset($user->mongoId) ? $user->mongoId : 'N/A'; ?></td>

                            <td class="px-6 py-4 text-sm"><?php echo $user->username; ?></td>
                            <td class="px-6 py-4 text-sm"><?php echo $user->email; ?></td>
                            <td class="px-6 py-4 text-sm flex justify-start space-x-2">
                                <!-- Edit Button -->
                                <button onclick="openEditModal(<?php echo $user->id; ?>, '<?php echo $user->username; ?>', '<?php echo $user->email; ?>', '<?php echo $user->mongoId; ?>')" class="inline-block py-2 px-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    Edit
                                </button>
                                <!-- Delete Button -->
                                <button onclick="confirmDelete('<?php echo $user->id; ?>' ,'<?php echo $user->mongoId; ?>')" class="inline-block py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Logout Button -->
        <div class="mt-6 text-center">
            <a href="/logout" class="inline-block py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Logout</a>
        </div>

    </div>

    <!-- Edit User Modal -->
    <!-- Edit User Modal -->
    <div id="editModal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Edit User Details</h3>
            <form id="editForm">
                <div class="mb-4">
                    <label for="editUserId" class="block text-sm font-medium text-gray-700">userId</label>
                    <input type="text" id="editUserId" class="mt-1 block w-full px-4 py-2 border rounded-md" disabled>
                </div>
                <input type="text" id="editMongoId" hidden disabled> <!-- The mongoId is passed but hidden -->
                <div class="mb-4">
                    <label for="editUsername" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="editUsername" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="editEmail" class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="closeEditModal()" class="py-2 px-4 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>
                    <button type="submit" class="py-2 px-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    
    <div class="flex justify-center mt-6">
    <nav class="flex flex-col items-center" aria-label="Pagination">
    <!-- Page Numbers -->
    <div class="inline-flex mb-4">
        <?php if ($current_page > 1): ?>
            <a href="?page=1" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md hover:bg-gray-300">First</a>
            <a href="?page=<?php echo $current_page - 1; ?>" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 hover:bg-gray-300">Previous</a>
        <?php else: ?>
            <span class="px-4 py-2 bg-gray-200 text-gray-500 border border-gray-300 rounded-l-md">First</span>
            <span class="px-4 py-2 bg-gray-200 text-gray-500 border border-gray-300">Previous</span>
        <?php endif; ?>

        <!-- Display Page Numbers with Ellipsis Handling -->
        <?php
        $page_range = 2; // Display this many pages before and after the current page
        $start_page = max(1, $current_page - $page_range);
        $end_page = min($total_pages, $current_page + $page_range);

        // Show first page and ellipses if necessary
        if ($start_page > 1) {
            echo '<a href="?page=1" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 hover:bg-blue-500 hover:text-white">1</a>';
            if ($start_page > 2) {
                echo '<span class="px-4 py-2 bg-gray-200 text-gray-500 border border-gray-300">...</span>';
            }
        }

        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<a href="?page=' . $i . '" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 hover:bg-blue-500 hover:text-white ' . ($i == $current_page ? 'bg-blue-500 text-white' : '') . '">' . $i . '</a>';
        }

        // Show last page and ellipses if necessary
        if ($end_page < $total_pages) {
            if ($end_page < $total_pages - 1) {
                echo '<span class="px-4 py-2 bg-gray-200 text-gray-500 border border-gray-300">...</span>';
            }
            echo '<a href="?page=' . $total_pages . '" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 hover:bg-blue-500 hover:text-white">' . $total_pages . '</a>';
        }
        ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 hover:bg-gray-300">Next</a>
            <a href="?page=<?php echo $total_pages; ?>" class="px-4 py-2 bg-gray-200 text-gray-700 border border-gray-300 rounded-r-md hover:bg-gray-300">Last</a>
        <?php else: ?>
            <span class="px-4 py-2 bg-gray-200 text-gray-500 border border-gray-300">Next</span>
            <span class="px-4 py-2 bg-gray-200 text-gray-500 border border-gray-300 rounded-r-md">Last</span>
        <?php endif; ?>
    </div>
</nav>


    </div>

    <script>
        
        
        //-----------------------------------------------dcsv----------------------------------
        function downloadCSV() {
    const rows = document.querySelectorAll('#userTableBody tr');
    let csvContent = 'ID,mongoId,Username,Email\n'; // Add headers

    rows.forEach(row => {
        const cols = row.querySelectorAll('td');
        const rowData = [
            cols[0].innerText, // ID
            cols[1].innerText, // mongoId
            cols[2].innerText, // Username
            cols[3].innerText // Email
        ];
        csvContent += rowData.join(',') + '\n';
    });

    // Create a data URI for the CSV content
    const encodedCSV = encodeURIComponent(csvContent);
    const dataURI = 'data:text/csv;charset=utf-8,' + encodedCSV;

    // Create a link and trigger the download
    const link = document.createElement('a');
    link.setAttribute('href', dataURI);
    link.setAttribute('download', 'users.csv');
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Event listener for download button
document.getElementById('downloadCsvButton').addEventListener('click', downloadCSV);

        // let userIdToDelete = null;
        let userToEdit = null;
        // let mongoIdToDelete = null;

        // Open Edit Modal and set userIdToEdit
        function openEditModal(userId, username, email, mongoId) {
            console.log(userId, username, email, mongoId)
            document.getElementById('editUserId').value = userId;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editMongoId').value = mongoId; // Ensure mongoId is set
            document.getElementById('editModal').classList.remove('hidden');
        }



        // Close Edit Modal
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission


            const userId = document.getElementById('editUserId').value;
            const username = document.getElementById('editUsername').value;
            const email = document.getElementById('editEmail').value;
            const mongoId = document.getElementById('editMongoId').value;

            // Send AJAX request to update user data
            fetch('/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: userId, // Send id and mongoId in the body
                        mongoId: mongoId,
                        name: username,
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        alert(data.message);
                        location.reload(); 
                    } else {
                        
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        
        function confirmDelete(id, mongoId) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Send DELETE request to backend
                window.location.href = '/delete/' + id + '/' + mongoId;
            }
        }

        

        // Filter Users by Username or Email
        document.getElementById('filterInput').addEventListener('input', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTableBody tr');
            rows.forEach(function(row) {
                const username = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                const email = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                if (username.includes(filterValue) || email.includes(filterValue)) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>