<section id="rideDetailTable">
    <div class="container">
        <h2 class="title">Ride Details</h2>
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Sn.</th>
                    <th>Rider</th>
                    <th>Ride Type</th>
                    <th>City</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($pdo)) {
                    try {
                        $stmt = $pdo->prepare("SELECT r.ride_id, riders.name as rider, r.ride_type, cities.name as city, r.ride_date FROM rides r JOIN riders ON r.rider_id = riders.rider_id JOIN cities ON r.city_id = cities.city_id");
                        $stmt->execute();
                        $rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($rides)) {
                            echo "<tr><td colspan='6'>No rides found.</td></tr>";
                        } else {
                            $index = 0;
                            foreach ($rides as $ride) { ?>
                                <tr>
                                    <td><?php echo(++$index) ?> </td>
                                    <td><?php echo htmlspecialchars($ride['rider']) ?> </td>
                                    <td><?php echo htmlspecialchars($ride['ride_type']) ?> </td>
                                    <td><?php echo htmlspecialchars($ride['city']) ?> </td>
                                    <td><?php echo htmlspecialchars($ride['ride_date']) ?> </td>
                                    <td>
                                        <a class="button is-small is-info" href="<?php echo 'ride.php?ride_id=' . $ride['ride_id']; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php }
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Database connection not established.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
