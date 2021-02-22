define(['jquery', 'bootstrap', 'backend', 'table', 'form','layui'], function ($, undefined, Backend, Table, Form ,Layui) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'products/index' + location.search,
                    add_url: 'products/add',
                    edit_url: 'products/edit',
                    del_url: 'products/del',
                    multi_url: 'products/multi',
                    import_url:'products/import',
                    table: 'products',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                searchFormVisible: false,
                searchFormTemplate: 'customformtpl',//自定义通用搜索
                // showColumns: false,
                search: false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'images', title: __('Images'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'sku', title: __('SKU'), operate: 'LIKE %...%'},
                        {field: 'chinese_name', title: __('Chinese name'), operate: 'LIKE %...%'},
                        {field: 'english_name', title: __('English name'), operate: 'LIKE %...%'},
                        {field: 'quality_testing_images', title: __('Quality testing images'),visible:false, operate: false, events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'organization', title: __('Organization'),visible:false, operate: false},
                        {field: 'product_brand', title: __('Product brand'),visible:false, operate: false},
                        {field: 'product_category', title: __('Product category'), operate: false},
                        {field: 'product_custom_category', title: __('Product custom category'),visible:false, operate: false},
                        {field: 'operation_mode', title: __('Operation mode'),visible:false,  searchList: {"1": __('Self operation'), "2": __('Agent operation')}, formatter: Table.api.formatter.normal},
                        {field: 'development_director', title: __('Development director'), operate: false},
                        {field: 'designer', title: __('Designer'), operate: false},
                        {field: 'sales_director', title: __('Sales director'), operate: false},
                        {field: 'sales_assistant', title: __('Sales assistant'),visible:false, operate: false},
                        {field: 'suggest_sale_price', title: __('Suggest sale price'),visible:false, operate: false},
                        {field: 'ean', title: __('Ean'), operate: false,visible:false},
                        {field: 'upc', title: __('Upc'), operate: false,visible:false},
                        {field: 'sale_status', title: __('Sale status'), operate: false, searchList: {"1": __('To be removed'), "2": __('Online products'), "3": __('Customized products'), "4": __('Platform removed'), "5": __('Compulsory elimination')}, formatter: Table.api.formatter.normal},
                        {field: 'product_unit', title: __('Product unit'),visible:false, operate: false},
                        {field: 'gross_weight', title: __('Gross weight'), operate: false},
                        {field: 'net_weight', title: __('Net weight'), operate: false},
                        {field: 'product_color', title: __('Product color'),visible:false, operate: false},
                        {field: 'package_long', title: __('Package long'),visible:false,visible:false, operate: false},
                        {field: 'package_wide', title: __('Package wide'),visible:false, operate: false},
                        {field: 'package_high', title: __('Package high'),visible:false, operate: false},
                        {field: 'product_long', title: __('Product long'),visible:false, operate: false},
                        {field: 'product_wide', title: __('Product wide'),visible:false, operate: false},
                        {field: 'product_high', title: __('Product high'),visible:false, operate: false},
                        {field: 'finished_product', title: __('Finished product'),visible:false, operate: false, searchList: {"1": __('Yes'), "2": __('No')}, formatter: Table.api.formatter.normal},
                        {field: 'product_grade', title: __('Product grade'),visible:false, operate: false},
                        {field: 'product_style', title: __('Product style'),visible:false, operate: false},
                        {field: 'tort_level', title: __('Tort level'),visible:false, operate: false},
                        {field: 'logistics_attribute', title: __('Logistics attribute'),visible:false, operate: false},
                        {field: 'quality_testing', title: __('Quality testing'),visible:false, operate: false, searchList: {"1": __('Need'), "0": __('Unwanted')}, formatter: Table.api.formatter.normal},
                        {field: 'default_supplier', title: __('Default supplier'), operate: false},
                        {field: 'supply_product_number', title: __('Supply product number'),visible:false, operate: false},
                        {field: 'min_order_quantity', title: __('Min order quantity'),visible:false, operate: false},
                        {field: 'delivery_date', title: __('Delivery date'),visible:false, operate: false},
                        {field: 'purchase_reference_price', title: __('Purchase reference price'),visible:false, operate: false},
                        {field: 'supply_product_link', title: __('Supply product link'),visible:false, operate: false},
                        {field: 'default_purchase_unit_price', title: __('Default purchase unit price'), operate: false},
                        {field: 'default_currency', title: __('Default currency'),visible:false, operate: false},
                        {field: 'default_buyer', title: __('Default buyer'),visible:false, operate: false},
                        {field: 'declared_value', title: __('Declared value'),visible:false, operate: false},
                        {field: 'chinese_declared_name', title: __('Chinese declared name'),visible:false, operate: false},
                        {field: 'english_declared_name', title: __('English declared name'),visible:false, operate: false},
                        {field: 'customs_code', title: __('Customs code'), operate: false,visible:false},
                        {field: 'battery', title: __('Battery'), operate: false,visible:false, searchList: {"1": __('Yes'), "0": __('No')}, formatter: Table.api.formatter.normal},
                        {field: 'is_replica', title: __('Is replica'), operate: false,visible:false, searchList: {"1": __('Yes'), "0": __('No')}, formatter: Table.api.formatter.normal},
                        {field: 'time', title: __('Time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
                layui.use('element', function(){
                    var $ = layui.jquery
                        ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
                });
                //基础资料的其他
                $('#base_extend').click(function(){
                    var base_extend_type = $('#base_extend_type').val();
                    if(base_extend_type == 1){
                        $('#base_extend_info').show();
                        $('#base_extend_type').val(2);
                        $('#base_symbol_text').html('收起');
                        $('#base_symbol').html('︿');
                    }else{
                        $('#base_extend_info').hide();
                        $('#base_extend_type').val(1);
                        $('#base_symbol_text').html('展开');
                        $('#base_symbol').html('﹀');
                    }
                })
                //产品规格的其他
                $('#specifications_extend').click(function(){
                    var specifications_extend_type = $('#specifications_extend_type').val();
                    if(specifications_extend_type == 1){
                        $('#specifications_extend_info').show();
                        $('#specifications_extend_type').val(2);
                        $('#specifications_symbol_text').html('收起');
                        $('#specifications_symbol').html('︿');
                    }else{
                        $('#specifications_extend_info').hide();
                        $('#specifications_extend_type').val(1);
                        $('#specifications_symbol_text').html('展开');
                        $('#specifications_symbol').html('﹀');
                    }
                })
                //采购相关的其他
                $('#purchase_extend').click(function(){
                    var purchase_extend_type = $('#purchase_extend_type').val();
                    if(purchase_extend_type == 1){
                        $('#purchase_extend_info').show();
                        $('#purchase_extend_type').val(2);
                        $('#purchase_symbol_text').html('收起');
                        $('#purchase_symbol').html('︿');
                    }else{
                        $('#purchase_extend_info').hide();
                        $('#purchase_extend_type').val(1);
                        $('#purchase_symbol_text').html('展开');
                        $('#purchase_symbol').html('﹀');
                    }
                })
                //申报信息的其他
                $('#declared_extend').click(function(){
                    var declared_extend_type = $('#declared_extend_type').val();
                    if(declared_extend_type == 1){
                        $('#declared_extend_info').show();
                        $('#declared_extend_type').val(2);
                        $('#declared_symbol_text').html('收起');
                        $('#declared_symbol').html('︿');
                    }else{
                        $('#declared_extend_info').hide();
                        $('#declared_extend_type').val(1);
                        $('#declared_symbol_text').html('展开');
                        $('#declared_symbol').html('﹀');
                    }
                })
                //表单验证非空项（13个必填项）弹窗形式
                $('#submit').click(function(){
                    var sku = $('#c-sku').val();
                    var chinese_name = $('#c-chinese_name').val();
                    var english_name = $('#c-english_name').val();
                    var gross_weight = $('#c-gross_weight').val();
                    var package_long = $('#c-package_long').val();
                    var package_wide = $('#c-package_wide').val();
                    var package_high = $('#c-package_high').val();
                    var default_supplier = $('#c-default_supplier').val();
                    var default_purchase_unit_price = $('#c-default_purchase_unit_price').val();
                    var default_buyer = $('#c-default_buyer').val();
                    var declared_value = $('#c-declared_value').val();
                    var chinese_declared_name = $('#c-chinese_declared_name').val();
                    var english_declared_name = $('#c-english_declared_name').val();
                    if(sku == ''){
                        Layer.alert('SKU can not be empty!');
                        return false;
                    }
                    if(chinese_name == ''){
                        Layer.alert('Chinese name can not be empty!');
                        return false;
                    }
                    if(english_name == ''){
                        Layer.alert('English name can not be empty!');
                        return false;
                    }
                    if(gross_weight == ''){
                        Layer.alert('Gross weight can not be empty!');
                        return false;
                    }
                    if(package_long == ''){
                        Layer.alert('package long can not be empty!');
                        return false;
                    }
                    if(package_wide == ''){
                        Layer.alert('package wide can not be empty!');
                        return false;
                    }
                    if(package_high == ''){
                        Layer.alert('package high can not be empty!');
                        return false;
                    }
                    if(default_supplier == ''){
                        Layer.alert('Default supplier can not be empty!');
                        return false;
                    }
                    if(default_purchase_unit_price == ''){
                        Layer.alert('Default purchase unit price can not be empty!');
                        return false;
                    }
                    if(default_buyer == ''){
                        Layer.alert('Default buyer can not be empty!');
                        return false;
                    }
                    if(declared_value == ''){
                        Layer.alert('Declared value can not be empty!');
                        return false;
                    }
                    if(chinese_declared_name == ''){
                        Layer.alert('Chinese declared name can not be empty!');
                        return false;
                    }
                    if(english_declared_name == ''){
                        Layer.alert('English declared name can not be empty!');
                        return false;
                    }
                })
            }
        }
    };
    return Controller;
});