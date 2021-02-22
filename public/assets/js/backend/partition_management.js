define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'partition_management/index' + location.search,
                    add_url: 'partition_management/add',
                    edit_url: 'partition_management/edit',
                    del_url: 'partition_management/del',
                    multi_url: 'partition_management/multi',
                    table: 'partition_management',
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
                        {field: 'warehouse_name', title: __('Warehouse code'), operate: false},
                        {field: 'partition_name', title: __('Partition name'), operate: 'LIKE %...%'},
                        {field: 'english_name', title: __('English name'), operate: 'LIKE %...%'},
                        {field: 'partition_code', title: __('Partition code'), operate: 'LIKE %...%'},
                        {field: 'partition_type', title: __('Partition type'), searchList: {"1": __('Standard'), "2": __('Rejects'), "3": __('Return area'), "4": __('Transit area'), "5": __('Out of stock area')}, formatter: Table.api.formatter.normal},
                        {field: 'inventory_type', title: __('Inventory type'), searchList: {"1": __('Picking'), "2": __('Storage'), "3": __('Out of stock area')}, formatter: Table.api.formatter.normal},
                        {field: 'priority', title: __('Priority'), operate: false},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "2": __('Disavailable')}, formatter: Table.api.formatter.normal},
                        {field: 'product_category', title: __('Category'), operate: false},
                        {field: 'time', title: __('Time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
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
            }
        }
    };
    return Controller;
});