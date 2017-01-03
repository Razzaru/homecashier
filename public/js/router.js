var app = angular.module('cashier');

app.config(function($stateProvider) {
    $stateProvider
        .state('date', {
            url:'date',
            template: '<date-sum></date-sum>'
        })
})

