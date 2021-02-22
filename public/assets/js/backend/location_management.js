define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'location_management/index' + location.search,
                    add_url: 'location_management/add',
                    edit_url: 'location_management/edit',
                    del_url: 'location_management/del',
                    multi_url: 'location_management/multi',
                    table: 'location_management',
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
                        {field: 'partition_name', title: __('Partition code'), operate: false},
                        {field: 'location', title: __('Location')},
                        {field: 'status', title: __('Status'), searchList: {"1": __('Available'), "2": __('Disavailable')}, formatter: Table.api.formatter.normal},
                        {field: 'passageway_id', title: __('Passageway id'), operate: false,visible:false},
                        {field: 'picking_sort', title: __('Picking sort'), operate: false,visible:false},
                        {field: 'temporary', title: __('Temporary'), operate: false, searchList: {"1": __('Yes'), "0": __('No')}, formatter: Table.api.formatter.normal},
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
                //选择仓库获取分区
                $('#c-warehouse_code').change(function(){
                    var warehouse_code = $('#c-warehouse_code').val();
                    console.log(warehouse_code);
                    $.post("location_management/get_partition",{warehouse_code:warehouse_code},function(data){
                        console.log(data);
                        if(data.length > 0){
                            var Html = '';
                            for(var i = 0; i < data.length; i++){
                                Html += "<option value='"+data[i]['id']+"'>"+data[i]['partition_name']+"</option>";
                            }
                            $('#c-partition_code').html(Html);
                        }else{
                            $('#c-partition_code').html("<option value='0'>Please select</option>");
                        }
                    });
                })
            }
        }
    };
    return Controller;
});