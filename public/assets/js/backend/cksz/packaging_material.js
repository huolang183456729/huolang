define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cksz/packaging_material/index' + location.search,
                    add_url: 'cksz/packaging_material/add',
                    edit_url: 'cksz/packaging_material/edit',
                    del_url: 'cksz/packaging_material/del',
                    multi_url: 'cksz/packaging_material/multi',
                    table: 'packaging_material',
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
                        {field: 'warehouse_name', title: __('Warehouse'), operate: false},
                        {field: 'code', title: __('Code')},
                        {field: 'chinese_name', title: __('Chinese name'), operate: 'LIKE %...%'},
                        {field: 'english_name', title: __('English name'), operate: 'LIKE %...%'},
                        {field: 'num', title: __('Num'), operate: false},
                        {field: 'cost', title: __('Cost'), operate: false},
                        {field: 'purpose_type', title: __('Purpose type'), operate: false, searchList: {"1": __('Product packaging material'), "2": __('Order packing material')}, formatter: Table.api.formatter.normal},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "0": __('Disavailable')}, formatter: Table.api.formatter.normal},
                        {field: 'unit_codes', title: __('Unit codes'), operate: false,visible:false},
                        {field: 'currency', title: __('Currency'), operate: false,visible:false},
                        {field: 'length', title: __('Length'), operate: false,visible:false},
                        {field: 'wide', title: __('Wide'), operate: false,visible:false},
                        {field: 'high', title: __('High'), operate: false,visible:false},
                        {field: 'weight', title: __('Weight'), operate: false,visible:false},
                        {field: 'image', title: __('Image'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
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