<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 7px;
        }
    </style>
</head>

<body>
    <h3>Home!</h3>

    <div style="display:flex">
        <?php if (!empty($transactions)): ?>
            <table border="1">
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= $transaction->created_at->format('M d, Y') ?></td>
                        <td><?= $transaction->check_num ?></td>
                        <td><?= $transaction->description ?></td>
                        <td style='color:<?= $transaction->income ? 'green' : 'red' ?>'>
                            <?= $transaction->amount->getFormated() ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Total Income: </strong></td>
                    <td>
                        <?= $totalIncome ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Total Expense: </strong></td>
                    <td>
                        <?= $totalExpense ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Net Total: </strong></td>
                    <td>
                        <?= $netTotal ?>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p style="color:red">No transactions..</p>
        <?php endif ?>
        <br />
        <div>
            <a href="/create">Register new Transaction File. ¡aqui!</a>
        </div>
    </div>
</body>

</html>