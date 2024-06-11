<section id="riderDetailTable">
    <div class="container">
        <h2 class="title">Rider Details</h2>
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>Sn.</th>
                <th>Riders</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($pdo)) {
                try {
                    $stmt = $pdo->prepare("SELECT rider_id, name FROM riders");
                    $stmt->execute();
                    $riders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($riders)) {
                        echo "<tr><td colspan='3'>No riders found.</td></tr>";
                    } else {
                        $index = 0;
                        foreach ($riders as $rider) {
                            ?>
                            <tr>
                                <td><?php echo(++$index) ?> </td>
                                <td><?php echo htmlspecialchars($rider['name']) ?> </td>
                                <td>
                                    <a class="button is-small is-info"
                                       href="<?php echo 'rider.php?rider_id=' . $rider['rider_id']; ?>">Edit</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='3'>Error: " . $e->getMessage() . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Database connection not established.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
