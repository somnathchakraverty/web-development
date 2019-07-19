App.service("BookOrderService",['$http','ConstConfig','$rootScope', function($http, ConstConfig,$rootScope) {
	return {
		getAllHabitsDetails: function(callback) {
			var url = ConstConfig.couponUrl + 'customer/RiskHabitManagement/gethabitParameter';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getAllRiskDetails: function(callback) {
			var url = ConstConfig.couponUrl + 'customer/RiskHabitManagement/getriskParameter';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getTimeSlots: function(opts, opts1, opts2, opts3, callback) {
			var token = localStorage.getItem("token");
			var opt = {locality_id: opts, date: opts1, amount: opts2, log_user_id: opts3, source: 'web'};
			var url = ConstConfig.serverUrl + 'commonservice/time_slots_post';
			doPost($http, url, opt, token, function(data) {
				callback(data);
			});
		},

		getlocality: function(opts, callback) {
			var opt = {"cityId": opts};
			var url = ConstConfig.serverUrl + 'commonservice/getLocalityByCityId';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getAddressSuggest: function (opts, opts1, callback) {
			var opt = {city_id: opts, locality: opts1}
			var url = ConstConfig.serverUrl + 'commonservice/getLocalityByCity';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getUserId: function (opt,callback) {
			var token = localStorage.getItem("token");
			var url = ConstConfig.serverUrl + 'commonservice/checkUserByDetail';
			doPost($http, url, opt, token, function(data) {
				callback(data);
			});
		},

		addNewLocality: function (opt,callback) {
			var url = ConstConfig.serverUrl + 'commonservice/add_suggested_locality';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getLocalityByCity : function (opt,callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getLocalityByCity';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getFreezDateBySlotId : function (opts,callback) {
			var opt = {slot_id: opts}
			var url = ConstConfig.serverUrl + 'commonservice/getFreezDateBySlotId';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getSlotEmptyById : function ( opts,callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getSlotEmptyById';
			doPost($http, url, opts, "", function(data) {
				callback(data);
			});
		},

		getRealtion: function(callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getrelationship_withme';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getRealtionwithoutself: function(callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getrelationship';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getHardcopyPrice: function(callback) {
			var url = ConstConfig.serverUrl + 'commonservice/get_hard_copy_price';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getOrderTrackingDetails: function(opts, callback) {
			var token = localStorage.getItem("token");
			var url = ConstConfig.serverUrl + 'commonservice/order_tracking';
			doPost($http, url, opts, token, function(data) {
				callback(data);
			});
		},

		getPaymentSummaryDetails: function(opts, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/payment_summary_details';
			doPost($http, url, opts, "", function(data) {
				callback(data);
			});
		},
		
		updateUserDetail: function (opt,callback) {
			var token = localStorage.getItem("token");
			var url = ConstConfig.serverUrl + 'commonservice/updateUserByDetail';
			doPost($http, url, opt, token, function(data) {
				callback(data);
			});
		},
		
		insertNewUserInFamily: function (opt,callback) {
			var token = localStorage.getItem("token");
			var url = ConstConfig.serverUrl + 'commonservice/insertNewUserInFamily';
			doPost($http, url, opt, token, function(data) {
				callback(data);
			});
		},
	}
}]);