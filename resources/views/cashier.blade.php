<html>
<head>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .parentDisable {
            position:fixed;
            top:0;
            left:0;
            background:#000;
            opacity:0.8;
            z-index:998;
            height:100%;
            width:100%;
        }
    </style>
</head>

<body ng-app="cashier">
<main-app></main-app>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>

    var app = angular.module('cashier', []);

    app.directive('mainApp', MainApp);

    function MainApp() {
        return {
            restrict: 'E',
            templateUrl: '/templates/main-app.html',
            priority: 9999,
            scope: {},
            controller: CashierController,
            controllerAs: 'cashier'
        };
    }
    ;

    app.directive('spendingItem', SpendingItem);

    function SpendingItem() {
        return {
            restrict: 'E',
            templateUrl: '/templates/spending-item.html',
            priority: 1001,
            scope: {},
            controller: CashierController,
            controllerAs: 'cashier'
        };
    }
    ;

    app.directive('addBar', AddBar);

    function AddBar() {
        return {
            restrict: 'E',
            templateUrl: '/templates/add-bar.html',
            scope: {},
            controller: CashierController,
            controllerAs: 'cashier'
        };
    }
    ;

    app.directive('statistics', Statistics);

    function Statistics() {
        return {
            restrict: 'E',
            templateUrl: '/templates/statistics.html',
            priority: 1001,
            scope: {
                total: '=total'
            },
            controller: CashierController,
            controllerAs: 'cashier'
        };
    }
    ;


    app.controller('CashierController', CashierController);

    function CashierController($http) {
        var self = this;

        this.categories = [
            {name: "Еда"},
            {name: "Проезды"},
            {name: "Алкоголь"},
            {name: "Электроника"},
            {name: "Мебель"},
            {name: "Посуда"}
        ];

        this.isShowed = false;
        this.monthMoney = 30000;
        this.now = new Date().toLocaleDateString();

        if (localStorage.getItem('spendingItems') != null) {
            this.spendingItems = JSON.parse(localStorage.getItem('spendingItems'));
        } else {
            this.spendingItems = [];
        }

        var now = new Date();


        if (now.getDate() === 1) {
            if (localStorage.getItem('isReseted') == null) {
                localStorage.clear();
                localStorage.setItem('isReseted', 'true');
            }
        }

        if (now.getDate() === 2) {
            localStorage.removeItem('isReseted');
        }

        this.totalPrice = function () {
            var total = 0;
            for (var i = 0; i < this.spendingItems.length; i++) {
                total += parseInt(this.spendingItems[i].price);
            }
            return total;
        };

        this.clearAll = function () {
            localStorage.clear();
            window.location.reload(false);
        }

        this.countCat = function (cat) {
            var total = 0;
            for (var i = 0; i < this.spendingItems.length; i++) {
                if (this.spendingItems[i].category == cat) {
                    total += parseInt(this.spendingItems[i].price);
                }
            }
            return total;
        };

        this.lastSixDays = function () {
            var dates = [];
            for(var i = 1; i<=5; i++) {
                var date = new Date();
                var dd = date.getDate();
                date.setDate(dd - i);
                dates.push(date);
            }
            return dates;
        };

        this.dates = this.lastSixDays();

        this.percentage = function () {
            var percent = this.monthMoney / 100;

            return this.totalPrice()/percent;
        }


        this.addItem = function () {

            var date = new Date();

            this.spendingItems.push({
                name: self.name,
                price: self.price,
                category: self.category,
                date: date
            });
            this.isShowed = true;

            this.totalPrice();

            var tmp = JSON.stringify(this.spendingItems);

            localStorage.clear();
            localStorage.setItem('spendingItems', tmp);
        }
    }
</script>
</html>