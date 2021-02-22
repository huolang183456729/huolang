define(['jquery', 'bootstrap', 'backend', 'table', 'form','selectpage'], function ($, undefined, Backend, Table, Form,selectPage) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'warehouse_management/index' + location.search,
                    add_url: 'warehouse_management/add',
                    edit_url: 'warehouse_management/edit',
                    del_url: 'warehouse_management/del',
                    multi_url: 'warehouse_management/multi',
                    table: 'warehouse_management',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'warehouse_code', title: __('Warehouse_code'), operate: false},
                        {field: 'warehouse_name', title: __('Warehouse_name'), operate: 'LIKE %...%'},
                        {field: 'sort', title: __('Sort'), operate: false,visible:false},
                        {field: 'type', title: __('Type'), searchList: {"1": __('Standard'), "2": __('Transfer')}, formatter: Table.api.formatter.normal},
                        {field: 'operation_mode', title: __('Operation_mode'), searchList: {"1": __('Autarky'), "2": __('Third party')}, formatter: Table.api.formatter.normal},
                        {field: 'country_name', title: __('Country'), operate: false},
                        {field: 'states', title: __('States'), operate: false},
                        {field: 'city', title: __('City'), operate: false},
                        {field: 'postcode', title: __('Postcode'), operate: false,visible:false},
                        {field: 'house_number', title: __('House_number'), operate: false,visible:false},
                        {field: 'address1', title: __('Address1'), operate: false,visible:false},
                        {field: 'address2', title: __('Address2'), operate: false,visible:false},
                        {field: 'contacts', title: __('Contacts'), operate: false},
                        {field: 'tel', title: __('Tel'), operate: false},
                        {field: 'company_name', title: __('Company'), operate: false},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "0": __('Disavailable')}, formatter: Table.api.formatter.normal},
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
                //selectPage搜索渲染
                $('#c-country,#c-company').selectPage({
                    eAjaxSuccess: function (data) {
                        data.list = typeof data.rows !== 'undefined' ? data.rows : (typeof data.list !== 'undefined' ? data.list : []);
                        data.totalRow = typeof data.total !== 'undefined' ? data.total : (typeof data.totalRow !== 'undefined' ? data.totalRow : data.list.length);
                        return data;
                    },
                    eSelect:function (data){
                        console.log(data);
                    }
                })
            }
        }
    };
    return Controller;
});