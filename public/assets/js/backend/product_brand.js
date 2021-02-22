define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product_brand/index' + location.search,
                    add_url: 'product_brand/add',
                    edit_url: 'product_brand/edit',
                    del_url: 'product_brand/del',
                    multi_url: 'product_brand/multi',
                    table: 'product_brand',
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
                        {field: 'brand_name', title: __('Brand name'), operate: 'LIKE %...%'},
                        {field: 'logo_image', title: __('Logo image'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        // {field: 'brand_url', title: __('Brand url'), operate: false, formatter: Table.api.formatter.url},
                        {field: 'brand_description', title: __('Brand description'), operate: false},
                        {field: 'brand_url', title: __('Brand url'), operate: false},
                        {field: 'waring_title', title: __('Waring title'),visible:false, operate: false},
                        {field: 'sort', title: __('Sort'), operate: false},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "2": __('Disavailable')}, formatter: Table.api.formatter.normal},
                        {field: 'time', title: __('Time'),visible:false, operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
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