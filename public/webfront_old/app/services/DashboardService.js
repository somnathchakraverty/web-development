App.service("DashboardService",['$http','$injector','ConstConfig', function($http, $injector,ConstConfig) {
	return {
		getCityDetail: function(callback) {
			
			var url = ConstConfig.serverUrl + 'commonservice/getNcrCityList';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getmyProfileData : function (opt, callback) {
			//var opt = {user_id:"13913"};
			var url = ConstConfig.serverUrl + 'commonservice/myProfileData';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		updateProfile : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/updateProfile';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		myReports : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/myReports';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getDoctorConsultant : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getDoctorConsultant';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		uploadImage : function (opt, callback) {
			//console.log("opt",opt);
			var url = ConstConfig.serverUrl + 'commonservice/uploadImage';
			//var url = '//172.19.1.86/newcrm/index.php/commonservice/uploadImage';
			doPostImage($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		uploadCoverImage : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/uploadCoverImage';
			//var url = '//172.19.1.86/newcrm/index.php/commonservice/uploadCoverImage';
			doPostImage($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		prefer_slots : function (callback) {
			var url = ConstConfig.serverUrl + 'commonservice/prefer_slots';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		shareCustReport : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/shareCustReport';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		subscribe_order : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/subscribe_order';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		myBookings : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/myBookings';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		reorder_by_id : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/reorder_by_id';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		previousReport : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/get_previous_reports';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		}
	}
}]);