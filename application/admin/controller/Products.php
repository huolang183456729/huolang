<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use fast\Tree;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

/**
 * 产品
 *
 * @icon fa fa-circle-o
 */
class Products extends Backend
{
    
    /**
     * Products模型对象
     * @var \app\admin\model\Products
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Products;
        $currency_info = Db::table('fa_currency')->select();
        $this->view->assign('currency_info', $currency_info);

        //组织机构信息
        $channelmodel = new \app\admin\model\Organization;
        // 必须将结果集转换为数组
        $channelList = collection($channelmodel->order('id', 'asc')->select())->toArray();
        foreach ($channelList as $k => &$v) {
            $v['title'] = __($v['cn_name']);
        }
        unset($v);
        Tree::instance()->init($channelList);
        $this->channelList = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0), 'cn_name');
        $channeldata = [0 => __('选择')];
        foreach ($this->channelList as $k => &$v) {

            $channeldata[$v['id']] = $v['cn_name'];
        }
        unset($v);
        // halt($channeldata);
        $this->view->assign('channeldata', $channeldata);

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
     /**
      * 导入
      */
//     public function import()
//     {
//         return parent::import();
//     }
     /**
      * 查看
      */
     public function index()
     {
         //设置过滤方法
         $this->request->filter(['strip_tags']);
         if ($this->request->isAjax()) {
             //如果发送的来源是Selectpage，则转发到Selectpage
             if ($this->request->request('keyField')) {
                 return $this->selectpage();
             }
             list($where, $sort, $order, $offset, $limit) = $this->buildparams();
             $total = $this->model
                 ->where($where)
                 ->order($sort, $order)
                 ->count();

             $list = $this->model
                 ->where($where)
                 ->order($sort, $order)
                 ->limit($offset, $limit)
                 ->select();
             //处理列表字段显示
             for($i=0;$i<count($list);$i++){
                 //产品品类
                 $list[$i]['product_category'] = $list[$i]['product_category'] > 0 ? Db::table('fa_product_category')->where('id',$list[$i]['product_category'])->value('english_name') : '';
                 //产品品牌
                 $list[$i]['product_brand'] = $list[$i]['product_brand'] > 0 ? Db::table('fa_product_brand')->where('id',$list[$i]['product_brand'])->value('brand_name') : '';
                 //产品自定义分类
                 $product_custom_category = '';
                 if($list[$i]['product_custom_category']){
                     $pcc = explode(',',$list[$i]['product_custom_category']);
                     for($j=0;$j<count($pcc);$j++){
                         $product_custom_category .= Db::table('fa_product_custom_category')->where('id',$pcc[$j])->value('name').',';
                     }
                     $list[$i]['product_custom_category'] = trim($product_custom_category,',');
                 }else{
                     $list[$i]['product_custom_category'] = '';
                 }
                 //开发负责人
                 $list[$i]['development_director'] = $list[$i]['development_director'] > 0 ? Db::table('fa_admin')->where('id',$list[$i]['development_director'])->value('name') : '';
                 //设计者
                 $list[$i]['designer'] = $list[$i]['designer'] > 0 ? Db::table('fa_admin')->where('id',$list[$i]['designer'])->value('name') : '';
                 //销售负责人
                 $list[$i]['sales_director'] = $list[$i]['sales_director'] > 0 ? Db::table('fa_admin')->where('id',$list[$i]['sales_director'])->value('name') : '';
                 //销售状态
                 $list[$i]['sale_status'] = $list[$i]['sale_status'] > 0 ? $list[$i]['sale_status'] : '';
                 //默认供应商
                 $list[$i]['default_supplier'] = $list[$i]['default_supplier'] > 0 ? Db::table('fa_supplier')->where('id',$list[$i]['default_supplier'])->value('english_name') : '';
                 //组织机构
                 $list[$i]['organization'] = $list[$i]['organization'] > 0 ? Db::table('fa_organization')->where('id',$list[$i]['organization'])->value('en_name') : '';
                 //产品品牌
                 $list[$i]['product_brand'] = $list[$i]['product_brand'] > 0 ? Db::table('fa_product_brand')->where('id',$list[$i]['product_brand'])->value('brand_name') : '';
                 //附属销售员
                 $sales_assistant = '';
                 if($list[$i]['sales_assistant']){
                     $sa = explode(',',$list[$i]['sales_assistant']);
                     for($j=0;$j<count($sa);$j++){
                         $sales_assistant .= Db::table('fa_admin')->where('id',$sa[$j])->value('name').',';
                     }
                     $list[$i]['sales_assistant'] = trim($sales_assistant,',');
                 }else{
                     $list[$i]['sales_assistant'] = '';
                 }
                 //产品单位
                 $list[$i]['product_unit'] = $list[$i]['product_unit'] > 0 ? Db::table('fa_product_unit')->where('id',$list[$i]['product_unit'])->value('english_name') : '';
                 //产品颜色
                 $list[$i]['product_color'] = $list[$i]['product_color'] > 0 ? Db::table('fa_product_color')->where('id',$list[$i]['product_color'])->value('color') : '';
                 //产品等级
                 $list[$i]['product_grade'] = $list[$i]['product_grade'] > 0 ? Db::table('fa_product_grade')->where('id',$list[$i]['product_grade'])->value('english_name') : '';
                 //产品款式
                 $list[$i]['product_style'] = $list[$i]['product_style'] > 0 ? Db::table('fa_product_style')->where('id',$list[$i]['product_style'])->value('name') : '';
                 //侵权等级
                 $list[$i]['tort_level'] = $list[$i]['tort_level'] > 0 ? Db::table('fa_product_tort')->where('id',$list[$i]['tort_level'])->value('name') : '';
                 //产品物流属性
                 $logistics_attribute = '';
                 if($list[$i]['logistics_attribute']){
                     $las = explode(',',$list[$i]['logistics_attribute']);
                     for($j=0;$j<count($las);$j++){
                         $logistics_attribute .= Db::table('fa_product_logistics_attribute')->where('id',$las[$j])->value('name').',';
                     }
                     $list[$i]['logistics_attribute'] = trim($logistics_attribute,',');
                 }else{
                     $list[$i]['logistics_attribute'] = '';
                 }
                 //默认币种
                 $list[$i]['default_currency'] = $list[$i]['default_currency'] > 0 ? Db::table('fa_currency')->where('id',$list[$i]['default_currency'])->value('en_name') : '';
                 //默认采购员
                 $list[$i]['default_buyer'] = $list[$i]['default_buyer'] > 0 ? Db::table('fa_admin')->where('id',$list[$i]['default_buyer'])->value('name') : '';
             }

             $list = collection($list)->toArray();
             $result = array("total" => $total, "rows" => $list);

             return json($result);
         }
         return $this->view->fetch();
     }
    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
    /**
     * 编辑
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }
//    /**
//     * 导入
//     */
    public function import()
    {
        $file = $this->request->request('file');
        if (!$file) {
            $this->error(__('Parameter %s can not be empty', 'file'));
        }
        $filePath = ROOT_PATH . DS . 'public' . DS . $file;
        if (!is_file($filePath)) {
            $this->error(__('No results were found'));
        }
        //实例化reader
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!in_array($ext, ['csv', 'xls', 'xlsx'])) {
            $this->error(__('Unknown data format'));
        }
        if ($ext === 'csv') {
            $file = fopen($filePath, 'r');
            $filePath = tempnam(sys_get_temp_dir(), 'import_csv');
            $fp = fopen($filePath, "w");
            $n = 0;
            while ($line = fgets($file)) {
                $line = rtrim($line, "\n\r\0");
                $encoding = mb_detect_encoding($line, ['utf-8', 'gbk', 'latin1', 'big5']);
                if ($encoding != 'utf-8') {
                    $line = mb_convert_encoding($line, 'utf-8', $encoding);
                }
                if ($n == 0 || preg_match('/^".*"$/', $line)) {
                    fwrite($fp, $line . "\n");
                } else {
                    fwrite($fp, '"' . str_replace(['"', ','], ['""', '","'], $line) . "\"\n");
                }
                $n++;
            }
            fclose($file) || fclose($fp);

            $reader = new Csv();
        } elseif ($ext === 'xls') {
            $reader = new Xls();
        } else {
            $reader = new Xlsx();
        }

