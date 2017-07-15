
var App = angular.module('myApp', []);
 function FormController($scope, $http)
  {
 
	 $scope.name = undefined;
	 $scope.mobile = undefined;
	 $scope.email = undefined;
	 $scope.address = undefined;
	 $scope.message = undefined;
	 $scope.submitForm = function ()
	 {
	 	 console.log("posting data....");
		 $http({
		 method: 'POST',
		 url: '<?php echo base_url(); ?>index.php/angular/angular_controller/add',
		 headers: {'Content-Type': 'application/json'},
		 data: JSON.stringify({name: $scope.name,mobile:$scope.mobile,email:$scope.email,address:$scope.address})
		 }).success(function (data) {
		 console.log(data);
		 $scope.message = data.status;
		 });
	}
  }