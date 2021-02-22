define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product_category/index' + location.search,
                    add_url: 'product_category/add',
                    edit_url: 'product_category/edit',
                    del_url: 'product_category/del',
                    multi_url: 'product_category/multi',
                    table: 'product_category',
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
                        // {field: 'pid', title: __('Pid'), operate: false},
                        {field: 'pname', title: __('Pid'), operate: false},
                        {field: 'chinese_name', title: __('Chinese_name'), operate: 'LIKE %...%'},
                        {field: 'english_name', title: __('English_name'), operate: 'LIKE %...%'},
                        {field: 'custom_num', title: __('Custom_num')},
                        {field: 'level', title: __('Level')},
                        {field: 'reference_code', title: __('Reference_code')},
                        {field: 'organization', title: __('Organization'), operate: false,visible:false},
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
            }
        }
    };
    return Controller;
});