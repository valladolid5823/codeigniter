<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center">List of Sales Profiles</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Commission Percentage</th>
                            <th scope="col">Tax Rate</th>
                            <th scope="col">Bonuses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($profiles as $profile): ?>
                            <tr>
                                <th scope="row"><?= $profile->id ?></th>
                                <td><?= $profile->name ?></td>
                                <td><?= $profile->commission_percentage ?></td>
                                <td><?= $profile->tax_rate ?></td>
                                <td><?= $profile->bonuses ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
