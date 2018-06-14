var app = angular.module('WVCApp', ['ui.bootstrap']);

app.controller('WVCCtrl', function($scope) {
$scope.hoverLogin = false;
    $scope.toggleSubmenu = function() {
        $scope.hoverLogin = $scope.hoverLogin === false ? true : false;
    };
    
$scope.hoverIn = function(){
    this.hoverLogin = true;
};

$scope.hoverOut = function(){
    this.hoverLogin = false;
};


  $scope.myInterval = 3000;
  $scope.slides = [
    {
      image: '/assets/images/banner-1.jpg'
    },
    {
      image: '/assets/images/banner-3.jpg'
    },
    {
      image: '/assets/images/banner-2.jpg'
    },
    {
      image: '/assets/images/banner-3.jpg'
    }
  ];

});

