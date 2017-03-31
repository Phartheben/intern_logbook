angular.module('app.directives', [])

.directive('passwordVerify', function() {
    return {
        require: 'ngModel',
        link: function(scope, elem, attrs, ctrl) {
            if (!attrs.passwordVerify) {
                return;
            }
            scope.$watch(attrs.passwordVerify, function(value) {
                if (value === ctrl.$viewValue && value !== undefined) {
                    ctrl.$setValidity('passwordVerify', true);
                    ctrl.$setValidity("parse", undefined);
                } else {
                    ctrl.$setValidity('passwordVerify', false);
                }
            });
            ctrl.$parsers.push(function(value) {
                var isValid = value === scope.$eval(attrs.passwordVerify);
                ctrl.$setValidity('passwordVerify', isValid);
                return isValid ? value : undefined;
            });
        }
    };
})

.directive('fileModel', ['$parse', function($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function() {
                scope.$apply(function() {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}])

.directive('file', function() {
    return {
        scope: {
            avatar: '='
        },
        link: function(scope, el, attrs) {
            el.bind('change', function(event) {
                var file = event.target.files[0];
                scope.file = file ? file : undefined;
                scope.$apply();
            });
        }
    };
})

.directive('httpSrc', [
    '$http', function ($http) {
        var directive = {
            link: link,
            restrict: 'A'
        };
        return directive;

        function link(scope, element, attrs) {
            var requestConfig = {
                method: 'GET',
                url: 'https://localhost:8443/logbook/api/'+attrs.httpSrc,
                responseType: 'arraybuffer',
                cache: 'true',
                headers: {
                    'Authorization': 'Bearer ' + window.localStorage.getItem('access_token'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'X-Auth-Token, Origin, Content-Type, Accept, Authorization, X-Request-With',
                },
            };

            $http(requestConfig)
                .success(function(data) {
                    var arr = new Uint8Array(data);

                    var raw = '';
                    var i, j, subArray, chunk = 5000;
                    for (i = 0, j = arr.length; i < j; i += chunk) {
                        subArray = arr.subarray(i, i + chunk);
                        raw += String.fromCharCode.apply(null, subArray);
                    }

                    var b64 = btoa(raw);

                    attrs.$set('src', "data:image/jpeg;base64," + b64);
                });
        }

    }
]);
