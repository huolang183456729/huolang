<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"D:\phpstudy_pro\WWW\zserp\public/../application/admin\view\products\edit.html";i:1603357246;s:68:"D:\phpstudy_pro\WWW\zserp\application\admin\view\layout\default.html";i:1588765311;s:65:"D:\phpstudy_pro\WWW\zserp\application\admin\view\common\meta.html";i:1600322607;s:67:"D:\phpstudy_pro\WWW\zserp\application\admin\view\common\script.html";i:1588765311;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <link rel="stylesheet" href="/assets/css/layui/css/layui.css"  media="all">
<style>
    #c-gross_weight,#c-package_long,#c-package_wide,#c-package_high,#c-net_weight,#c-product_long,#c-product_wide,#c-product_high,#c-delivery_date{
        width:95%;
    }
    #c-default_purchase_unit_price,#c-suggest_sale_price{
        width:70%;
    }
    #c-default_currency,#c-suggest_sale_currency{
        width:25%;
        margin-left:3%;
    }
</style>
<form id="add-form" class="form-horizontal" role="form"  method="POST" action="">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">基础资料</li>
            <li>产品规格</li>
            <li>采购相关</li>
            <li>申报信息</li>
            <li>附加信息</li>
        </ul>
        <div class="layui-tab-content" >
            <!--基础资料-->
            <div class="layui-tab-item layui-show">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sku'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-sku" placeholder="required"  class="form-control" name="row[sku]" type="text" value="<?php echo htmlentities($row['sku']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Chinese name'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-chinese_name" placeholder="required"   class="form-control" name="row[chinese_name]" type="text" value="<?php echo htmlentities($row['chinese_name']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('English name'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-english_name" placeholder="required"   class="form-control" name="row[english_name]" type="text" value="<?php echo htmlentities($row['english_name']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product category'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-product_category"  data-source="product_category/get_category" data-field="chinese_name" data-primaryKey="id" class="form-control selectpage"   name="row[product_category]"  type="text"  value="<?php echo htmlentities($row['product_category']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product custom category'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-product_custom_category"  data-source="product_custom_category/get_custom_category"   data-multiple="true" class="form-control selectpage" name="row[product_custom_category]" type="text"  value="<?php echo htmlentities($row['product_custom_category']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2">其他信息:</label>
                    <div id="base_extend" class="col-xs-12 col-sm-8" style="padding-top: 9px;color:blue;cursor:pointer;width:10%">
                        <span id="base_symbol_text" style="float:left;">展开</span><span id="base_symbol" style="float:left;padding-top:2px;margin-left:2px;">﹀</span>
                        <input type="hidden" id="base_extend_type" value="1">
                    </div>
                </div>
                <div id="base_extend_info" style="display:none;">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Operation mode'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-operation_mode" class="form-control"  name="row[operation_mode]">
                                <option value='1' <?php if($row['operation_mode'] == 1): ?> selected <?php endif; ?>>自运营</option>
                                <option value='2' <?php if($row['operation_mode'] == 2): ?> selected <?php endif; ?>>代运营</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sale status'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-sale_status" class="form-control"  name="row[sale_status]">
                                <option value='0' <?php if($row['sale_status'] == 0): ?> selected <?php endif; ?>>请选择</option>
                                <option value='1' <?php if($row['sale_status'] == 1): ?> selected <?php endif; ?>>清货待下架</option>
                                <option value='2' <?php if($row['sale_status'] == 2): ?> selected <?php endif; ?>>在线产品</option>
                                <option value='3' <?php if($row['sale_status'] == 3): ?> selected <?php endif; ?>>订制类产品</option>
                                <option value='4' <?php if($row['sale_status'] == 4): ?> selected <?php endif; ?>>平台下架</option>
                                <option value='5' <?php if($row['sale_status'] == 5): ?> selected <?php endif; ?>>强制淘汰	</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Development director'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-development_director"   data-source="auth/admin/get_admin" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[development_director]"  type="text"  value="<?php echo htmlentities($row['development_director']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sales director'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-sales_director"   data-source="auth/admin/get_admin" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[sales_director]"  type="text"  value="<?php echo htmlentities($row['sales_director']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sales assistant'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-sales_assistant"  data-multiple="true" data-source="auth/admin/get_admin" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[sales_assistant]"  type="text"  value="<?php echo htmlentities($row['sales_assistant']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Designer'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-designer"   data-source="auth/admin/get_admin" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[designer]"  type="text" value="<?php echo htmlentities($row['designer']); ?>">
                        </div>
                    </div>

                    <div class="form-group" id="suggest_sale_price">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Suggest sale price'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-suggest_sale_price"   class="form-control" step="0.0001" name="row[suggest_sale_price]" type="number"  value="<?php echo htmlentities($row['suggest_sale_price']); ?>">
                            <select id="c-suggest_sale_currency" class="form-control"  name="row[suggest_sale_currency]">
                                <?php if(is_array($currency_info) || $currency_info instanceof \think\Collection || $currency_info instanceof \think\Paginator): $i = 0; $__LIST__ = $currency_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                <option value='<?php echo $item['id']; ?>' <?php if($row['suggest_sale_currency'] == $item['id']): ?> selected <?php endif; ?>><?php echo $item['en_name']; ?>【<?php echo $item['name']; ?>】</option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ean'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-ean"   class="form-control" name="row[ean]" type="text" value="<?php echo htmlentities($row['ean']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Upc'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-upc"  class="form-control" name="row[upc]" type="text" value="<?php echo htmlentities($row['upc']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Organization'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <?php echo build_select('row[organization]', $channeldata, $row['organization'], ['class'=>'form-control', 'required'=>'']); ?>
                        </div>
                    </div>
                </div>

            </div>
            <!--产品规格-->
            <div class="layui-tab-item" id="specifications">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Gross weight'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-gross_weight" placeholder="required"  class="form-control" step="0.001" name="row[gross_weight]" type="number"  value="<?php echo htmlentities($row['gross_weight']); ?>">kg
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Net weight'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-net_weight"   class="form-control" step="0.001" name="row[net_weight]" type="number" value="<?php echo htmlentities($row['net_weight']); ?>">kg
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Package long'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-package_long" placeholder="required"  class="form-control" step="0.01" name="row[package_long]" type="number" value="<?php echo htmlentities($row['package_long']); ?>">cm
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Package wide'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-package_wide" placeholder="required"   class="form-control" step="0.01" name="row[package_wide]" type="number" value="<?php echo htmlentities($row['package_wide']); ?>">cm
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Package high'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-package_high" placeholder="required"  class="form-control" step="0.01" name="row[package_high]" type="number" value="<?php echo htmlentities($row['package_high']); ?>">cm
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product long'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-product_long" class="form-control" step="0.01" name="row[product_long]" type="number" value="<?php echo htmlentities($row['product_long']); ?>">cm
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product wide'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-product_wide"  class="form-control" step="0.01" name="row[product_wide]" type="number" value="<?php echo htmlentities($row['product_wide']); ?>">cm
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product high'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-product_high"  class="form-control" step="0.01" name="row[product_high]" type="number" value="<?php echo htmlentities($row['product_high']); ?>">cm
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2">其他信息:</label>
                    <div id="specifications_extend" class="col-xs-12 col-sm-8" style="padding-top: 9px;color:blue;cursor:pointer;width:10%">
                        <span id="specifications_symbol_text" style="float:left;">展开</span><span id="specifications_symbol" style="float:left;padding-top:2px;margin-left:2px;">﹀</span>
                        <input type="hidden" id="specifications_extend_type" value="1">
                    </div>
                </div>
                <div id="specifications_extend_info" style="display:none;">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product color'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-product_color"   data-source="product_color/get_color" data-field="color" data-primaryKey="id" class="form-control selectpage"   name="row[product_color]"  type="text" value="<?php echo htmlentities($row['product_color']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Specifications'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-specifications"  class="form-control"  name="row[specifications]" type="text" value="<?php echo htmlentities($row['specifications']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product unit'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-product_unit"   data-source="product_unit/get_unit" data-field="unit_name" data-primaryKey="id" class="form-control selectpage"   name="row[product_unit]"  type="text"  value="<?php echo htmlentities($row['product_unit']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product grade'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-product_grade"   data-source="product_grade/get_grade" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[product_grade]"  type="text"  value="<?php echo htmlentities($row['product_grade']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product style'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-product_style"   data-source="product_style/get_style" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[product_style]"  type="text"  value="<?php echo htmlentities($row['product_style']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product brand'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-product_brand"   data-source="product_brand/get_brand" data-field="brand_name" data-primaryKey="id" class="form-control selectpage"   name="row[product_brand]"  type="text"  value="<?php echo htmlentities($row['product_brand']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Finished product'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-finished_product" class="form-control"  name="row[finished_product]">
                                <option value='1' <?php if($row['finished_product'] == 1): ?>selected<?php endif; ?>>是</option>
                                <option value='2' <?php if($row['finished_product'] == 2): ?>selected<?php endif; ?>>否</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Tort level'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-tort_level"   data-source="product_tort/get_tort" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[tort_level]"  type="text"  value="<?php echo htmlentities($row['tort_level']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Logistics attribute'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-logistics_attribute"   data-source="product_logistics_attribute/get_logistics" data-field="name" data-primaryKey="id" class="form-control selectpage"  data-multiple="true" name="row[logistics_attribute]"  type="text" value="<?php echo htmlentities($row['logistics_attribute']); ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Quality testing'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-quality_testing" class="form-control"  name="row[quality_testing]">
                                <option value='0' <?php if($row['quality_testing'] == 0): ?>selected<?php endif; ?>>不需要</option>
                                <option value='1' <?php if($row['quality_testing'] == 1): ?>selected<?php endif; ?>>需要</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!--采购相关-->
            <div class="layui-tab-item">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Default supplier'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-default_supplier" placeholder="required"   data-source="cpglxt/supplier/get_supplier" data-field="chinese_name" data-primaryKey="id" class="form-control selectpage"   name="row[default_supplier]"  type="text" value="<?php echo htmlentities($row['default_supplier']); ?>">
                    </div>
                </div>
                <style>
                    #default_purchase_unit_price .n-right{
                        margin-top: 7px;
                        position: relative;
                        left: -200px;
                    }
                </style>
                <div class="form-group" id="default_purchase_unit_price">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Default purchase unit price'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-default_purchase_unit_price" placeholder="required"    class="form-control" step="0.0001" name="row[default_purchase_unit_price]" type="number" value="<?php echo htmlentities($row['default_purchase_unit_price']); ?>">
                        <select id="c-default_currency" class="form-control"  name="row[default_currency]">
                            <?php if(is_array($currency_info) || $currency_info instanceof \think\Collection || $currency_info instanceof \think\Paginator): $i = 0; $__LIST__ = $currency_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <option value='<?php echo $item['id']; ?>' <?php if($row['default_currency'] == $item['id']): ?>selected<?php endif; ?>><?php echo $item['en_name']; ?>【<?php echo $item['name']; ?>】</option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Default buyer'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-default_buyer" placeholder="required"   data-source="auth/admin/get_admin" data-field="name" data-primaryKey="id" class="form-control selectpage"   name="row[default_buyer]"  type="text" value="<?php echo htmlentities($row['default_buyer']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2">其他信息:</label>
                    <div id="purchase_extend" class="col-xs-12 col-sm-8" style="padding-top: 9px;color:blue;cursor:pointer;width:10%">
                        <span id="purchase_symbol_text" style="float:left;">展开</span><span id="purchase_symbol" style="float:left;padding-top:2px;margin-left:2px;">﹀</span>
                        <input type="hidden" id="purchase_extend_type" value="1">
                    </div>
                </div>
                <div id="purchase_extend_info" style="display:none;">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Supply product link'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-supply_product_link"  class="form-control" name="row[supply_product_link]" type="text" value="<?php echo htmlentities($row['supply_product_link']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Supply product number'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-supply_product_number"   class="form-control" name="row[supply_product_number]" type="text" value="<?php echo htmlentities($row['supply_product_number']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Min order quantity'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-min_order_quantity"  class="form-control" name="row[min_order_quantity]" type="number" value="<?php echo htmlentities($row['min_order_quantity']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Delivery date'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-delivery_date"  class="form-control" name="row[delivery_date]" type="number" value="<?php echo htmlentities($row['delivery_date']); ?>">天
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detailed description'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <textarea id="c-detailed_description"   class="form-control " rows="5" name="row[detailed_description]" cols="50"><?php echo htmlentities($row['detailed_description']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Purchase reference price'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-purchase_reference_price"  class="form-control" step="0.0001" name="row[purchase_reference_price]" type="number" value="<?php echo htmlentities($row['purchase_reference_price']); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <!--申报信息-->
            <div class="layui-tab-item">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Declared value'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-declared_value" placeholder="required"   class="form-control" step="0.01" name="row[declared_value]" type="number" value="<?php echo htmlentities($row['declared_value']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Chinese declared name'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-chinese_declared_name" placeholder="required"   class="form-control" name="row[chinese_declared_name]" type="text" value="<?php echo htmlentities($row['chinese_declared_name']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('English declared name'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-english_declared_name" placeholder="required"  class="form-control" name="row[english_declared_name]" type="text" value="<?php echo htmlentities($row['english_declared_name']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2">其他信息:</label>
                    <div id="declared_extend" class="col-xs-12 col-sm-8" style="padding-top: 9px;color:blue;cursor:pointer;width:10%">
                        <span id="declared_symbol_text" style="float:left;">展开</span><span id="declared_symbol" style="float:left;padding-top:2px;margin-left:2px;">﹀</span>
                        <input type="hidden" id="declared_extend_type" value="1">
                    </div>
                </div>
                <div id="declared_extend_info" style="display:none;">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Customs code'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-customs_code"  class="form-control" name="row[customs_code]" type="text" value="<?php echo htmlentities($row['customs_code']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Customs rate'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <input id="c-customs_rate"  class="form-control" name="row[customs_rate]" type="text" value="<?php echo htmlentities($row['customs_rate']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Chinese material'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <textarea id="c-chinese_material"  class="form-control " rows="5" name="row[chinese_material]" cols="50"><?php echo htmlentities($row['chinese_material']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('English material'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <textarea id="c-english_material"  class="form-control " rows="5" name="row[english_material]" cols="50"><?php echo htmlentities($row['english_material']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Chinese purpose'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <textarea id="c-chinese_purpose"  class="form-control " rows="5" name="row[chinese_purpose]" cols="50"><?php echo htmlentities($row['chinese_purpose']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('English purpose'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <textarea id="c-english_purpose"  class="form-control " rows="5" name="row[english_purpose]" cols="50"><?php echo htmlentities($row['english_purpose']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Customs attribute'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-customs_attribute" class="form-control"  name="row[customs_attribute]">
                                <option value='0' <?php if($row['customs_attribute'] == 0): ?>selected<?php endif; ?>>请选择</option>
                                <option value='1' <?php if($row['customs_attribute'] == 1): ?>selected<?php endif; ?>>内置锂离子电池</option>
                                <option value='2' <?php if($row['customs_attribute'] == 2): ?>selected<?php endif; ?>>内置锂金属电池</option>
                                <option value='3' <?php if($row['customs_attribute'] == 3): ?>selected<?php endif; ?>>干电池</option>
                                <option value='4' <?php if($row['customs_attribute'] == 4): ?>selected<?php endif; ?>>磁性物质</option>
                                <option value='5' <?php if($row['customs_attribute'] == 5): ?>selected<?php endif; ?>>木质类</option>
                                <option value='6' <?php if($row['customs_attribute'] == 6): ?>selected<?php endif; ?>>纯电池</option>
                                <option value='7' <?php if($row['customs_attribute'] == 7): ?>selected<?php endif; ?>>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Declaration instructions'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <textarea id="c-declaration_instructions"  class="form-control " rows="5" name="row[declaration_instructions]" cols="50"><?php echo htmlentities($row['declaration_instructions']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Battery'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-battery" class="form-control"  name="row[battery]">
                                <option value='0' <?php if($row['battery'] == 0): ?>selected<?php endif; ?>>否</option>
                                <option value='1' <?php if($row['battery'] == 1): ?>selected<?php endif; ?>>是</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is replica'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select id="c-is_replica" class="form-control"  name="row[is_replica]">
                                <option value='0' <?php if($row['is_replica'] == 0): ?>selected<?php endif; ?>>否</option>
                                <option value='1' <?php if($row['is_replica'] == 1): ?>selected<?php endif; ?>>是</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!--附加信息-->
            <div class="layui-tab-item">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Images'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <div class="input-group">
                            <input id="c-images"   class="form-control" size="50" name="row[images]" type="textarea" value="<?php echo htmlentities($row['images']); ?>">
                            <div class="input-group-addon no-border no-padding">
                                <span><button type="button" id="plupload-images" class="btn btn-danger plupload" data-input-id="c-images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                <span><button type="button" id="fachoose-images" class="btn btn-primary fachoose" data-input-id="c-images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                            </div>
                            <span class="msg-box n-right" for="c-images"></span>
                        </div>
                        <ul class="row list-inline plupload-preview" id="p-images"></ul>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Quality testing images'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <div class="input-group">
                            <input id="c-quality_testing_images"   class="form-control" size="50" name="row[quality_testing_images]" type="text" value="<?php echo htmlentities($row['quality_testing_images']); ?>">
                            <div class="input-group-addon no-border no-padding">
                                <span><button type="button" id="plupload-quality_testing_images" class="btn btn-danger plupload" data-input-id="c-quality_testing_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-quality_testing_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                <span><button type="button" id="fachoose-quality_testing_images" class="btn btn-primary fachoose" data-input-id="c-quality_testing_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                            </div>
                            <span class="msg-box n-right" for="c-quality_testing_images"></span>
                        </div>
                        <ul class="row list-inline plupload-preview" id="p-quality_testing_images"></ul>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Chinese description'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <textarea id="c-chinese_description"  class="form-control " rows="5" name="row[chinese_description]" cols="50"><?php echo htmlentities($row['chinese_description']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('English description'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <textarea id="c-english_description"   class="form-control " rows="5" name="row[english_description]" cols="50"><?php echo htmlentities($row['english_description']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2"><?php echo __('Time'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="c-time"  class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[time]" type="text" value="<?php echo $row['time']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" id="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>