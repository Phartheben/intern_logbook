angular.module('app.routes', [])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    
  

      .state('menu.home', {
    url: '/page1',
    views: {
      'side-menu21': {
        templateUrl: 'templates/home.html',
        controller: 'homeCtrl'
      }
    }
  })

  .state('settings', {
    url: '/page2',
    templateUrl: 'templates/settings.html',
    controller: 'settingsCtrl'
  })

  .state('menu.logbook', {
    url: '/page3',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook.html',
        controller: 'logbookCtrl'
      }
    }
  })

  .state('menu', {
    url: '/side-menu21',
    templateUrl: 'templates/menu.html',
    controller: 'menuCtrl'
  })

  .state('login', {
    url: '/login_page',
    templateUrl: 'templates/login.html',
    controller: 'loginCtrl'
  })

  .state('signup', {
    url: '/signup_page',
    templateUrl: 'templates/signup.html',
    controller: 'signupCtrl'
  })

  .state('menu.summary', {
    url: '/Summary',
    views: {
      'side-menu21': {
        templateUrl: 'templates/summary.html',
        controller: 'summaryCtrl'
      }
    }
  })

$urlRouterProvider.otherwise('/side-menu21/page1')

  

});