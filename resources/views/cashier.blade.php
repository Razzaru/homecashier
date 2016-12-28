<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .parentDisable {
            position: fixed;
            top: 0;
            left: 0;
            background: #000;
            opacity: 0.8;
            z-index: 998;
            height: 100%;
            width: 100%;
        }

        .nulling {
            position: absolute;
            z-index: 999;
            left: 825px;
            top: 53px;
        }

        @media (max-width: 768px) {
            .nulling {
                left: auto;
                right: 50px;
            }
        }

    </style>
</head>

<body ng-app="cashier">

<main-app></main-app>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.2/angular-ui-router.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
<script src="/js/main.js"></script>
<script src="/js/router.js"></script>
</body>
</html>