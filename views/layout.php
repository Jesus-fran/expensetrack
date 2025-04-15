<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            margin: 0px;
        }

        .title {
            text-decoration: none;
            color:black;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .border-table {
            border: 5px;
            border-radius: 30px;
            border-color: gold;
            border-style: solid;
            margin: 10px;
        }

        .head-table,
        th {
            background-color: cornflowerblue;
        }

        table {
            border-collapse: collapse;
            margin: 10px;
            border-radius: 30px;
        }

        th,
        td {
            padding: 7px;
        }

        header div,
        footer div {
            text-align: center;
            width: auto;
            background-color: gold;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <a href="/" class="title">
                <h2>Expense Tracking</h2>
            </a>
            <a href="/create">Register new Transaction File. ¡aqui!</a>
        </div>
    </header>


    <div style="display:flex">

        <?= $content ?>

    </div>

    <footer>
        <div>
            <h3> Elaborated with ❤︎ by Jesus Francisco</h3>
        </div>
    </footer>
</body>

</html>