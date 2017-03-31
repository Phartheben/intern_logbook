angular.module('app.services', [])

.factory('$blob', function() {
    return {
        csvToURL: function(content) {
            var blob;
            blob = new Blob([content], { type: 'text/csv' });
            return (window.URL || window.webkitURL).createObjectURL(blob);
        },
        sanitizeCSVName: function(name) {
            if (/^[A-Za-z0-9]+\.csv$/.test(name)) {
                return name;
            }
            if (/^[A-Za-z0-9]+/.test(name)) {
                return name + ".csv";
            }
            throw new Error("Invalid title fo CSV file : " + name);
        },
        revoke: function(url) {
            return (window.URL || window.webkitURL).revokeObjectURL(url);
        }
    };
})

.factory('$click', function() {
    return {
        on: function(element) {
            var e = document.createEvent("MouseEvent");
            e.initMouseEvent("click", false, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
            element.dispatchEvent(e);
        }
    };
})

// .factory('BlankFactory', [function(){

// }])

.factory('activityService', function($http) {
    var activities = [];
    

    return {
        getActivities: function() {
            return $http({
                url: 'https://localhost:8443/logbook/api/activity',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                },
            });
        },

        addActivity: function($data) {
            return $http({
                url: 'https://localhost:8443/logbook/api/activity',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                },
                data: $data,
            });
        // },

        // updateActivity: function($data) {
        //     return $http({
        //         url: 'https://localhost:8443/logbook/api/activity/update',
        //         method: 'PUT',
        //         headers: {
        //             'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
        //             'Access-Control-Allow-Origin': '*',
        //             'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
        //             'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
        //         },
        //         data: $data,
        //     });
        // },

        // deleteActivity: function($data) {
        //     return $http({
        //         url: 'https://localhost:8443/logbook/api/activity/delete',
        //         method: 'DELETE',
        //         headers: {
        //             'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
        //             'Access-Control-Allow-Origin': '*',
        //             'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
        //             'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
        //         },
        //         data: $data,
        //     });
        }

    }

})

.factory('accountService', function($http) {
        var account = [];

        return {
            getIns: function($data) {
                return $http({
                    url: 'https://localhost:8443/logbook/api/institution/showIns',
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                  data: $data,
                 });
            },

            getCom: function($data) {
                return $http({
                    url: 'https://localhost:8443/logbook/api/company/showCom',
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
              data: $data,
                });
            },

            getProfile: function($data) {
                return $http({
                    url: 'https://localhost:8443/logbook/api/profile/show',
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $data,
                });
            },

            getAccount: function($data) {
                return $http({
                    url: 'https://localhost:8443/logbook/api/account/sign-up',
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $data,
                });
            },

            // changePassword: function($data) {
            //     return $http({
            //         url: 'https://localhost:8443/logbook/api/profile/password',
            //         method: 'POST',
            //         headers: {
            //             'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
            //             'Access-Control-Allow-Origin': '*',
            //             'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
            //             'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
            //         },
            //         data: $data,
            //     });


            // },

            addCompany: function($data) {
                return $http({
                    url: 'https://localhost:8443/logbook/api/company',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $data,
                });


            },

            addInstitution: function($data) {
                return $http({
                    url: 'https://localhost:8443/logbook/api/institution',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                    },
                    data: $data,
                });

            },

        }

    })
