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
                        <td><?= $transaction->created_at ?></td>
                        <td><?= $transaction->check_num ?></td>
                        <td><?= $transaction->description ?></td>
                        <td style='color:<?= $transaction->amount['income'] ? 'green' : 'red' ?>'>
                            <?= $transaction->amount['amount'] ?>
                        </td>
                    </tr>
                <?php endforeach ?>
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