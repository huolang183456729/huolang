<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use fast\Tree;

/**
 * 产品自定义分类
 *
 * @icon fa fa-circle-o
 */
class ProductCustomCategory extends Backend
{
    
    /**
     * ProductCustomCategory模型对象
     * @var \app\admin\model\ProductCustomCategory
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\ProductCustomCategory;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
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
             for($i=0;$i<count($list);$i++){
                 $list[$i]['creator_name'] = Db::table('fa_admin')->where('id',$list[$i]['creator'])->value('name');
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
                 $params['creator'] = $this->auth->id;
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
    * 重写backend中selectpage方法，从正确的model选择
    */
   public function get_custom_category()
   {
       //设置过滤方法
       $this->request->filter(['strip_tags', 'htmlspecialchars']);

       //搜索关键词,客户端输入以空格分开,这里接收为数组
       $word = (array)$this->request->request("q_word/a");
       //当前页
       $page = $this->request->request("pageNumber");
       //分页大小
       $pagesize = $this->request->request("pageSize");
       //搜索条件
       $andor = $this->request->request("andOr", "and", "strtoupper");
       //排序方式
       $orderby = (array)$this->request->request("orderBy/a");
       //显示的字段
       $field = $this->request->request("showField");
       //主键
       $primarykey = $this->request->request("keyField");
       //主键值
       $primaryvalue = $this->request->request("keyValue");
       //搜索字段
       $searchfield = (array)$this->request->request("searchField/a");
       //自定义搜索条件
       $custom = (array)$this->request->request("custom/a");
       //是否返回树形结构
       $istree = $this->request->request("isTree", 0);
       $ishtml = $this->request->request("isHtml", 0);
       if ($istree) {
           $word = [];
           $pagesize = 99999;
       }
       $order = [];
       foreach ($orderby as $k => $v) {
           $order[$v[0]] = $v[1];
       }
       $field = $field ? $field : 'name';

       //如果有primaryvalue,说明当前是初始化传值
       if ($primaryvalue !== null) {
           $where = [$primarykey => ['in', $primaryvalue]];
           $pagesize = 99999;
       } else {
           $where = function ($query) use ($word, $andor, $field, $searchfield, $custom) {
               $logic = $andor == 'AND' ? '&' : '|';
               $searchfield = is_array($searchfield) ? implode($logic, $searchfield) : $searchfield;
               foreach ($word as $k => $v) {
                   $query->where(str_replace(',', $logic, $searchfield), "like", "%{$v}%");
               }
               if ($custom && is_array($custom)) {
                   foreach ($custom as $k => $v) {
                       if (is_array($v) && 2 == count($v)) {
                           $query->where($k, trim($v[0]), $v[1]);
                       } else {
                           $query->where($k, '=', $v);
                       }
                   }
               }
           };
       }
       $adminIds = $this->getDataLimitAdminIds();


       if (is_array($adminIds)) {
           $this->model->where($this->dataLimitField, 'in', $adminIds);
       }
       $list = [];
       $total = $this->model->where($where)->count();
       if ($total > 0) {
           if (is_array($adminIds)) {
               $this->model->where($this->dataLimitField, 'in', $adminIds);
           }
           $datalist = $this->model->where($where)
//                ->order($order)
               ->order('id asc')
               ->page($page, $pagesize)
               ->field($this->selectpageFields)
               ->select();
           foreach ($datalist as $index => $item) {
               unset($item['password'], $item['salt']);
               $list[] = [
                   $primarykey => isset($item[$primarykey]) ? $item[$primarykey] : '',
                   $field      => isset($item[$field]) ? $item[$field] : '',
                   'pid'       => isset($item['pid']) ? $item['pid'] : 0
               ];
           }
           if ($istree && !$primaryvalue) {
               $tree = Tree::instance();
               $tree->init(collection($list)->toArray(), 'pid');
               $list = $tree->getTreeList($tree->getTreeArray(0), $field);
               if (!$ishtml) {
                   foreach ($list as &$item) {
                       $item = str_replace('&nbsp;', ' ', $item);
                   }
                   unset($item);
               }
           }
       }
       //这里一定要返回有list这个字段,total是可选的,如果total<=list的数量,则会隐藏分页按钮
       return json(['list' => $list, 'total' => $total]);
   }

    

}