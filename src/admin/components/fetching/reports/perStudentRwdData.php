<?php
// Set timezone to ensure consistency
date_default_timezone_set('Asia/Manila'); // Adjust if necessary

// Updated Query to fetch students who have recycled
$queryStudents = "
    SELECT DISTINCT 
        u.usr_id, 
        u.usr_fname, 
        u.usr_lname 
    FROM 
        tbl_user u
    JOIN 
        tbl_rcnt_hry h 
    ON 
        u.usr_id = h.hry_user_id
    WHERE 
        h.hry_activity = 'Redeem Accepted'
    ORDER BY 
        u.usr_lname, u.usr_fname;
";

$resultStudents = $conn->query($queryStudents);

if ($resultStudents->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Custom CSS -->
        <link href="../../../../../views/output.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <title>All Students' Redeemed Items</title>
    </head>

    <body>
        <div class="w-full h-full p-4">
            <h1 class="text-2xl font-bold text-center mb-4">Redeemed Items Per Student</h1>

            <?php
            // Loop through each student
            while ($student = $resultStudents->fetch_assoc()) {
                $studentId = $student['usr_id'];
                $studentName = htmlspecialchars($student['usr_fname'] . ' ' . $student['usr_lname']);

                // Query to fetch recycled items for this student
                $queryItems = "SELECT hry_rcy_item AS item_name, hry_rcy_pts AS item_points, hry_refnum AS ref_num FROM tbl_rcnt_hry WHERE hry_user_id = ? AND hry_activity = 'Recycle Accepted'";
                $stmtItems = $conn->prepare($queryItems);
                $stmtItems->bind_param("i", $studentId);
                $stmtItems->execute();
                $resultItems = $stmtItems->get_result();

                ?>
                <!-- Display Student Name -->
                <div class="mb-6 border border-bgborder border-opacity-50 mt-2 rounded-md p-1">
                    <div class="text-md font-normal mb-2 border-b-[1px] border-bgborder border-opacity-50">
                       <span class="font-popin font-medium">Name:</span> <?php echo $studentName; ?>
                    </div>

                    <?php
                    if ($resultItems->num_rows > 0) {
                        ?>
                        <div class="overflow-x-auto p-2">
                            <table class="table table-xs w-full">
                                <thead>
                                    <tr>
                                        <th>Ref No.</th>
                                        <th>Item</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($item = $resultItems->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['ref_num']); ?></td>
                                        <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                                        <td><?php echo htmlspecialchars($item['item_points']); ?> points</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        echo '<p class="text-gray-500 text-xs text-center">No items recycled yet.</p>';
                    }

                    // Close the statement
                    $stmtItems->close();
                    ?>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </body>

    </html>
    <?php
} else {
    echo "<p>No students found in the database.</p>";
}
?>