        //导入文件首行类型,默认是注释,如果需要使用字段名称请使用name
        $importHeadType = isset($this->importHeadType) ? $this->importHeadType : 'comment';

        $table = $this->model->getQuery()->getTable();
        $database = \think\Config::get('database.database');
        $fieldArr = [];
        $list = db()->query("SELECT COLUMN_NAME,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND TABLE_SCHEMA = ?", [$table, $database]);
        foreach ($list as $k => $v) {
            if ($importHeadType == 'comment') {
                $fieldArr[$v['COLUMN_COMMENT']] = $v['COLUMN_NAME'];
            } else {
                $fieldArr[$v['COLUMN_NAME']] = $v['COLUMN_NAME'];
            }
        }

        //加载文件
        $insert = [];
        try {
            if (!$PHPExcel = $reader->load($filePath)) {
                $this->error(__('Unknown data format'));
            }
            $currentSheet = $PHPExcel->getSheet(0);  //读取文件中的第一个工作表
            $allColumn = $currentSheet->getHighestDataColumn(); //取得最大的列号
            $allRow = $currentSheet->getHighestRow(); //取得一共有多少行
            $maxColumnNumber = Coordinate::columnIndexFromString($allColumn);
            $fields = [];
            for ($currentRow = 1; $currentRow <= 1; $currentRow++) {
                for ($currentColumn = 1; $currentColumn <= $maxColumnNumber; $currentColumn++) {
                    $val = $currentSheet->getCellByColumnAndRow($currentColumn, $currentRow)->getValue();
                    $fields[] = $val;
                }
            }

            for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
                $values = [];
                for ($currentColumn = 1; $currentColumn <= $maxColumnNumber; $currentColumn++) {
                    $val = $currentSheet->getCellByColumnAndRow($currentColumn, $currentRow)->getValue();
                    $values[] = is_null($val) ? '' : $val;
                }
                $row = [];
                $temp = array_combine($fields, $values);
                foreach ($temp as $k => $v) {
                    if (isset($fieldArr[$k]) && $k !== '') {
                        $row[$fieldArr[$k]] = $v;
                    }
                }
                if ($row) {
                    $insert[] = $row;
                }
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
        if (!$insert) {
            $this->error(__('No rows were updated'));
        }
//var_dump($insert);die;
        //处理部分字段的默认值
        foreach ($insert as &$val) {
            $val['time'] = date('Y-m-d H:I:s',time());
            $val['images'] = '';
            $val['quality_testing_images'] = '';
        }
        try {
            //是否包含admin_id字段
            $has_admin_id = false;
            foreach ($fieldArr as $name => $key) {
                if ($key == 'admin_id') {
                    $has_admin_id = true;
                    break;
                }
            }
            if ($has_admin_id) {
                $auth = Auth::instance();
                foreach ($insert as &$val) {
                    if (!isset($val['admin_id']) || empty($val['admin_id'])) {
                        $val['admin_id'] = $auth->isLogin() ? $auth->id : 0;
                    }

                }
            }
            $this->model->saveAll($insert);
        } catch (PDOException $exception) {
            $msg = $exception->getMessage();
            if (preg_match("/.+Integrity constraint violation: 1062 Duplicate entry '(.+)' for key '(.+)'/is", $msg, $matches)) {
                $msg = "导入失败，包含【{$matches[1]}】的记录已存在";
            };
            $this->error($msg);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        $this->success();
    }

}
