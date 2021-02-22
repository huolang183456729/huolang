define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product_tort/index' + location.search,
                    add_url: 'product_tort/add',
                    edit_url: 'product_tort/edit',
                    del_url: 'product_tort/del',
                    multi_url: 'product_tort/multi',
                    table: 'product_tort',
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
                        {field: 'name', title: __('Name'), operate: 'LIKE %...%'},
                        {field: 'english_name', title: __('English name'), operate: 'LIKE %...%'},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "0": __('Disavailable')}, formatter: Table.api.formatter.normal},
                        {field: 'creator', title: __('Creator'), operate: false},
                        {field: 'reviser', title: __('Reviser'), operate: false},
                        {field: 'add_time', title: __('Add time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'update_time', title: __('Update time'), operate:'RANGE', addclass:'datetimerange'},
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