<?php

require DOCUMENT_ROOT . '/../core/Storage.php';

$search = empty($_GET['search']) ? null : htmlspecialchars($_GET['search']);
$dateFrom = empty($_GET['date-from']) ? null : htmlspecialchars($_GET['date-from']);
$dateTo = empty($_GET['date-to']) ? null : htmlspecialchars($_GET['date-to']);

$storage = new Storage();
$currencyList = $storage->select($search, $dateFrom, $dateTo);
?>

    <form method="get" autocomplete="off">
        <div class="row">
            <div class="col mb-3">
                <div class="form-input__date">
                    <label for="form-input__from">From</label>
                    <input name="date-from" id="form-input__from" type="text" class="form-control">
                </div>
            </div>
            <div class="col mb-3">
                <div class="form-input__date">
                    <label for="form-input__to">To</label>
                    <input name="date-to" id="form-input__to" type="text" class="form-control">
                </div>
            </div>
            <div class="col mb-3">
                <label for="form-input__search">ValuteId</label>
                <input name="search" id="form-input__search" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">SEARCH</button>
            </div>
        </div>
    </form>

<?php if ($currencyList): ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ValuteID</th>
                <th scope="col">NumCode</th>
                <th scope="col">CharCode</th>
                <th scope="col">Name</th>
                <th scope="col">Value</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($currencyList as $currency): ?>
                <tr>
                    <td><?php echo htmlspecialchars($currency['valuteId']) ?></td>
                    <td><?php echo htmlspecialchars($currency['numCode']) ?></td>
                    <td><?php echo htmlspecialchars($currency['charCode']) ?></td>
                    <td><?php echo htmlspecialchars($currency['name']) ?></td>
                    <td><?php echo htmlspecialchars($currency['value']) ?></td>
                    <td><?php echo htmlspecialchars($currency['date']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>