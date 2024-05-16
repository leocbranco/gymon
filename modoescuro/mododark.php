<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
        * {
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box;
        }

        body {
            transition: background 0.2s linear, color 0.2s linear;
        }

        body.light {
            background-color: #fafafa;
            color: #000000;
        }

        body.light .exercise-list {
            background-color: #ffffff;
            color: #000000;
        }

        body.light .exercise-table th {
            background-color: #e0e0e0;
            color: #000000;
        }

        body.light .exercise-table td {
            background-color: #f5f5f5;
            color: #000000;
        }

        body.light .exercise-table td img {
            border: 1px solid #000000;
        }

        body.light input,
        body.light textarea {
            background-color: #ffffff;
            color: #000000;
        }

        .checkbox {
            opacity: 0;
            position: absolute;
        }

        .label {
            background-color: #111;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
            position: relative;
            height: 30px;
            width: 60px;
        }

        .label .ball {
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            height: 24px;
            width: 24px;
            transform: translateX(0px);
            transition: transform 0.2s linear;
        }

        .checkbox:checked + .label .ball {
            transform: translateX(30px);
        }

        .fa-moon {
            color: #f1c40f;
        }

        .fa-sun {
            color: #f39c12;
        }

        .dark-mode-switch {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="dark-mode-switch">
        <input type="checkbox" class="checkbox" id="chk" />
        <label class="label" for="chk">
            <i class="fas fa-moon"></i>
            <i class="fas fa-sun"></i>
            <div class="ball"></div>
        </label>
    </div>

    <script src="modo-escuro.js"></script>
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
</body>
</html>
