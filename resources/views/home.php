<!DOCTYPE html>
<html>
<head>
    <title>Envoy Todo List</title>

    <!--  Styles  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!--  Scripts  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-rc.0/angular.js"></script>
    <script src="js/app.js"></script>


</head>
<body>
<!-- Header  -->
<header>
    <div class="nav-container">
        <nav class="navbar-tasks">
            <a href="/">Envoy Todo List</a>
        </nav>
    </div><!-- /.container-fluid -->
</header>
<!-- Main Content  -->
<div class="container" ng-app="todo-list">
    <div class="row" ng-controller="TaskController">
        <!--  Right Column -->
        <div class="col-md-8 col-sm-12">
            <div class="task-list-container">
                <h2>All Tasks</h2>

                <!--   Filters  -->
                <form class="form-inline">
                    <div class="form-group">
                        <label for="">Category Filter: </label>
                        <select class="form-control" ng-model="filters.category_id">
                            <option value="">None</option>
                            <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                        </select>
                    </div>

                </form>

                <!--   Task List   -->
                <table class="table table-responsive table-stripped">
                    <thead>
                    <tr><th>Task</th><th>Assignee</th><th>Category</th><th>Options</th></tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="task in tasks | filter:{category_id: filters.category_id} as results">
                        <td>{{task.title}}</td>
                        <td>{{task.user.name}}</td>
                        <td>{{task.category.name}}</td>
                        <td><button class="btn btn-danger" ng-click="deleteTask(task.id)">Delete</button></td>
                    </tr>
                    </tbody>
                </table>
                <!--   End of Task List   -->
            </div>
        </div>
        <!--  Right Column -->
        <div class="col-md-4 col-sm-12">
            <div class="task-form-container" >
                <h2>Create a new task</h2>

                <!--   Errors   -->
                <div class="alert alert-danger alert-dismissible" role="alert" ng-repeat="error in formErrors">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> {{error}}
                </div>


                <!--   Task Form   -->
                <form ng-submit="createTask()">
                    <div class="form-group">
                        <label for="">Task:</label>
                        <input type="text" class="form-control" ng-model="task.title">
                    </div>
                    <div class="form-group">
                        <label for="">Description:</label>
                        <textarea cols="30" rows="3" class="form-control" ng-model="task.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Assign To:</label>
                        <select class="form-control" ng-model="task.usrId">
                            <option ng-repeat="user in users" value="{{user.id}}">{{user.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Category: </label>
                        <select class="form-control" ng-model="task.catId">
                            <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control">
                    </div>
                </form>
                <!--    End of Task Form    -->
            </div>
        </div>
    </div>
</div>
</body>
</html>
