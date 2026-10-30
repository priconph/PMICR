function fn_shift_manpower_material() {
	// ADDED 7-2-24 - Darren
	$('#mdl_add_report').on('shown.bs.modal', function () {
		// will only come inside after the modal is shown
		// alert('modal alert');
		// console.log('department', document.getElementById("txt_dept").value);
		if (document.getElementById("txt_dept").value == "CN" || document.getElementById("txt_dept").value == "CN") {
			$('#txt_material_code').on('keyup', function (e) {
				var thiss = $(this);
				// console.log('test');
				var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
				$(material_code_list).html('');
				// console.log('thiss', thiss);
				data = {
					"action": "get_CNmaterial_code",
					"pattern": $(this).val()
				};
				$.ajax({
					type: "post",
					dataType: "json",
					data: data,
					url: handler,
					success: function (data) {
						// console.log('data', data);
						var html = '';
						for (var ctr = 0; ctr < data['ctr']; ctr++) {
							html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
						}
						$(material_code_list).html(html);

					}
				});

				document.querySelector('.materialCodeCN').addEventListener('change', (e) => {
					const list = e.target.list;
					// console.log('list', list);
					const option = list.querySelector(`[value="${e.target.value}"]`);
					// console.log(option.getAttribute('data-name'))
					// console.log(e.target.value)
					$('#txt_material_code').val(option.getAttribute('data-code'));
					$('#txt_material').val(option.getAttribute('data-name'));
					$('#txt_material_unit_price').val(option.getAttribute('data-price'));

				});
			});
		}
		else if (document.getElementById("txt_dept").value == "TS") {

			$('#txt_material_code').on('keyup', function (e) {
				var thiss = $(this);
				// console.log('test');
				var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
				$(material_code_list).html('');
				// console.log('thiss', thiss);
				data = {
					"action": "get_TSmaterial_code",
					"pattern": $(this).val()
				};
				$.ajax({
					type: "post",
					dataType: "json",
					data: data,
					url: handler,
					success: function (data) {
						var html = '';
						// console.log('data', data['CODE'] != "undefined" ? data['CODE'] : 'N/A');
						for (var ctr = 0; ctr < data['ctr']; ctr++) {
							html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
						}
						$(material_code_list).html(html);

					}
				});

				document.querySelector('.materialCodeTS').addEventListener('change', (e) => {
					const list = e.target.list;
					// console.log(list);
					const option = list.querySelector(`[value="${e.target.value}"]`);
					// console.log('option', option.getAttribute('data-name'));
					$('#txt_material_code').val(option.getAttribute('data-code'));
					$('#txt_material').val(option.getAttribute('data-name'));
					$('#txt_material_unit_price').val(option.getAttribute('data-price'));

				});
			});
		}
		else if (document.getElementById("txt_dept").value == "YF") {

			$('#txt_material_code').on('keyup', function (e) {
				var thiss = $(this);
				// console.log('test');
				var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
				$(material_code_list).html('');
				// console.log('thiss', thiss);
				data = {
					"action": "get_YFmaterial_code",
					"pattern": $(this).val()
				};
				$.ajax({
					type: "post",
					dataType: "json",
					data: data,
					url: handler,
					success: function (data) {
						var html = '';
						console.log('data', data['CODE'] != "undefined" ? data['CODE'] : 'N/A');
						for (var ctr = 0; ctr < data['ctr']; ctr++) {
							html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
						}
						$(material_code_list).html(html);

					}
				});

				document.querySelector('.materialCodeYF').addEventListener('change', (e) => {
					const list = e.target.list;
					// console.log(list);
					const option = list.querySelector(`[value="${e.target.value}"]`);
					$('#txt_material_code').val(option.getAttribute('data-code'));
					$('#txt_material').val(option.getAttribute('data-name'));
					$('#txt_material_unit_price').val(option.getAttribute('data-price'));

				});
			});
		}
		else if (document.getElementById("txt_dept").value == "PPD-TS") {

			$('#txt_material_code').on('keyup', function (e) {
				var thiss = $(this);
				// console.log('test');
				var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
				$(material_code_list).html('');
				// console.log('thiss', thiss);
				data = {
					"action": "get_TSmaterial_code",
					"pattern": $(this).val()
				};
				$.ajax({
					type: "post",
					dataType: "json",
					data: data,
					url: handler,
					success: function (data) {
						var html = '';
						// console.log('data', data['CODE'] != "undefined" ? data['CODE'] : 'N/A');
						for (var ctr = 0; ctr < data['ctr']; ctr++) {
							html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
						}
						$(material_code_list).html(html);

					}
				});

				document.querySelector('.materialCodePpdTS').addEventListener('change', (e) => {
					const list = e.target.list;
					// console.log('list', list);
					const option = list.querySelector(`[value="${e.target.value}"]`);
					console.log('option', option);
					$('#txt_material_code').val(option.getAttribute('data-code'));
					$('#txt_material').val(option.getAttribute('data-name'));
					$('#txt_material_unit_price').val(option.getAttribute('data-price'));

				});
			});
		}
	});
	// if(document.getElementById("txt_dept").value == "CN"){
	// 	$('#txt_material_code').on('keyup', function(e){
	// 		var thiss = $(this);
	// 		// console.log('test');
	// 		var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
	// 		$(material_code_list).html('');
	// 	// console.log('thiss', thiss);
	// 		data 				= {
	// 			"action" 		: "get_CNmaterial_code",
	// 			"pattern" 		: $(this).val()
	// 		}
	// 		$.ajax({
	// 			type 			: "post",
	// 			dataType 		: "json",
	// 			data 			: data,
	// 			url 			: handler,
	// 			success 		: function(data){
	// 				// console.log('data', data);
	// 				var html = '';
	// 				for (var ctr = 0; ctr < data['ctr']; ctr++) {
	// 					html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
	// 				}
	// 				$(material_code_list).html(html);
	// 			}
	// 		});
	// 		document.querySelector('.materialCodeCN').addEventListener('change', (e) => {
	// 			const list = e.target.list;
	// 			// console.log('list', list);
	// 			const option = list.querySelector(`[value="${e.target.value}"]`);
	// 			// console.log(option.getAttribute('data-name'))
	// 			// console.log(e.target.value)
	// 			$('#txt_material_code').val(option.getAttribute('data-code'));
	// 			$('#txt_material').val(option.getAttribute('data-name'));
	// 			$('#txt_material_unit_price').val(option.getAttribute('data-price'));
	// 		})
	// 	});
	// }
	// else if (document.getElementById("txt_dept").value == "TS"){
	// 	$('#txt_material_code').on('keyup', function(e){
	// 		var thiss = $(this);
	// 		// console.log('test');
	// 		var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
	// 		$(material_code_list).html('');
	// 		// console.log('thiss', thiss);
	// 		data 				= {
	// 			"action" 		: "get_TSmaterial_code",
	// 			"pattern" 		: $(this).val()
	// 		}
	// 		$.ajax({
	// 			type 			: "post",
	// 			dataType 		: "json",
	// 			data 			: data,
	// 			url 			: handler,
	// 			success 		: function(data){
	// 				var html = '';
	// 				console.log('data', data['CODE'] != "undefined" ? data['CODE'] : 'N/A');
	// 				for (var ctr = 0; ctr < data['ctr']; ctr++) {
	// 					html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
	// 				}
	// 				$(material_code_list).html(html);
	// 			}
	// 		});
	// 		document.querySelector('.materialCodeTS').addEventListener('change', (e) => {
	// 			const list = e.target.list;
	// 			// console.log(list);
	// 			const option = list.querySelector(`[value="${e.target.value}"]`);
	// 			$('#txt_material_code').val(option.getAttribute('data-code'));
	// 			$('#txt_material').val(option.getAttribute('data-name'));
	// 			$('#txt_material_unit_price').val(option.getAttribute('data-price'));
	// 		})
	// 	});
	// }
	$('#rdo_item_manpower').change(function () {
		$('#cont_items_material').prop("hidden", true);
		$('#cont_items_manpower').prop("hidden", false);
		$('#txt_material_code').val('');
		$('#txt_material').val('');
	});

	$('#rdo_item_material').change(function () {
		$('#cont_items_material').prop("hidden", false);
		$('#cont_items_manpower').prop("hidden", true);
		$('#txt_material_code').val('');
		$('#txt_material').val('');

		// else if (document.getElementById("txt_dept").value == "YF"){
		// 	$('#txt_material_code').on('keyup', function(e){
		// 		var thiss = $(this);
		// 		// console.log('test');
		// 		var material_code_list = $(thiss).closest('.form-group').find('#material_code_list');
		// 		$(material_code_list).html('');
		// 		// console.log('thiss', thiss);
		// 		data 				= {
		// 			"action" 		: "get_YFmaterial_code",
		// 			"pattern" 		: $(this).val()
		// 		}
		// 		$.ajax({
		// 			type 			: "post",
		// 			dataType 		: "json",
		// 			data 			: data,
		// 			url 			: handler,
		// 			success 		: function(data){
		// 				var html = '';
		// 				console.log('data', data['CODE'] != "undefined" ? data['CODE'] : 'N/A');
		// 				for (var ctr = 0; ctr < data['ctr']; ctr++) {
		// 					html += '<option data-code = "' + data['CODE'][ctr] + '" data-name = "' + data['NAME'][ctr] + '" data-price = "' + data['PRICE'][ctr] + '" value = "' + data['PRICE'][ctr] + '">' + data['CODE'][ctr] + ' | ' + data['NAME'][ctr] + '</option>';
		// 				}
		// 				$(material_code_list).html(html);
		// 			}
		// 		});
		// 		document.querySelector('.materialCodeYF').addEventListener('change', (e) => {
		// 			const list = e.target.list;
		// 			console.log(list);
		// 			const option = list.querySelector(`[value="${e.target.value}"]`);
		// 			// console.log(option.getAttribute('data-name'))
		// 			// console.log(e.target.value)
		// 			// console.log(option.getAttribute('data-code') != null ? option.getAttribute('data-code'): 'N/A');
		// 			// console.log(option);
		// 			$('#txt_material_code').val(option.getAttribute('data-code'));
		// 			$('#txt_material').val(option.getAttribute('data-name'));
		// 			$('#txt_material_unit_price').val(option.getAttribute('data-price'));
		// 		})
		// 	});
		// }		
	});

	$('#rdo_others').change(function () {
		$('#cont_items_material').prop("hidden", false);
		$('#cont_items_manpower').prop("hidden", true);
		$('#txt_material_code').val('');
		$('#txt_material').val('');
	});

	$('#u_rdo_item_manpower').change(function () {
		$('#u_cont_items_material').prop("hidden", true);
		$('#u_cont_items_manpower').prop("hidden", false);
		$('#txt_material_code').val('');
		$('#txt_material').val('');
	});
	$('#u_rdo_item_material').change(function () {
		$('#u_cont_items_material').prop("hidden", false);
		$('#u_cont_items_manpower').prop("hidden", true);
		$('#txt_material_code').val('');
		$('#txt_material').val('');
	});

	$('#u_rdo_others').change(function () {
		$('#u_cont_items_material').prop("hidden", false);
		$('#u_cont_items_manpower').prop("hidden", true);
		$('#txt_cost_mins').val(''); // CHAN - 11-25-24
		$('#txt_material_code').val('');
		$('#txt_material').val('');
	});
}
