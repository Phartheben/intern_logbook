angular.module('app.routes', [])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    
  

      .state('logIn', {
    url: '/login',
    templateUrl: 'templates/logIn.html',
    controller: 'logInCtrl'
  })

  .state('signUp', {
    url: '/sign_up',
    templateUrl: 'templates/signUp.html',
    controller: 'signUpCtrl'
  })

  .state('menu', {
    url: '/side-menu21',
    templateUrl: 'templates/menu.html',
    controller: 'menuCtrl'
  })

  .state('menu.logbook', {
    url: '/logbook',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook.html',
        controller: 'logbookCtrl'
      }
    }
  })

  .state('menu.settings', {
    url: '/settings ',
    views: {
      'side-menu21': {
        templateUrl: 'templates/settings.html',
        controller: 'settingsCtrl'
      }
    }
  })

  .state('menu.change_pass', {
    url: '/change_pass',
    views: {
      'side-menu21': {
        templateUrl: 'templates/change_pass.html',
        controller: 'change_passCtrl'
      }
    }
  })

  .state('menu.change_mail', {
    url: '/chge_email',
    views: {
      'side-menu21': {
        templateUrl: 'templates/change_mail.html',
        controller: 'change_mailCtrl'
      }
    }
  })

  .state('menu.logbook2', {
    url: '/logbook1',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook2.html',
        controller: 'logbook2Ctrl'
      }
    }
  })

  .state('menu.summary', {
    url: '/summary',
    views: {
      'side-menu21': {
        templateUrl: 'templates/summary.html',
        controller: 'summaryCtrl'
      }
    }
  })

  .state('menu.monthlySummary', {
    url: '/monthly_summary',
    views: {
      'side-menu21': {
        templateUrl: 'templates/monthlySummary.html',
        controller: 'monthlySummaryCtrl'
      }
    }
  })

  .state('menu.pDFSummary', {
    url: '/PDF_summary',
    views: {
      'side-menu21': {
        templateUrl: 'templates/pDFSummary.html',
        controller: 'pDFSummaryCtrl'
      }
    }
  })

  .state('menu.cSVSummary', {
    url: '/csv_summary',
    views: {
      'side-menu21': {
        templateUrl: 'templates/cSVSummary.html',
        controller: 'cSVSummaryCtrl'
      }
    }
  })

  .state('menu.logbook3', {
    url: '/new entry',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook3.html',
        controller: 'logbook3Ctrl'
      }
    }
  })

$urlRouterProvider.otherwise('/login')

  

});