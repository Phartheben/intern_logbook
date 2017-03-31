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

.controller('signUpCtrl', ['$scope', '$stateParams', '$location', '$http',
    'accountService', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http, accountService) {

        $scope.data = {
            firstname: '',
            lastname: '',
            email: '',
            password: '',
        }

        $scope.create = function() {
            accountService.getAccount($scope.data).then(function() {
                $location.path('/side-menu21/logbook');
            });

        }

    }
])

.controller('menuCtrl', ['$scope', '$stateParams', '$location', '$http',
    'accountService',
    // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http, accountService) {

        $scope.data = {};

        accountService.getProfile()
            .then(function(response) {
                $scope.data.profile = response.data.response.resource;
                console.log($scope.data.profile);
            })

        accountService.getIns()
            .then(function(response) {
                $scope.data.institution = response.data.response.resource;
                console.log($scope.data.institution);
            })

        accountService.getCom()
            .then(function(response) {
                $scope.data.company = response.data.response.resource;
                console.log($scope.data.company);
            });
    }
])

.controller('logbookCtrl', ['$scope', '$stateParams', '$location', '$http',
    'activityService',
    // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http, activityService) {

        $scope.data = {};

        $scope.update = function(id) {
                $http({
                        url: 'https://localhost:8443/logbook/api/activity',
                        method: 'PUT',
                        headers: {
                            'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
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

            },

            $scope.delete = function(id) {
                $http({
                        url: 'https://localhost:8443/logbook/api/activity/' + id, 
                        method: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                            'Access-Control-Allow-Origin': '*',
                            'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE',
                            'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                            // 'Content-Type': 'application/json',
                        },
                        data: $scope.data,
                    })
                    .success(function(response) {
                        console.log(response);
                    })
                    .error(function(response) {
                        console.log(response);
                    });
            },

            activityService.getActivities()
            .then(function(response) {
                $scope.activities = response.data.response.resources;
            });
    }
])

.controller('settingsCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('page6Ctrl', ['$scope', '$stateParams', '$location', '$http',
    // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

        $scope.data = {
            password: '',
        }
        $scope.changepwd = function() {
            $http({
                    url: 'https://localhost:8443/logbook/api/profile/password',
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
                    console.log(response);
                })
                .error(function(response) {
                    console.log("Error");
                });

        }

    }
])

.controller('page7Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {
        $scope.data = {
            avatar: '',
        }

        $scope.getImage = function(data) {
            return 'data:image/jpeg;base64,' + data;
        }

        var formdata = new FormData();
        $scope.getTheFiles = function($files) {
            angular.forEach($files, function(value, key) {
                formdata.append('avatar', $scope.UploadPicture);
            });
        };
        $scope.UploadPicture = function() {

            var fd = new FormData();
            fd.append('avatar', $scope.data.avatar);
            // console.log($scope.data.avatar);
            var request = {
                method: 'POST',
                url: 'https://localhost:8443/logbook/api/profile/avatar',
                data: fd,
                transformRequest: angular.identity,
                headers: {
                    'Content-Type': undefined,
                    'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'multipart/form-data, X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                }
            };
            $http(request)
                .success(function(d) {
                    alert(d);
                })
                .error(function() {});
        }
    }
])

.controller('page21Ctrl', ['$scope', '$stateParams', '$location', '$http',
    'accountService', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http, accountService) {

        $scope.data = {
            name: '',
            location: '',
        }
        $scope.addCompany = function() {
            accountService.addCompany($scope.data).then(function() {
                $location.path('/side-menu21/logbook');
            });
        }
    }
])

.controller('page22Ctrl', ['$scope', '$stateParams', '$location', '$http',
    'accountService', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http, accountService) {

        $scope.data = {
            name: '',
            intake: '',
            location: '',
        }
        $scope.addInstitution = function() {
            accountService.addInstitution($scope.data).then(function() {
                $location.path('/side-menu21/logbook');
            });
        }
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

.controller('summaryCtrl', ['$scope', '$stateParams', '$location', '$http',
    'activityService',
    // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http, activityService) {

        $scope.data = {
            description: '',
            date: '',
        }

        $scope.generatePDF = function() {
                $http({
                        url: 'https://localhost:8443/logbook/api/getPDF',
                        method: 'GET',
                        responseType: 'arraybuffer',
                        type: "application/octet-stream",
                        accept: 'application/pdf',
                        cache: true,
                        headers: {
                            'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
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

            },

            $scope.generateCSV = function() {
                $http({
                        url: 'https://localhost:8443/logbook/api/excel',
                        method: 'GET',
                        cache: false,
                        responseType: 'arraybuffer',
                        headers: {
                            'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
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

            },

            activityService.getActivities()
            .then(function(response) {
                $scope.activities = response.data.response.resources;
            });
    }
])

.controller('monthlySummaryCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])

.controller('logbook4Ctrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {

    }
])

.controller('logbook5Ctrl', ['$scope', '$stateParams', '$http', '$location',
    'activityService',
    // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $http, $location, activityService) {

        $scope.data = {
            description: '',
            date: '',

        }

        $scope.submit = function() {
            activityService.addActivity($scope.data).then(function() {
                $location.path('/side-menu21/logbook');
            });
        }
    }
])

.controller('pageCtrl', ['$scope', '$stateParams', '$location', '$http', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
    // You can include any angular dependencies as parameters for this function
    // TIP: Access Route Parameters for your page via $stateParams.parameterName
    function($scope, $stateParams, $location, $http) {


    }
])
