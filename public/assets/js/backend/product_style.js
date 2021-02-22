define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product_style/index' + location.search,
                    add_url: 'product_style/add',
                    edit_url: 'product_style/edit',
                    del_url: 'product_style/del',
                    multi_url: 'product_style/multi',
                    table: 'product_style',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'code', title: __('Code')},
                        {field: 'name', title: __('Name'), operate: 'LIKE %...%'},
                        {field: 'english_name', title: __('English name'), operate: 'LIKE %...%'},
                        {field: 'short_name', title: __('Short name'), operate: 'LIKE %...%'},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "0": __('Disavailable')}, formatter: Table.api.formatter.normal},
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
            }
        }
    };
    return Controller;
});