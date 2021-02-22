define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cpglxt/supplier/index' + location.search,
                    add_url: 'cpglxt/supplier/add',
                    edit_url: 'cpglxt/supplier/edit',
                    del_url: 'cpglxt/supplier/del',
                    multi_url: 'cpglxt/supplier/multi',
                    table: 'supplier',
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
                        {field: 'chinese_name', title: __('Chinese name'), operate: 'LIKE %...%'},
                        {field: 'grade', title: __('Grade'), operate: false, searchList: {"0": __(''), "A": __('A'), "B": __('B'), "C": __('C'), "D": __('D')}, formatter: Table.api.formatter.normal},
                        {field: 'english_name', title: __('English name'), operate: 'LIKE %...%',visible:false},
                        {field: 'cooperation_type', title: __('Cooperation type'), operate: false, searchList: {"0": __(''), "1": __('Normal'), "2": __('Temporary'), "3": __('Spare')}, formatter: Table.api.formatter.normal},
                        {field: 'product_category_name', title: __('Product category'), operate: false},
                        {field: 'type', title: __('Type'), operate: false, searchList: {"0": __(''), "1": __('Retail'), "2": __('Wholesale'), "3": __('Manufacturer'), "4": __('General'), "5": __('Online'), "6": __('Market')}, formatter: Table.api.formatter.normal},
                        {field: 'buyer_name', title: __('Buyer'), operate: false},
                        {field: 'merchandiser_name', title: __('Merchandiser'), operate: false},
                        {field: 'supplier_developer_id', title: __('Supplier developer'), operate: false,visible:false},
                        {field: 'organization', title: __('Organization'), operate: false,visible:false},
                        {field: 'supplier_tax_number', title: __('Supplier tax number'), operate: false,visible:false},
                        {field: 'settlement_methods', title: __('Settlement methods'), operate: false,searchList: {"0": __(''), "1": __('Cash on Delivery'), "2": __('Delivery after payment'), "3": __('Account period')}, formatter: Table.api.formatter.normal},
                        {field: 'payment_cycle_type', title: __('Payment cycle type'), operate: false,visible:false},
                        {field: 'payment_method', title: __('Payment method'), operate: false,searchList: {"0": __(''), "1": __('Cash'), "2": __('Online'), "3": __('Bank card')}, formatter: Table.api.formatter.normal},
                        {field: 'undertaker', title: __('Undertaker'), operate: false,visible:false},
                        {field: 'shipping_type', title: __('Shipping type'), operate: false,visible:false},
                        {field: 'carrier', title: __('Carrier'), operate: false,visible:false},
                        {field: 'supplier_country', title: __('Supplier country'), operate: false,visible:false},
                        {field: 'supplier_state', title: __('Supplier state'), operate: false,visible:false},
                        {field: 'supplier_city', title: __('Supplier city'), operate: false,visible:false},
                        {field: 'supplier_address', title: __('Supplier address'), operate: false,visible:false},
                        {field: 'status', title: __('Status'),searchList: {"1": __('Official supplier')}, formatter: Table.api.formatter.normal},
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