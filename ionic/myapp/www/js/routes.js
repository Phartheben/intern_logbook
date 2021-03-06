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

  .state('menu.page6', {
    url: '/change_pass',
    views: {
      'side-menu21': {
        templateUrl: 'templates/page6.html',
        controller: 'page6Ctrl'
      }
    }
  })

  .state('menu.page7', {
    url: '/update_profpic',
    views: {
      'side-menu21': {
        templateUrl: 'templates/page7.html',
        controller: 'page7Ctrl'
      }
    }
  })

   .state('menu.page21', {
    url: '/add_company',
    views: {
      'side-menu21': {
        templateUrl: 'templates/page21.html',
        controller: 'page21Ctrl'
      }
    }
  })

   .state('menu.page22', {
    url: '/add_institution',
    views: {
      'side-menu21': {
        templateUrl: 'templates/page22.html',
        controller: 'page22Ctrl'
      }
    }
  })

  .state('menu.logbook2', {
    url: '/logbook_first',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook2.html',
        controller: 'logbook2Ctrl'
      }
    }
  })

  .state('menu.remarks', {
    url: '/remarks_firstday',
    views: {
      'side-menu21': {
        templateUrl: 'templates/remarks.html',
        controller: 'remarksCtrl'
      }
    }
  })

  .state('menu.remarks2', {
    url: '/remarks_pub',
    views: {
      'side-menu21': {
        templateUrl: 'templates/remarks2.html',
        controller: 'remarks2Ctrl'
      }
    }
  })

  .state('menu.logbook3', {
    url: '/public',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook3.html',
        controller: 'logbook3Ctrl'
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

  .state('logbook4', {
    url: '/page9',
    templateUrl: 'templates/logbook4.html',
    controller: 'logbook4Ctrl'
  })


  .state('menu.logbook5', {
    url: '/new entry',
    views: {
      'side-menu21': {
        templateUrl: 'templates/logbook5.html',
        controller: 'logbook5Ctrl'
      }
    }
  })

  .state('page', {
    url: '/page17',
    templateUrl: 'templates/page.html',
    controller: 'pageCtrl'
  })

$urlRouterProvider.otherwise('/login')

  

});