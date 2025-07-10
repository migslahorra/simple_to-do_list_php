<?php
require "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO List</title>
</head>
<body>
    <h1>Simple TO-DO List</h1>
    <form action="backend.php" method="post">
        <label for="task">Task:</label>
        <input type="text" name="task" placeholder="Enter to do task" required>
        <input type="submit" name="submit" value="Submit">
    </form>

    <br>

    <table class="to-do-table">
        <thead>
            <th>Task</th>
            <th>Options</th>
        </thead>

        <tbody>
            <?php
            $input = $conn->prepare("SELECT * FROM tasks ORDER BY id ASC");
            $input->execute();
            $result = $input->get_result();

            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row['task']) ?></td>

                <td>
                    <?php if ($row['complete'] == 0): ?>
                        <form action="backend.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="complete" value="1">
                            <button type="submit" name="mark_complete">Complete</button>
                        </form>
                    <?php else: ?>
                        Task Complete!
                    <?php endif; ?>
                </td>

                <td>
                    <form action="backend.php" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>