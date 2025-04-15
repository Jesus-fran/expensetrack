<div style="display:flex">
    <?php if (!empty($transactions)): ?>
        <div class="border-table">
            <table border="1">
                <tr class="head-table">
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
        </div>
    <?php else: ?>
        <p style="color:red">No transactions..</p>
    <?php endif ?>
    <br />
    <div>

    </div>
</div>