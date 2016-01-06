angular.module('todo-list',[])

.controller('TaskController',['$scope','ApiService',function($scope,ApiService){

    $scope.users = [];
    $scope.categories = [];
    $scope.task = {};
    $scope.formErrors = [];
    $scope.tasks = [];

    $scope.init = function(){
        ApiService.getUsers().success(function(json){
            $scope.users = json;
        });

        ApiService.getCategories().success(function(json){
            $scope.categories = json;
        });

        $scope.loadTask();
    };

    $scope.createTask = function(){
        $scope.formErrors = [];
        ApiService.createTask($scope.task).success(function(json){
            if(json.errors){ // Check for errors
                $scope.formErrors = json.errors;
            }else{
                console.log(json);
                // Reload tasks
                $scope.loadTask();
                $scope.task = {};
            }
        });
    };

    $scope.loadTask = function(){
        ApiService.getTasks().success(function(json){
            $scope.tasks = json;
        });
    };

    $scope.deleteTask = function(id){
        ApiService.deleteTask(id).success(function(json){
            if(json.success){
                $scope.loadTask();
            }
        });
    };

    $scope.init();

}])

.factory('ApiService',['$http',function($http){
    var fac = {};

    fac.getUsers = function(){
        return $http({
            method:'GET',
            url:'/user'
        });
    };

    fac.getCategories = function(){
        return $http({
            method:'GET',
            url:'/category'
        });
    };

    fac.getTasks = function(){
        return $http({
            method:'GET',
            url:'/task'
        });
    };

    fac.deleteTask = function(id){
        return $http({
            method:'DELETE',
            url:'/task/'+id
        });
    }

    fac.createTask = function(task){
        return $http({
            method:'POST',
            url:'/task',
            data: {title: task.title,description: task.description, categoryId: task.catId , userId: task.usrId}
        });
    };

    return fac;
}])

