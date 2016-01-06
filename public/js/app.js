angular.module('todo-list',[])

.controller('TaskController',['$scope','ApiService',function($scope,ApiService){

    $scope.users = [];
    $scope.categories = [];
    $scope.task = {};
    $scope.trashedTasks = [];
    $scope.formErrors = [];
    $scope.tasks = [];
    $scope.filters = {};

    $scope.init = function(){
        ApiService.getUsers().success(function(json){
            $scope.users = json;
        });

        ApiService.getCategories().success(function(json){
            $scope.categories = json;
        });

        $scope.filters.all = true;
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

        ApiService.getTrashedTasks().success(function(json){
            $scope.trashedTasks = json;
        })
    };

    $scope.deleteTask = function(id){
        ApiService.deleteTask(id).success(function(json){
            if(json.success){
                $scope.loadTask();
            }
        });
    };

    $scope.restoreTask = function(id){
        ApiService.restoreTask(id).success(function(json){
            if(json.success){
                $scope.loadTask();
            }
        });
    };

    $scope.permDelete = function(id){
        ApiService.permDelete(id).success(function(json){
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

    fac.getTrashedTasks = function(){
        return $http({
            method:'GET',
            url:'/trashed'
        });
    };

    fac.deleteTask = function(id){
        return $http({
            method:'DELETE',
            url:'/task/'+id
        });
    };

    fac.restoreTask = function(id){
        return $http({
            method:'PUT',
            url:'/trashed/'+id
        });
    };

    fac.permDelete = function(id){
        return $http({
            method:'DELETE',
            url:'/trashed/'+id
        });
    };

    fac.createTask = function(task){
        return $http({
            method:'POST',
            url:'/task',
            data: {title: task.title,description: task.description, categoryId: task.catId , userId: task.usrId}
        });
    };

    return fac;
}])

