var crawlApp= angular.module('crawler',['ngFileUpload']);
crawlApp.config(function ($httpProvider) {
	
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
});


// var stockApp= angular.module('stocking_app',['ngAnimate','ui.bootstrap','angularFileUpload']);
// stockApp.config(function ($httpProvider) {
//     $httpProvider.defaults.transformRequest = function(data){
//         if (data === undefined) {
//             return data;
//         }
//         return $.param(data);
//     };
//     $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
// });
// var HOST_NAME = 'http://'+location.hostname+'/master_pro/';
// var hname = location.hostname+'/master_pro/';
//stockApp.constant(‘hostName’,hname);
