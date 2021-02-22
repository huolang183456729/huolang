define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'organization/index' + location.search,
                    add_url: 'organization/add',
                    edit_url: 'organization/edit',
                    del_url: 'organization/del',
                    multi_url: 'organization/multi',
                    table: 'organization',
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
                        {field: 'pname', title: __('父级组织')},
                        {field: 'cn_name', title: __('Cn_name'), operate: 'LIKE %...%'},
                        {field: 'en_name', title: __('En_name'), operate: 'LIKE %...%'},
                        {field: 'grade', title: __('Grade')},
                        {field: 'sort', title: __('Sort'), operate: false},
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