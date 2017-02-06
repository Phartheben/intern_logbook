angular.module('app.controllers', [])

.controller('logInCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

        $scope.data = {
            email: '',
            password: '',
        }
        $scope.login = function() {
            $http({
                    url: 'https://localhost:8443/logbook/oauth/token',
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    // data: $scope.data,
                    data: {
                        grant_type: 'password',
                        client_id: 18,
                        client_secret: 'ka1d2pxF3gSTLlmhrcgkz34Zskiu8rwCigunJHec',
                        username: $scope.data.email,
                        password: $scope.data.password,
                        scope: '',
                    }

                })
                .success(function(response) {

                    window.localStorage.setItem('access_token', response.access_token);
                    window.localStorage.setItem('refresh_token', response.refresh_token);
                    window.sessionStorage.setItem('refresh_token', response.refresh_token);


                    $location.path('/side-menu21/logbook');
                })
                .error(function(response) {
                    console.log("Email or password Invalid, Please try again.");
                });

        }

    }
])

.controller('signUpCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

        $scope.data = {
            firstname: '',
            lastname: '',
            email: '',
            password: '',
        }
        $scope.create = function() {
            $http({
                    url: 'https://localhost:8443/logbook/api/account/sign-up',
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $scope.data,
                })
                .success(function(response) {
                    console.log(response);
                })
                .error(function(response) {
                    console.log("Error");
                });

            // console.log('create');
            // if ($scope.data.firstName =' ') {
            // $location.path('/side-menu21/logbook');
            // }
        }

    }
])

.controller('menuCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('logbookCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('settingsCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('page6Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('page7Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('logbook2Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('remarksCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('remarks2Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('logbook3Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('summaryCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('monthlySummaryCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('pDFSummaryCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

        $scope.generate = function() {
            $http({
                    url: 'https://localhost:8443/logbook/api/pdf',
                    method: 'GET',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $scope.description,
                })
                .success(function(response) {
                    console.log(response);
                })
                .error(function(response) {
                    console.log("Error");
                });

            // console.log('create');
            // if ($scope.data.firstName =' ') {
            // $location.path('/side-menu21/logbook');
            // }
        }


    }
])

.controller('logbook4Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

    }
])

.controller('cSVSummaryCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

        $scope.generateCSV = function() {
            $http({
                    url: 'https://localhost:8443/logbook/api/csv',
                    method: 'GET',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $scope.description,
                })
                .success(function(response) {
                    console.log(response);
                })
                .error(function(response) {
                    console.log("Error");
                });

            // console.log('create');
            // if ($scope.data.firstName =' ') {
            // $location.path('/side-menu21/logbook');
            // }
        }



    }
])

.controller('logbook5Ctrl', ['$scope', '$stateParams', '$http', '$location', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $http, $location) {

        $scope.data = {
            description: '',
            date: '',

        }
        $scope.submit = function() {
            $http({
                    url: 'https://localhost:8443/logbook/api/activity',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $scope.data,
                })
                .success(function(response) {
                    $location.path('/side-menu21/logbook');
                })
                .error(function(response) {
                    console.log("Error");
                })

        }


    }
])

.controller('pageCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])
