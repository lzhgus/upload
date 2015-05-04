var app = angular.module("myApp",['angularFileUpload']);

app.controller("testa",["$scope","$window","$http","$upload",function($scope,$window,$http,$upload){
    $scope.recipe= $window.recipe;
    
    $scope.addIng = function(){
        $scope.recipe.ings.push({name:'',unit:''})
    };    
    $scope.addstep = function(){
        $scope.recipe.steps.push({text: '',unit:''})
    };
    
    var validateRecipe=function(){
        var recipe=$scope.recipe;
        var errs=[];
       if(!recipe.name.trim()){
            errs.push("Recipe needs a name! 0.0");
        }
        if(!recipe.picurl.trim()){
            errs.push("Recipe needs a photo! 0V0");
        }
        if(!validateIngs(recipe.ings)){
            errs.push("cook needs ingredient! ^-^");
        }
        if(!validateSteps(recipe.steps)){
            errs.push("There is no free meal! ^V^");
        }
        return errs;
    };
    
   var validateIngs=function(ings){
        for(var i=ings.length-1;i>=0;i--){
            if(ings[i].name.trim()){
                return true;
            }
        }
        return false
    };
    
    var validateSteps=function(steps){
        for(var i=steps.length-1;i>=0;i--){
            if(steps[i].text.trim()){
                return true;
            }
        }
        return false
    };
    
    $scope.publish=function(){
        var errs=validateRecipe();
        if(errs.length){
            $window.alert(errs.join("\n"));
        }else{
        //$scope.recipe.ings.push({name:$scope.ing.name,unit:$scope.ing.unit});
        //$scope.recipe.steps.push({text:$scope.step.text});
        
            $http.post('upload.php',{'name':$scope.recipe.name,'picurl':$scope.recipe.picurl,'desc':$scope.recipe.desc, 'ings':$scope.recipe.ings,'steps':$scope.recipe.steps}
                       ).success(function(data,status,headers,config){
                $window.alert("good");
            }).error(function(data,status){
               $window.alert(status);
            })
        }
    };

}]);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    