<html>
<head>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body ng-app="cashier">
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Home Cashier</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="" ng-click="empty">Spending and statistics</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4">
            <add-bar></add-bar>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <statistics count="cashier.totalCount()"></statistics>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>

    var app = angular.module('cashier', []);

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
                count: '&'
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
            {name: "Food"},
            {name: "Bus"},
            {name: "Alcohol"}
        ];

        this.isShowed = false;
        
        if (localStorage.getItem('spendingItems') != null) {
            this.spendingItems = JSON.parse(localStorage.getItem('spendingItems'));
        } else {
            this.spendingItems = [];
        }

        this.totalPrice = function () {
            var total = 0;
            for (var i=0; i<this.spendingItems.length;i++) {
                total += parseInt(this.spendingItems[i].price);
            }
            return total;
        };
        
        this.addItem = function () {

            this.spendingItems.push({
                name: self.name,
                price: self.price,
                category: self.category
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