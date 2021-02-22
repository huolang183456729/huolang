define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'currency/index' + location.search,
                    add_url: 'currency/add',
                    edit_url: 'currency/edit',
                    del_url: 'currency/del',
                    multi_url: 'currency/multi',
                    table: 'currency',
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
                        {field: 'name', title: __('Name'), operate: 'LIKE %...%'},
                        {field: 'en_name', title: __('En_name'), operate: 'LIKE %...%'},
                        {field: 'Identifier', title: __('Identifier'), operate: false},
                        {field: 'float_num', title: __('Float_num'), operate: false},
                        {field: 'exchange_rate', title: __('Exchange_rate'), operate: false},
                        {field: 'code', title: __('Code')},
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