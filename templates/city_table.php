<section id="cityDetailTable">
    <div class="container">
        <h2 class="title">Rider Details</h2>
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>Sn.</th>
                <th>Cities</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($pdo)) {
                try {
                    $stmt = $pdo->prepare("SELECT city_id, name FROM cities");
                    $stmt->execute();
                    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($cities)) {
                        echo "<tr><td colspan='3'>No cities found.</td></tr>";
                    } else {
                        $index = 0;
                        foreach ($cities as $city) {
                            ?>
                            <tr>
                                <td><?php echo(++$index) ?> </td>
                                <td><?php echo htmlspecialchars($city['name']) ?> </td>
                                <td>
                                    <a class="button is-small is-info"
                                       href="<?php echo 'city.php?city_id=' . $city['city_id']; ?>">Edit</a>
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
