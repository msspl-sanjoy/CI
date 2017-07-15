<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>
</head>
<body>


<div id="container" ng-app="myApp" >
 <section>
 	<center>
		 <form class="form-inline" ng-controller="FormController" ng-submit="submitForm()" role="form" method="post">
			 <div class="form-group">
			 	<label class="sr-only" >Enter Your Name</label>
				<input type="text" ng-model="name"   >
			 </div>
			 <div class="form-group">
				 <label class="sr-only" >Enter Your Mobile</label>
				 <input type="text" ng-model="mobile"   >
			 </div>
			 <div class="form-group">
				 <label class="sr-only" >Enter Your Email</label>
				 <input type="email" ng-model="email"  >
			 </div>
			 <div class="form-group">
			 	 <label class="sr-only" >Enter Your Address</label>
				 <input type="text" ng-model="address"   >
			 </div>
		 	<button type="submit" class="btn btn-primary">Submit Record</button>
			
		</form>
		<pre>{{message}}</pre>
	</center>
</section>
</div>
<script>
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
</script>
</body>
</html>